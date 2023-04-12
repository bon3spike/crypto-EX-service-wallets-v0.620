<?php

namespace App\Controller;

use App\Entity\Address;
use App\Entity\Commission;
use App\Entity\ExOrder;
use App\Entity\InputTransaction;
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

class ExchangeController extends AbstractController
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
            return $this->json(["Error:" => $e->getMessage()]);
        }
    }


    #[Route('/api/exchange/create', name: 'app_exchange_create', methods: ["POST"])]
    public function create(AddressGenerator $address, Request $request, Mail $mail): JsonResponse
    {
        $exOrder = new ExOrder();
        $decoded = json_decode($request->getContent());
        #сумма отправки
        $amount_to_send = $decoded->amount_to_send;
        $exOrder->setAmountToSend($amount_to_send);
        #валюта отправки
        $currency_to_send = $decoded->currency_to_send;
        $currency = $currency_to_send;
        $exOrder->setCurrencyToSend($currency);
        #lowrisk
        $low_risk = $decoded->low_risk;
        $exOrder->setLowRisk($low_risk);
        $exOrder->setLowRiskConfirmed($low_risk);
        #сумма получения
        $amount_to_recieve = $decoded->amount_to_recieve;
        $exOrder->setAmountToRecieve($amount_to_recieve);
        #валюта получения
        $currency_to_recieve = $decoded->currency_to_recieve;
        $exOrder->setCurrencyToRecieve($currency_to_recieve);
        #получение Биржевого Биткоина, если btc биржевой - true , в остальных случаях false
        if ($currency_to_recieve === 'BTC') {
            if (isset($decoded->recieve_btc_b)) {
                $recieve_btc_b = $decoded->recieve_btc_b;
                $exOrder->setRecieveBtcB($recieve_btc_b);
            } else {
                $recieve_btc_b = false;
                $exOrder->setRecieveBtcB($recieve_btc_b);
            }
        } else {
            $recieve_btc_b = false;
            $exOrder->setRecieveBtcB($recieve_btc_b);
        }

        #получаем диапазон комиссий
        $commissionrepository = $this->doctrine->getRepository(Commission::class);
        $exchange_commission = $commissionrepository->findOneBy([]);
        $exchange_min = $exchange_commission->getExchangeMin();
        #процент комиссии указываемый пользователем. 
        $commission_persents = $decoded->commission_persents;
        #проверка: комиссия , указанная пользователем должна быть не ниже минимальной
        if ($exchange_min <= $commission_persents) {
            $exOrder->setCommissionPersents($commission_persents);
            #рассчитывается количество коинов, составляющих обычную комиссию сервиса
            $comission_of_service = ($commission_persents / 100) * $amount_to_send;
            $exOrder->setComissionOfService($comission_of_service);
        } else {
            $response = new Response();
            $response->setStatusCode(Response::HTTP_BAD_REQUEST);
            $response->headers->set('Content-Type', 'text/html');
            $response->send();
            return $this->json([
                'Error' => 'Commission less than the minimum commision',
            ]);
        }
        #дата создания заявки
        $exorder_created_at = new \DateTime();
        $exOrder->setCreatedAt($exorder_created_at);

        #создание нового адреса для получения монет от пользователя
        $data = $address->addAddress($currency);
        $address_of_service = $data['address'];
        $exOrder->setAddressOfService($address_of_service);
        $wallet_of_service = $data['walletid'];
        $exOrder->setWalletOfService($wallet_of_service);
        #адрес получения
        $address_of_user = $decoded->address_of_user;
        $exOrder->setAddressOfUser($address_of_user);
        # ВРЕМЕННО рассчитывается количество коинов комиссии за риск отправки
        if ($low_risk == false) {
            $exchange_for_sending_high_risk = $exchange_commission->getExchangeForSendingHighRisk();
            $high_risk_commision_counted = ($exchange_for_sending_high_risk / 100) * $amount_to_send;
            $exOrder->setCommissionOfRiskForSending($high_risk_commision_counted);
        } elseif ($low_risk == true) {
            $high_risk_commision_counted = 0;
            $exOrder->setCommissionOfRiskForSending($high_risk_commision_counted);
        }
        # ВРЕМЕННО рассчитывается количество коинов комиссии за получение BTC(B) если он выбран
        if ($currency_to_recieve === 'BTC') {
            if ($recieve_btc_b === true) {
                $exchange_for_reciving_btc_b = $exchange_commission->getExchangeForBtcB();
                $commission_of_risk_of_recieving  = ($exchange_for_reciving_btc_b / 100) * $amount_to_send;
                $exOrder->setCommissionOfRiskOfRecieving($commission_of_risk_of_recieving);
            } else {
                $commission_of_risk_of_recieving  = 0;
                $exOrder->setCommissionOfRiskOfRecieving($commission_of_risk_of_recieving);
            }
        }
        $status_id = 'preliminary';
        $exOrder->setStatusId($status_id);
        try {
            $this->em->persist($exOrder);
            $this->em->flush();
        } catch (\Exception $e) {
            return $this->json(["Error:" => $e->getMessage()]);
        }

        $exordrepository = $this->doctrine->getRepository(ExOrder::class);
        $exOrderForGet = $exordrepository->findOneBy([], ['id' => 'DESC']);
        $exOrderId = $exOrderForGet->getId();

        $exorderdata = [
            'id' => $exOrderId,
            'address_of_service' => $address_of_service, #FORTEST
            'wallet_of_service' => $wallet_of_service, #FORTEST
            'created_at' => $exorder_created_at->format('Y-m-d h:m'),
            'status_id' => $status_id,
            'currency_to_recieve' => $currency_to_recieve,
            'amount_to_recieve' => $amount_to_recieve,
            'currency_to_send' => $currency_to_send,
            'amount_to_send' => $amount_to_send,
            'low_risk' => $low_risk,
            'recieve_btc_b' => $recieve_btc_b,
            'low_risk_confirmed' => $low_risk,
            'commission_persents' => $commission_persents,
            'commission_of_risk_for_sending' => $high_risk_commision_counted,
            'commission_of_risk_of_recieving' => $commission_of_risk_of_recieving,
            'comission_of_service' => $comission_of_service,
            'address_of_user' => $address_of_user
        ];
        $letter_of_guarantee_uri = $mail->creation($exorderdata);
        $exOrderForGet->setLetterOfGuaranteeUri($letter_of_guarantee_uri);
        try {
            $this->em->persist($exOrderForGet);
            $this->em->flush();
        } catch (\Exception $e) {
            return $this->json(["Error:" => $e->getMessage()]);
        }

        return $this->json([
            'id' => $exOrder->getId(),
            'address_of_service' => $address_of_service, #FORTEST
            'wallet_of_service' => $wallet_of_service, #FORTEST
            'created_at' => $exorder_created_at->format('Y-m-d h:m'),
            'status_id' => $status_id,
            'currency_to_recieve' => $currency_to_recieve,
            'recieve_btc_b' => $recieve_btc_b,
            'amount_to_recieve' => $amount_to_recieve,
            'currency_to_send' => $currency_to_send,
            'amount_to_send' => $amount_to_send,
            'low_risk' => $low_risk,
            'low_risk_confirmed' => $low_risk,
            'commission_persents' => $commission_persents,
            'commission_of_risk_for_sending' => $high_risk_commision_counted,
            'commission_of_risk_of_recieving' => $commission_of_risk_of_recieving,
            'comission_of_service' => $comission_of_service,
            'letter_of_guarantee_uri' => $letter_of_guarantee_uri,
            'address_of_user' => $address_of_user
        ]);
    }

    #[Route('/api/exchange/get', name: 'app_exchange_get', methods: ["GET"])]
    public function getExOrder(): JsonResponse
    {
        $repository = $this->doctrine->getRepository(ExOrder::class);
        $data = [];
        # получаем все заявки на обмен
        try {
            foreach ($repository->findAll() as $entity) {
                $data[] = [
                    "id" => $entity->getId(),
                    'address_of_service' => $entity->getAddressOfService(),
                    'wallet_of_service' => $entity->getWalletOfService(),
                    'created_at' => $entity->getCreatedAt()->format('Y-m-d h:m'),
                    'status_id' => $entity->getStatusId(),
                    'currency_to_recieve' => $entity->getCurrencyToRecieve(),
                    'recieve_btc_b' => $entity->isRecieveBtcB(),
                    'amount_to_recieve' => $entity->getAmountToRecieve(),
                    'currency_to_send' => $entity->getCurrencyToSend(),
                    'amount_to_send' => $entity->getAmountToSend(),
                    'low_risk' => $entity->isLowRisk(),
                    'low_risk_confirmed' => $entity->isLowRiskConfirmed(),
                    'commission_persents' => $entity->getCommissionPersents(),
                    'commission_of_risk_for_sending' => $entity->getCommissionOfRiskForSending(),
                    'commission_of_risk_of_recieving' => $entity->getCommissionOfRiskOfRecieving(),
                    'comission_of_service' => $entity->getComissionOfService(),
                    'letter_of_guarantee_uri' => $entity->getLetterOfGuaranteeUri(),
                    'address_of_user' => $entity->getAddressOfUser()
                ];
            }
            return $this->json($data);
        } catch (\Exception $e) {
            return $this->json(["Error, the request was incorrectly:" => $e->getMessage()]);
        }
    }

    #[Route('/api/exchange/get_card', name: 'app_exchange_get_card', methods: ["GET"])]
    public function cardExOrder(Request $request): JsonResponse
    {
        $id = $request->query->get('id');
        $repository = $this->doctrine->getRepository(ExOrder::class);
        $data = [];
        $exOrderCurrent = $repository->findOneBy(
            ["id" => "$id"],
        );
        if (!$exOrderCurrent) {
            throw $this->createNotFoundException(
                'This order does not exist' . $id
            );
        }

        $order = $exOrderCurrent;
        $data[] = [
            "ID" => $order->getId(),
            'address_of_service' => $order->getAddressOfService(),
            'wallet_of_service' => $order->getWalletOfService(),
            'created_at' => $order->getCreatedAt()->format('Y-m-d h:m'),
            'status_id' => $order->getStatusId(),
            'currency_to_recieve' => $order->getCurrencyToRecieve(),
            'recieve_btc_b' => $order->isRecieveBtcB(),
            'amount_to_recieve' => $order->getAmountToRecieve(),
            'currency_to_send' => $order->getCurrencyToSend(),
            'amount_to_send' => $order->getAmountToSend(),
            'low_risk' => $order->isLowRisk(),
            'low_risk_confirmed' => $order->isLowRiskConfirmed(), #FORTEST
            'commission_persents' => $order->getCommissionPersents(),
            'commission_of_risk_for_sending' => $order->getCommissionOfRiskForSending(),
            'commission_of_risk_of_recieving' => $order->getCommissionOfRiskOfRecieving(),
            'comission_of_service' => $order->getComissionOfService(),
            'letter_of_guarantee_uri' => $order->getLetterOfGuaranteeUri(),
            'address_of_user' => $order->getAddressOfUser()
        ];
        if ($data === [] || $data === '') {
            return $this->json(['Error' => 'Exchange order with these values not found']);
        } else {
            return $this->json($data);
        }
    }

    #[Route('/api/exchange/get_card_input_output_transactions', name: 'app_exchange_get_card_input_output_transactions', methods: ["GET"])]
    public function cardExOrderGetInputTransactions(Request $request): JsonResponse
    {
        $id = $request->query->get('id');
        $transaction = $request->query->get('transaction');
        $repository = $this->doctrine->getRepository(ExOrder::class);
        $data_input_transaction = [];
        $exOrderCurrent = $repository->findOneBy(
            ["id" => "$id"],
        );
        if (!$exOrderCurrent) {
            throw $this->createNotFoundException(
                'This order does not exist' . $id
            );
        }
        try {

            if ($transaction === 'input') {
                #получаем все транзакции от пользователя(входящие транзакции)
                $exorder_input_repository = $this->doctrine->getRepository(InputTransaction::class);
                $current_exorder_input = $exorder_input_repository->findBy(['exorder' => $id]);
                foreach ($current_exorder_input as $object) {
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
                    return $this->json(['error' => 'Error, order with these values not found']);
                } else {
                    return $this->json([
                        "transactions" => $data_input_transaction,
                        "total_amount" => round($totalAmount, 5)
                    ]);
                }
            } elseif ($transaction === 'output') {
                #получаем все транзакции от обменника(исходящие транзакции)
                $exorder_output_repository = $this->doctrine->getRepository(OutputTransaction::class);
                $current_exorder_output = $exorder_output_repository->findBy(['exorder' => $id]);
                foreach ($current_exorder_output as $object) {
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
                    return $this->json(['error' => 'Error, order with these values not found']);
                } else {
                    return $this->json([
                        "transactions" => $data_output_transaction,
                        "total_amount" => $totalAmount = round($totalAmount, 5)
                    ]);
                }
            }
        } catch (\Exception $e) {
            return $this->json(["Error, the request was incorrectly:" => $e->getMessage()]);
        }
    }

    #[Route('/api/exchange/change_status_order', name: 'app_exchange_change_status_order', methods: ["PATCH"])]
    public function cardExOrderChangeStatusId(Request $request): JsonResponse
    {
        #Доступ только у администратора с ролью ADMIN!!!
        $decoded = json_decode($request->getContent());
        $id = $decoded->id;
        $repository = $this->doctrine->getRepository(ExOrder::class);
        $data = [];
        $exOrderCurrent = $repository->findOneBy(
            ["id" => "$id"],
        );
        if (!$exOrderCurrent) {
            throw $this->createNotFoundException(
                'This order does not exist' . $id
            );
        }
        $value = $decoded->value;
        if (!$value) {
            throw $this->createNotFoundException(
                'Status value not set'
            );
        }
        #проверку на значение сделать
        $order = $exOrderCurrent;
        $order->setStatusId($value);
        try {
            $this->em->persist($order);
            $this->em->flush();
        } catch (\Exception $e) {
            return $this->json(["Error" => $e->getMessage()]);
        }
        $data[] = [
            'status_id' => $order->getStatusId(),
        ];


        if ($data === [] || $data === '') {
            return $this->json(['error' => 'Error, order with these values not found']);
        } else {
            return $this->json($data);
        }
    }

    #[Route('/api/exchange/delete', name: 'app_exchange_delete', methods: ["DELETE"])]
    public function cardExOrderDelete(Request $request): JsonResponse
    {
        $decoded = json_decode($request->getContent());
        $id = $decoded->id;
        $repository = $this->doctrine->getRepository(ExOrder::class);
        $exOrderCurrent = $repository->findOneBy(
            ["id" => "$id"],
        );
        if (!$exOrderCurrent) {
            throw $this->createNotFoundException(
                'This order does not exist' . $id
            );
        }
        $orderId = $exOrderCurrent->getId();
        #удаляем output транзакции
        $outputtransactionsrepository = $this->doctrine->getRepository(OutputTransaction::class);
        $transactions = $outputtransactionsrepository->findBy(["exorder" => $id]);
        foreach ($transactions as $transaction) {
            $exOrderCurrent->removeOutputTransaction($transaction);
        }
        #удаляем input транзакции
        $inputtransactionsrepository = $this->doctrine->getRepository(InputTransaction::class);
        $transactions = $inputtransactionsrepository->findBy(["exorder" => $id]);
        foreach ($transactions as $transaction) {
            $exOrderCurrent->removeInputTransaction($transaction);
        }
        try {
            $this->em->remove($exOrderCurrent);
            $this->em->flush();
        } catch (\Exception $e) {
            return $this->json(["Error" => $e->getMessage()]);
        }
        return $this->json(['Order with this id' . $orderId . ' ' . 'deleted']);
    }

    #[Route('/api/exchange/input_transaction_create', name: 'app_exchange_input_transaction_create', methods: ["POST"])]
    public function exchangeInputTransactionCreate(Request $request): JsonResponse
    {
        $decoded = json_decode($request->getContent());
        $id = $decoded->id;
        $repository = $this->doctrine->getRepository(ExOrder::class);
        $exOrderCurrent = $repository->findOneBy(
            ["id" => "$id"],
        );
        if (!$exOrderCurrent) {
            throw $this->createNotFoundException(
                'This order does not exist' . $id
            );
        }
        #создаем новую входящую транзакцию
        $exorder_input = new InputTransaction;
        #задаём id заявки
        $exorder_input->setExorder($exOrderCurrent);
        #создаём hash транзакции
        $newhash = $this->generateTransactionHash();
        $exorder_input->setHash($newhash);
        #задаём currency транзакции
        $currency_transaction = $exOrderCurrent->getCurrencyToRecieve();
        $exorder_input->setCurrency($currency_transaction);
        #задаём получателя (получатель в данном случае обменник)
        $reveiver_address = $exOrderCurrent->getAddressOfService();
        $exorder_input->setReceiver($reveiver_address);
        #задаём адрес отправителя(в данном случае адрес пользователя), пока что берём рандомный адрес #FORTEST
        $random_sender_address = $this->generateSenderAddress(); #FORTEST
        $exorder_input->setSender($random_sender_address);  #FORTEST
        #задаём output
        $amount = mt_rand(1, 10) / 100; #FORTEST
        $exorder_input->setAmount($amount);
        #задаём риск транзакции
        $risk_is_low = (bool) rand(0, 1);
        $exorder_input->setRiskIsLow($risk_is_low);  #FORTEST
        try {
            $this->em->persist($exorder_input);
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

    #[Route('/api/exchange/output_transaction_create', name: 'app_exchange_output_transaction_create', methods: ["POST"])]
    public function exchangeOutputTransactionCreate(Request $request): JsonResponse
    {
        $decoded = json_decode($request->getContent());
        $id = $decoded->id;
        $repository = $this->doctrine->getRepository(ExOrder::class);
        $exOrderCurrent = $repository->findOneBy(
            ["id" => "$id"],
        );
        if (!$exOrderCurrent) {
            throw $this->createNotFoundException(
                'This order does not exist' . $id
            );
        }
        #создаем новую входящую транзакцию
        $exorder_output = new OutputTransaction;
        #задаём id заявки
        $exorder_output->setExorder($exOrderCurrent);
        #создаём hash транзакции
        $newhash = $this->generateTransactionHash();
        $exorder_output->setHash($newhash);
        #задаём currency транзакции
        $currency_transaction = $exOrderCurrent->getCurrencyToSend();
        $exorder_output->setCurrency($currency_transaction);
        #задаём получателя (получатель в данном случае пользователь)
        $reveiver_address = $exOrderCurrent->getAddressOfUser();
        $exorder_output->setReceiver($reveiver_address);
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
            $walletid = $this->em->getRepository(Wallets::class)->findOneBy(['id' => $idass[$id]]); #FORTEST
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
            $oneAddress = $this->em->getRepository(Address::class)->findOneBy(['id' => $idass2[$id2]]); #FORTEST
            #получаем адрес отправителя
            $sender_address = $oneAddress->getAddress();
        } catch (\Exception $e) {
            return $this->json(["Error, address not found" => $e->getMessage()]);
        }
        $exorder_output->setSender($sender_address);
        #задаём id кошелька, с которого отправляем
        $exorder_output->setSenderWallet($walletid);
        #задаём output
        $amount = mt_rand(1, 10) / 100; #FORTEST
        $exorder_output->setAmount($amount);
        #задаём риск транзакции
        $risk_is_low = (bool) rand(0, 1); #FORTEST
        $exorder_output->setRiskIsLow($risk_is_low);  #FORTEST
        try {
            $this->em->persist($exorder_output);
            $this->em->flush();
        } catch (\Exception $e) {
            return $this->json(["Error" => $e->getMessage()]);
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
}
