<?php

namespace App\Controller;

use App\Entity\Address;
use App\Entity\AddressMixing;
use App\Entity\Commission;
use App\Entity\MixOrder;
use App\Entity\InputTransaction;
use App\Entity\MixingCode;
use App\Entity\OutputTransaction;
use App\Generator\AddressGenerator;
use App\Generator\Mail;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Wallets;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MixingOrderController extends AbstractController
{
    private $doctrine;
    private $em;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
        $this->em = $doctrine->getManager();
    }

    function generateTransactionHash() #FORTEST
    {
        $hash = md5(uniqid(rand(), true));
        return $hash;
    }

    function generateSenderAddress() #FORTEST
    {
        try {
            $alphabet = '123456789ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz';
            $cadRand = '';
            $alphaLength = strlen($alphabet) - 1;
            for ($i = 0; $i < 34; $i++) {
                $n = rand(0, $alphaLength);
                $cadRand .= $alphabet[$n];
            }
            return $cadRand;
        } catch (\Exception $e) {
            return $this->json(["Error, the address was not created" => $e->getMessage()]);
        }
    }

    public function getDelayAndPercentage($id)
    {
        $mixingorderrepository = $this->doctrine->getRepository(MixOrder::class);
        $currentMixingOrder = $mixingorderrepository->findOneBy(['id' => $id]);
        $mixingaddressesrepository = $this->doctrine->getRepository(AddressMixing::class);
        $allAddressesOfMixing = $mixingaddressesrepository->findBy(['mixorder' => $id]);
        $array_of_addresses = [];
        $i2 = 1;
        foreach ($allAddressesOfMixing as $mixing_address_object) {
            $address_percentage = $mixing_address_object->getPercentage();
            $date = $mixing_address_object->getDelay();
            $date2 = $currentMixingOrder->getCreatedAt();
            $diff = $date->diff($date2);
            if (($diff->days) === 0) {
                $array_of_addresses[] = [$mixing_address_object->getAddress() => [
                    "persantage" => $address_percentage,
                    "delay" => $diff->h
                ]];
            } elseif (($diff->days) !== 0) {
                $array_of_addresses[] = [$mixing_address_object->getAddress() => [
                    "persantage" => $address_percentage,
                    "delay" => $diff->days . '-' . $diff->h
                ]];
            }
            $i2++;
        }

        return $array_of_addresses;
    }

    public function linkAdress($percentage, $mixingAddress, $delay, $mixOrder)
    {

        $delayDT = new \DateTime();
        if ($delay - 24 < 0) {
            $delayDT->modify("+0 day, +$delay hour");
        } elseif ($delay - 24 > 0) {
            $days = floor($delay / 24);
            $hours = $delay % 24;
            $delayDT->modify("+$days day, +$hours hour");
        } elseif (($delay - 24) === 0) {
            $delayDT->modify("+1 day, +0 hour");
        }
        $address_mixing = new AddressMixing;
        #уставливаем адрес для миксинга
        $address_mixing->setAddress($mixingAddress);
        #устанавливаем процент распределения
        $address_mixing->setPercentage($percentage);
        #устанавливаем delay 
        $address_mixing->setDelay($delayDT);
        $address_mixing->setMixorder($mixOrder);
        try {
            $this->em->persist($address_mixing);
            $this->em->flush();
        } catch (\Exception $e) {
            return $this->json(["Addresses not set, error in request data" => $e->getMessage()]);
        }
        $addressMixingRepository = $this->doctrine->getRepository(AddressMixing::class);
        $addressMixingForGet  = $addressMixingRepository->findOneBy([], ['id' => 'DESC']);
        $address_id = $addressMixingForGet->getId();
        return $address_id;
    }
    #[Route('/api/mixing/order_create', name: 'app_mixing_order', methods: ["POST"])]
    public function createMixingOrder(AddressGenerator $address, Request $request,  Mail $mail): JsonResponse
    {
        $mixOrder = new MixOrder;
        #получаем все комиссии для миксинга
        $commissionrepository = $this->doctrine->getRepository(Commission::class);
        $mixing_commission = $commissionrepository->findOneBy([]);
        $decoded = json_decode($request->getContent());
        #задаём currency_to_mix
        $currency_to_mix = $decoded->currency_to_mix;
        $mixOrder->setCurrencyToMix($currency_to_mix);
        #задаем дату создания заявки
        $mixorder_created_at = new \DateTime();
        $mixOrder->setCreatedAt($mixorder_created_at);
        #задаём статус заявки 
        $status_id = 'preliminary';
        $mixOrder->setStatus($status_id);
        #задаём количество монет
        $amount_to_send = $decoded->amount_to_send;
        $mixOrder->setAmountToSend($amount_to_send);
        #отправляются низкорискованные активы или нет
        $low_risk = $decoded->low_risk;
        $mixOrder->setLowRisk($low_risk);
        #ВРЕМЕННО cчитаем комиссию за отправку high risk 
        if ($low_risk == false) {
            $high_risk_commission_percents = $mixing_commission->getMixForSendingHighRisk();
            $high_risk_commision_counted = ($high_risk_commission_percents / 100) * $amount_to_send;
            $mixOrder->setCommissionOfRiskForSending($high_risk_commision_counted);
        } elseif ($low_risk == true) {
            $high_risk_commision_counted = 0;
            $mixOrder->setCommissionOfRiskForSending($high_risk_commision_counted);
        }
        #задаём процент комиссии, указанный пользователем
        $commission_persents = $decoded->commission_persents;
        switch ($currency_to_mix) {
            case 'BTC':
            case 'BTC(B)':
                $mix_btc_min_commission = $mixing_commission->getMixBtcMin();
                if ($mix_btc_min_commission <= $commission_persents) {
                    $mixOrder->setCommissionPersents($commission_persents);
                } else {
                    $response = new Response();
                    $response->setStatusCode(Response::HTTP_BAD_REQUEST);
                    $response->headers->set('Content-Type', 'application/json');
                    $response->setContent(json_encode([
                        'Error' => 'Commission less than minimum',
                    ]));
                    $response->send();
                    exit;
                }
                break;
            case 'ETH':
                $mix_eth_min_commission = $mixing_commission->getMixEthMin();
                if ($mix_eth_min_commission <= $commission_persents) {
                    $mixOrder->setCommissionPersents($commission_persents);
                } else {
                    $response = new Response();
                    $response->setStatusCode(Response::HTTP_BAD_REQUEST);
                    $response->headers->set('Content-Type', 'application/json');
                    $response->setContent(json_encode([
                        'Error' => 'Commission less than minimum',
                    ]));
                    $response->send();
                    exit;
                }
                break;
            case 'USDT(ERC20)':
            case 'USDT(TRC20)':
                $mix_usdt_min_commission = $mixing_commission->getMixUsdtMin();
                if ($mix_usdt_min_commission <= $commission_persents) {
                    $mixOrder->setCommissionPersents($commission_persents);
                } else {
                    $response = new Response();
                    $response->setStatusCode(Response::HTTP_BAD_REQUEST);
                    $response->headers->set('Content-Type', 'application/json');
                    $response->setContent(json_encode([
                        'Error' => 'Commission less than minimum',
                    ]));
                    $response->send();
                    exit;
                }
                break;
            case 'USDC(ERC20)':
            case 'USDC(TRC20)':
                $mix_usdc_min_commission = $mixing_commission->getMixUsdcMin();
                if ($mix_usdc_min_commission <= $commission_persents) {
                    $mixOrder->setCommissionPersents($commission_persents);
                } else {
                    $response = new Response();
                    $response->setStatusCode(Response::HTTP_BAD_REQUEST);
                    $response->headers->set('Content-Type', 'application/json');
                    $response->setContent(json_encode([
                        'Error' => 'Commission less than minimum',
                    ]));
                    $response->send();
                    exit;
                }
                break;
        }
        #записываем количество коинов, составляющих обычную комиссию сервиса
        $comission_of_service = ($commission_persents / 100) * $amount_to_send;
        $mixOrder->setComissionOfService($comission_of_service);
        #задаём риск за получение BTC(B) true/false
        if ($currency_to_mix === 'BTC') {
            if (isset($decoded->recieve_btc_b)) {
                $recieve_btc_b = $decoded->recieve_btc_b;
                $mixOrder->setRecieveBtcB($recieve_btc_b);
            } else {
                $recieve_btc_b = false;
                $mixOrder->setRecieveBtcB($recieve_btc_b);
            }
        } else {
            $recieve_btc_b = false;
            $mixOrder->setRecieveBtcB($recieve_btc_b);
        }
        #устанавливаем комиссию за получение BTC(B)
        if ($currency_to_mix === 'BTC') {
            if ($recieve_btc_b == true) {
                $mixing_for_reciving_btc_b = $mixing_commission->getMixForBtcB();
                $commission_of_risk_of_recieving  = ($mixing_for_reciving_btc_b / 100) * $amount_to_send;
                $mixOrder->setCommissionOfRiskOfRecieving($commission_of_risk_of_recieving);
            } elseif ($recieve_btc_b == false) {
                $commission_of_risk_of_recieving  = 0;
                $mixOrder->setCommissionOfRiskOfRecieving($commission_of_risk_of_recieving);
            }
        } else {
            $commission_of_risk_of_recieving  = 0;
            $mixOrder->setCommissionOfRiskOfRecieving($commission_of_risk_of_recieving);
        }
        #генерируем случайный MIXING_CODE из 10 символов и задаём в базу данных
        $mixing_code = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 10)), 0, 10); #FORTEST
        $mixOrder->setMixCode($mixing_code);
        #устанавливаем over_max, пока что всегда false на 1 этапе
        $over_max = false;
        $mixOrder->setOverMax($over_max);
        #создание нового адреса для получения монет от пользователя
        $data = $address->addAddress($currency_to_mix); #FORTEST
        $address_of_service = $data['address'];
        $mixOrder->setAddressOfService($address_of_service);
        #указываем id кошелька, к которому привязан созданный адрес
        $wallet_of_service = $data['walletid'];
        $mixOrder->setWalletOfService($wallet_of_service);
        try {
            $this->em->persist($mixOrder);
            $this->em->flush();
        } catch (\Exception $e) {
            return $this->json(["Error, mixing order not created, invalid request data" => $e->getMessage()]);
        }
        $addresses_to_mix = $decoded->addresses_to_mix;
        #в запросе указывается процент распределения на адрес
        $percentages = $addresses_to_mix->percentages;
        $delays = $addresses_to_mix->delays;
        $mixingAddresses = $addresses_to_mix->addresses;
        #База данных коды миксинга
        $mixingcode = new MixingCode;
        #проверяем сколько значений percentage
        if (count($percentages) > 10) {
            $response = new Response();
            $response->setStatusCode(Response::HTTP_BAD_REQUEST);
            $response->headers->set('Content-Type', 'application/json');
            $response->setContent(json_encode([
                'Error' => 'Number of addresses more than 10',
            ]));
            $response->send();
            exit;
        }
        $sum = 0;
        $i = 0;
        foreach ($percentages as $persentage) {
            $sum += $persentage;
            if ($sum > 100) {
                $response = new Response();
                $response->setStatusCode(Response::HTTP_BAD_REQUEST);
                $response->headers->set('Content-Type', 'application/json');
                $response->setContent(json_encode([
                    'Error' => 'Percentages amount greater than 100',
                ]));
                $response->send();
                exit;
            }
            $i++;
        }
        if ($sum < 100) {
            $response = new Response();
            $response->setStatusCode(Response::HTTP_BAD_REQUEST);
            $response->headers->set('Content-Type', 'application/json');
            $response->setContent(json_encode([
                'Error' => 'Percentages amount less than 100',
            ]));
            $response->send();
            exit;
        }
        $key = 0;

        $address_ids = [];
        foreach ($percentages as $key => $persentage) {
            $address_ids[] = $this->linkAdress($persentage, $mixingAddresses[$key], $delays[$key], $mixOrder);
            $key++;
        }
        $address_ids_string = implode(',', $address_ids);
        $mixingcode->setAddressIds($address_ids_string);
        #устанавливаем mixingcode
        $mixingcode->setMixingCode($mixing_code);
        $mixingcode->setMixorder($mixOrder);
        try {
            $this->em->persist($mixingcode);
            $this->em->flush();
        } catch (\Exception $e) {
            return $this->json(["Error" => $e->getMessage()]);
        }
        $mixorderrepository = $this->doctrine->getRepository(MixOrder::class);
        $mixOrderForGet = $mixorderrepository->findOneBy([], ['id' => 'DESC']);
        $mixOrder_id = $mixOrderForGet->getId();
        $addresses_to_mix = $this->getDelayAndPercentage($mixOrder_id);
        #генерация гарантийного письма
        $mixorderdata = [
            'id' => $mixOrder->getId(),
            'currency_to_mix' => $currency_to_mix,
            'address_of_service' => $address_of_service, #FORTEST
            'wallet_of_service' => $wallet_of_service, #FORTEST
            'created_at' => $mixorder_created_at->format('Y-m-d h:m'),
            'status' => $status_id,
            'recieve_btc_b' => $recieve_btc_b,
            'amount_to_send' => $amount_to_send,
            'low_risk' => $low_risk,
            'commission_persents' => $commission_persents,
            'commission_of_risk_for_sending' => $high_risk_commision_counted,
            'commission_of_risk_of_recieving' => $commission_of_risk_of_recieving,
            'comission_of_service' => $comission_of_service,
            'mixing_code' => $mixing_code,
            'over_max' => $over_max,
            'number_of_addresses' => $i,
            'addresses_to_mix' => $addresses_to_mix
        ];
        $letter_of_guarantee_uri = $mail->creation($mixorderdata);
        $mixOrderForGet->setLetterOfGuaranteeUri($letter_of_guarantee_uri);
        try {
            $this->em->persist($mixOrderForGet);
            $this->em->flush();
        } catch (\Exception $e) {
            return $this->json(["Error" => $e->getMessage()]);
        }
        return $this->json([
            'id' => $mixOrder->getId(),
            'currency_to_mix' => $currency_to_mix,
            'address_of_service' => $address_of_service, #FORTEST
            'wallet_of_service' => $wallet_of_service, #FORTEST
            'created_at' => $mixorder_created_at->format('Y-m-d h:m'),
            'status' => $status_id,
            'recieve_btc_b' => $recieve_btc_b,
            'amount_to_send' => $amount_to_send,
            'low_risk' => $low_risk,
            'commission_persents' => $commission_persents,
            'commission_of_risk_for_sending' => $high_risk_commision_counted,
            'commission_of_risk_of_recieving' => $commission_of_risk_of_recieving,
            'comission_of_service' => $comission_of_service,
            'mixing_code' => $mixing_code,
            'over_max' => $over_max,
            'address_ids' => $address_ids_string,
            'number_of_addresses' => $i,
            'letter_of_guarantee_uri' => $letter_of_guarantee_uri,
            'addresses_to_mix' => $addresses_to_mix
        ]);
    }

    #[Route('/api/mixing/get_card', name: 'app_mixing_get_card', methods: ["GET"])]
    public function cardExOrder(Request $request): JsonResponse
    {
        $id = $request->query->get('id');
        $repository = $this->doctrine->getRepository(MixOrder::class);
        $data = [];
        $mixOrderCurrent = $repository->findOneBy(
            ["id" => "$id"],
        );
        if (!$mixOrderCurrent) {
            throw $this->createNotFoundException(
                'This mixing order not found' . $id
            );
        }
        $addresses_to_mix = $this->getDelayAndPercentage($id);
        $mixingcodesrepository = $this->doctrine->getRepository(MixingCode::class);
        $mixingcode = $mixingcodesrepository->findOneBy(['mixorder' => $id]);
        if ($mixingcode) {
            $string_addresses_id = $mixingcode->getAddressIds();
            $array_addresses_id = explode(',', $string_addresses_id);
            $count_addresses_id = count($array_addresses_id);
        }
        $order = $mixOrderCurrent;
        $data[] = [
            "ID" => $order->getId(),
            'letter_of_guarantee_uri' => $order->getLetterOfGuaranteeUri(),
            'over_max' => $order->isOverMax(),
            'created_at' => $order->getCreatedAt()->format('Y-m-d h:m'),
            'low_risk' => $order->isLowRisk(),
            'low_risk' => $order->isLowRisk(), #FORTEST
            'address_of_service' => $order->getAddressOfService(),
            'wallet_of_service' => $order->getWalletOfService(),
            'status' => $order->getStatus(),
            'currency_to_mix' => $order->getCurrencyToMix(),
            'recieve_btc_b' => $order->isRecieveBtcB(),
            'amount_to_send' => $order->getAmountToSend(),
            'commission_persents' => $order->getCommissionPersents(),
            'commission_of_risk_for_sending' => $order->getCommissionOfRiskForSending(),
            'commission_of_risk_of_recieving' => $order->getCommissionOfRiskOfRecieving(),
            'comission_of_service' => $order->getComissionOfService(),
            'address_of_user' => $order->getAddressOfUser(),
            'number_of_addresses' => $count_addresses_id,
            'mixing_code' => $order->getMixCode(),
            'addresses_to_mix' => $addresses_to_mix
        ];
        if ($data === [] || $data === '') {
            return $this->json(['Error' => 'Mixing order with these values not found']);
        } else {
            return $this->json($data);
        }
    }

    #[Route('/api/mixing/order_get_all', name: 'app_mixing_order_get', methods: ["GET"])]
    public function getMixingOrdersAll(): JsonResponse
    {
        try {
            $mixingcodesrepository = $this->doctrine->getRepository(MixingCode::class);
            $mixingorderrepository = $this->doctrine->getRepository(MixOrder::class);
            $mixingorders = $mixingorderrepository->findAll();
            $data = [];

            foreach ($mixingorders as $order) {
                $id = $order->getId();
                $mixingcode = $mixingcodesrepository->findOneBy(['mixorder' => $id]);
                if ($mixingcode) {
                    $string_addresses_id = $mixingcode->getAddressIds();
                    $array_addresses_id = explode(',', $string_addresses_id);
                    $count_addresses_id = count($array_addresses_id);
                    $data[] = [
                        'id' => $order->getId(),
                        'currency_to_mix' => $order->getCurrencyToMix(),
                        'address_of_service' => $order->getAddressOfService(),
                        'status' => $order->getStatus(),
                        'commission_persents' => $order->getCommissionPersents(),
                        'number_of_addresses' => $count_addresses_id,
                        'low_risk' => $order->isLowRisk(),
                        'created_at' => $order->getCreatedAt()->format('Y-m-d H:i')
                    ];
                }
            }
            return $this->json($data);
        } catch (\Exception $e) {
            return $this->json(["Error, invalid request" => $e->getMessage()]);
        }
    }



    #[Route('/api/mixing/change_status_order', name: 'app_mixing_change_status_order', methods: ["PATCH"])]
    public function cardMixOrderChangeStatus(Request $request): JsonResponse
    {
        #Доступ только у администратора с ролью ADMIN!!!
        $decoded = json_decode($request->getContent());
        $id = $decoded->id;
        $repository = $this->doctrine->getRepository(MixOrder::class);
        $data = [];
        $exOrderCurrent = $repository->findOneBy(
            ["id" => "$id"],
        );
        if (!$exOrderCurrent) {
            throw $this->createNotFoundException(
                'This mixing order not found' . $id
            );
        }
        $value = $decoded->value;
        if (!$value) {
            throw $this->createNotFoundException(
                'Mixing order status not set'
            );
        }
        $order = $exOrderCurrent;
        $order->setStatus($value);
        try {
            $this->em->persist($order);
            $this->em->flush();
        } catch (\Exception $e) {
            return $this->json(["Error" => $e->getMessage()]);
        }
        $data[] = [
            'status' => $order->getStatus(),
        ];
        if ($data === [] || $data === '') {
            return $this->json(['Error' => 'Mixing order with these values not found']);
        } else {
            return $this->json($data);
        }
    }

    #[Route('/api/mixing/delete', name: 'app_mixing_delete', methods: ["DELETE"])]
    public function cardMixOrderDelete(Request $request): JsonResponse
    {
        $decoded = json_decode($request->getContent());
        $id = $decoded->id;
        $repository = $this->doctrine->getRepository(MixOrder::class);
        $mixOrderCurrent = $repository->findOneBy(
            ["id" => $id],
        );
        if (!$mixOrderCurrent) {
            throw $this->createNotFoundException(
                'This mixing order not found' . $id
            );
        } else {
            $orderId = $mixOrderCurrent->getId();
        }
        $mixingaddressesrepository = $this->doctrine->getRepository(AddressMixing::class);
        $mixaddresses = $mixingaddressesrepository->findBy(["mixorder" => $id]);
        foreach ($mixaddresses as $mixaddress) {
            $mixOrderCurrent->removeAddressMixingId($mixaddress);
        }

        #удаляем output транзакции
        $outputtransactionsrepository = $this->doctrine->getRepository(OutputTransaction::class);
        $transactions = $outputtransactionsrepository->findBy(["mixorder" => $id]);
        foreach ($transactions as $transaction) {
            $mixOrderCurrent->removeOutputTransaction($transaction);
        }
        #удаляем input транзакции
        $inputtransactionsrepository = $this->doctrine->getRepository(InputTransaction::class);
        $transactions = $inputtransactionsrepository->findBy(["mixorder" => $id]);
        foreach ($transactions as $transaction) {
            $mixOrderCurrent->removeInputTransaction($transaction);
        }


        if (!$mixOrderCurrent) {
            throw $this->createNotFoundException(
                'This mixing order not found' . $id
            );
        }
        try {
            $this->em->remove($mixOrderCurrent);
            $this->em->flush();
        } catch (\Exception $e) {
            return $this->json(["Error" => $e->getMessage()]);
        }
        return $this->json(['Mixing order with id' . $orderId . ' ' . 'deleted']);
    }

    #[Route('/api/mixing/input_transaction_create', name: 'app_mixing_input_transaction_create', methods: ["POST"])]
    public function exchangeInputTransactionCreate(Request $request): JsonResponse
    {
        $decoded = json_decode($request->getContent());
        $id = $decoded->id;
        $repository = $this->doctrine->getRepository(MixOrder::class);
        $mixOrderCurrent = $repository->findOneBy(
            ["id" => "$id"],
        );
        if (!$mixOrderCurrent) {
            throw $this->createNotFoundException(
                'This mixing order not found' . $id
            );
        }
        #создаем новую входящую транзакцию
        $mixorder_input = new InputTransaction;
        #задаём id заявки
        $mixorder_input->setMixorder($mixOrderCurrent);
        #создаём hash транзакции
        $newhash = $this->generateTransactionHash();
        $mixorder_input->setHash($newhash);
        #задаём currency транзакции
        $currency_transaction = $mixOrderCurrent->getCurrencyToMix();
        $mixorder_input->setCurrency($currency_transaction);
        #задаём получателя (получатель в данном случае обменник)
        $reveiver_address = $mixOrderCurrent->getAddressOfService();
        $mixorder_input->setReceiver($reveiver_address);
        #задаём адрес отправителя(в данном случае адрес пользователя), пока что берём рандомный адрес #FORTEST
        $random_sender_address = $this->generateSenderAddress(); #FORTEST
        $mixorder_input->setSender($random_sender_address);  #FORTEST
        #задаём output
        $amount = mt_rand(1, 10) / 100; #FORTEST
        $mixorder_input->setAmount($amount);
        #задаём риск транзакции
        $risk_is_low = (bool) rand(0, 1);
        $mixorder_input->setRiskIsLow($risk_is_low);  #FORTEST
        try {
            $this->em->persist($mixorder_input);
            $this->em->flush();
        } catch (\Exception $e) {
            return $this->json(["Error" => $e->getMessage()]);
        }
        return $this->json([
            'hash' => $newhash,
            'currency' => $currency_transaction,
            'receiver' => $reveiver_address,
            'sender' => $random_sender_address,
            'amount' => $amount,
            'risk_is_low' => $risk_is_low
        ]);
    }

    #[Route('/api/mixing/output_transaction_create', name: 'app_mixing_output_transaction_create', methods: ["POST"])]
    public function mixingOutputTransactionCreate(Request $request): JsonResponse
    {
        $decoded = json_decode($request->getContent());
        $id = $decoded->id;
        $repository = $this->doctrine->getRepository(MixOrder::class);
        $mixOrderCurrent = $repository->findOneBy(
            ["id" => "$id"],
        );
        if (!$mixOrderCurrent) {
            throw $this->createNotFoundException(
                'This mixing order not found' . $id
            );
        }
        #создаем новую входящую транзакцию
        $mixorder_input = new OutputTransaction;
        #задаём id заявки
        $mixorder_input->setMixorder($mixOrderCurrent);
        #создаём hash транзакции
        $newhash = $this->generateTransactionHash();
        $mixorder_input->setHash($newhash);
        #задаём currency транзакции
        $currency_transaction = $mixOrderCurrent->getCurrencyToMix();
        $mixorder_input->setCurrency($currency_transaction);
        #задаём получателя (получатель в данном случае пользователь)
        $reveiver_address = $mixOrderCurrent->getAddressOfUser();
        $mixorder_input->setReceiver($reveiver_address);
        #задаём адрес отправителя(в данном случае адрес обменника) #FORTEST
        #установление адреса 
        $idass = [];
        switch ($currency_transaction) {
            case 'USDT(ERC20)':
            case 'USDC(ERC20)':
            case 'ETH':
                $chain = 'ETH';
                break;
            case 'BTC(B)':
            case 'BTC':
                $chain = 'BTC';
                break;
            case 'USDT(TRC20)':
            case 'USDC(TRC20)':
                $chain = 'TRON';
                break;
            default:
                $chain = 'BTC';
                break;
        }
        try {
            #ищем все кошельки с определенной сетью #FORTEST
            $repository = $this->doctrine->getRepository(Wallets::class); #FORTEST
            $pointer = 'chain';
            $selector = $chain;
            $entities = $repository->findBy(
                [$pointer => $selector]
            );
            foreach ($entities as $entity) {
                $idass[] = $entity->getId();
            }
            #получаем рандомный кошелёк в нужной сетью 
            $id = array_rand($idass, 1);
            $walletid = $this->doctrine->getRepository(Wallets::class)->findOneBy(['id' => $idass[$id]]); #FORTEST
        } catch (\Exception $e) {
            return $this->json(["Error, wallet not found" => $e->getMessage()]);
        }
        try {
            #находим все адреса, привязанные к найденному кошельку с указанной валютой
            $addressrepository = $this->doctrine->getRepository(Address::class);
            $address = $addressrepository->findBy(['wallet' => $idass[$id]]); #FORTEST
            foreach ($address as $entity2) {
                $idass2[] = $entity2->getId();
            }
            $id2 = array_rand($idass2, 1); #FORTEST
            #выбираем рандомный адрес
            $oneAddress = $this->doctrine->getRepository(Address::class)->findOneBy(['id' => $idass2[$id2]]); #FORTEST
            #получаем адрес отправителя
            $sender_address = $oneAddress->getAddress();
        } catch (\Exception $e) {
            return $this->json(["Error, address not found" => $e->getMessage()]);
        }
        $mixorder_input->setSender($sender_address);
        #задаём id кошелька, с которого отправляем
        $mixorder_input->setSenderWallet($walletid);
        #задаём output
        $amount = mt_rand(1, 10) / 100; #FORTEST
        $mixorder_input->setAmount($amount);
        #задаём риск транзакции
        $risk_is_low = (bool) rand(0, 1); #FORTEST
        $mixorder_input->setRiskIsLow($risk_is_low);  #FORTEST
        try {
            $this->em->persist($mixorder_input);
            $this->em->flush();
        } catch (\Exception $e) {
            return $this->json(['Error' => $e->getMessage()]);
        }
        return $this->json([
            'hash' => $newhash,
            'currency' => $currency_transaction,
            'receiver' => $reveiver_address,
            'sender' => $sender_address,
            'sender_wallet_id' => $idass[$id],
            'amount' => $amount,
            'risk_is_low' => $risk_is_low
        ]);
    }

    #[Route('/api/mixing/get_card_input_output_transactions', name: 'app_mixing_get_card_input_output_transactions', methods: ["GET"])]
    public function cardExOrderGetInputTransactions(Request $request): JsonResponse
    {
        $id = $request->query->get('id');
        $transaction = $request->query->get('transaction');
        $repository = $this->doctrine->getRepository(MixOrder::class);
        $data_input_transaction = [];
        $mixOrderCurrent = $repository->findOneBy(
            ["id" => "$id"],
        );
        if (!$mixOrderCurrent) {
            throw $this->createNotFoundException(
                'This mixing order not exist' . $id
            );
        }
        try {
            if ($transaction === 'input') {
                #получаем все транзакции от пользователя(входящие транзакции)
                $mixorder_input_repository = $this->doctrine->getRepository(InputTransaction::class);
                $current_mixorder_input = $mixorder_input_repository->findBy(['mixorder' => $id]);
                foreach ($current_mixorder_input as $object) {
                    $data_input_transaction[] = [
                        'transaction_id' => $object->getId(),
                        'hash' => $object->getHash(),
                        'currency' => $object->getCurrency(),
                        'receiver' => $object->getReceiver(),
                        'sender' => $object->getSender(),
                        'amount' => $object->getAmount(),
                        'risk_is_low' => $object->isRiskIsLow()
                    ];
                }
                $totalAmount = 0;
                foreach ($data_input_transaction as $transaction) {
                    $totalAmount += $transaction['amount'];
                }
                if (empty($data_input_transaction)) {
                    return $this->json(['error' => 'Mixing order with these values not found']);
                } else {
                    return $this->json([
                        "transactions" => $data_input_transaction,
                        "total_amount" => round($totalAmount, 5)
                    ]);
                }
            } elseif ($transaction === 'output') {
                #получаем все транзакции от обменника(исходящие транзакции)
                $mixorder_output_repository = $this->doctrine->getRepository(OutputTransaction::class);
                $current_mixorder_output = $mixorder_output_repository->findBy(['mixorder' => $id]);
                foreach ($current_mixorder_output as $object) {
                    $data_output_transaction[] = [
                        'transaction_id' => $object->getId(),
                        'hash' => $object->getHash(),
                        'currency' => $object->getCurrency(),
                        'receiver' => $object->getReceiver(),
                        'sender' => $object->getSender(),
                        'amount' => $object->getAmount(),
                        'risk_is_low' => $object->isRiskIsLow()
                    ];
                }
                $totalAmount = 0;
                foreach ($data_output_transaction as $transaction) {
                    $totalAmount += $transaction['amount'];
                }
                if ($data_output_transaction === [] || $data_output_transaction === '') {
                    return $this->json(['Error' => 'Mixing order with these values not found']);
                } else {
                    return $this->json([
                        "transactions" => $data_output_transaction,
                        "total_amount" => $totalAmount = round($totalAmount, 5)
                    ]);
                }
            }
        } catch (\Exception $e) {
            return $this->json(['Error, the incorrectly request or transaction does not exist for this mixing order' => $e->getMessage()]);
        }
    }
}
