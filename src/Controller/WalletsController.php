<?php

namespace App\Controller;

use App\Entity\Address;
use App\Entity\AddressMixing;
use App\Entity\Currency;
use App\Entity\OutputTransaction;
use App\Entity\Wallets;


use App\Generator\Del;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class WalletsController extends AbstractController
{
    private $doctrine;
    private $em;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
        $this->em = $doctrine->getManager();
    }
    public function checkPassword($password, $id)
    {
        $repository = $this->doctrine->getRepository(Wallets::class);
        $wallet = $repository->findOneBy(['id' => $id]);
        if (!$wallet) {
            throw $this->createNotFoundException(
                'This wallet not exist'
            );
        } else {
            $hashed_password = $wallet->getPassword();
            $passwordcheck = password_verify($password, $hashed_password);
            return $passwordcheck;
        }
    }
    public function getRandomAmmount()
    {
        $balance_random = mt_rand(1, 300) / 100; #FORTEST
        return $balance_random;
    }
    public function flushCurrencies($address, $currency, $dopcurrency, $balance)
    {
        $currencies = new Currency;
        if ($currency === 'ETH') {
            $currencies->setAddress($address);
            $currencies->setCurrency($currency);
            $currencies->setBalance($balance); #FORTEST
            $this->em->persist($currencies);
            $this->em->flush();
        } else {
            $currenciesdop = new Currency;
            $currencies->setAddress($address);
            $currencies->setCurrency($currency);
            $currencies->setBalance($balance); #FORTEST
            $this->em->persist($currencies);
            $this->em->flush();
            $currenciesdop->setAddress($address);
            $currenciesdop->setCurrency($dopcurrency);
            $currenciesdop->setBalance($balance); #FORTEST
            $this->em->persist($currenciesdop);
            $this->em->flush();
        }
        return $currencies;
    }
    public $cryptocurrencies = [
        'USDT-ERC20',
        'USDT-TRC20',
        'USDC-ERC20',
        'USDC-TRC20',
        'BTC',
        'BTC(Б)',
        'ETH',
    ];
    public function getInstansEntity($repository, $selector, $take)
    {
        $value = 0;
        $walletsAll = $repository->findBy(
            ["currency" => "$selector"],
        );

        if ($take == "sum") {
            foreach ($walletsAll as $wallet) {
                $value = $value + $wallet->getBalance();
            }
        } elseif ($take == "count") {
            foreach ($walletsAll as $wallet) {
                $value++;
            }
        } elseif ($take == "all") {
            $walletsAll = $repository->findAll();
            foreach ($walletsAll as $wallet) {
                $value++;
            }
        }
        return $value;
    }
    #[Route('/api/wallets/add/wallet', name: 'app_wallets_add_wallet', methods: ["POST"])]
    public function walletsAdd(Request $request): JsonResponse
    {
        $decoded = json_decode($request->getContent());
        $currency = $decoded->currency;
        $plaintextPassword = $decoded->password;
        $walletsAdd = new Wallets;
        switch ($currency) {
            case 'USDT(ERC20)':
            case 'USDC(ERC20)':
            case 'ETH':
                $walletsAdd->setChain('ETH');
                $chain = 'ETH';
                break;
            case 'BTC(B)':
            case 'BTC':
                $walletsAdd->setChain('BTC');
                $chain = 'BTC';
                break;
            case 'USDT(TRC20)':
            case 'USDC(TRC20)':
                $walletsAdd->setChain('TRON');
                $chain = 'TRON';
                break;
            default:
                $walletsAdd->setChain('BTC');
                $chain = 'BTC';
                break;
        }
        #генерация случайных слов публичного ключа
        try {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $master_pub_key = '';
            for (
                $i = 0;
                $i < 35;
                $i++
            ) {
                $master_pub_key .= $characters[rand(0, $charactersLength - 1)];
            }
            $walletsAdd->setMasterPubKey($master_pub_key);
        } catch (\Exception $e) {
            return $this->json(['Error, the public phrase was not set' => $e->getMessage()]);
        }
        #задание даты создания кошелька
        $date = new \DateTime;
        $walletsAdd->setCreationDate($date);
        # получение и хэширование пароля
        try {
            $hashed_password = password_hash($plaintextPassword, PASSWORD_DEFAULT);
            $walletsAdd->setPassword($hashed_password);
        } catch (\Exception $e) {
            return $this->json(['Error, password not set' => $e->getMessage()]);
        }
        $this->em->persist($walletsAdd);
        $this->em->flush();
        $data[] = [
            "id" => $walletsAdd->getId(),
            "chain" => $walletsAdd->getChain(),
            "master_pub_key" => $walletsAdd->getMasterPubKey(),
            "password" => $walletsAdd->getPassword(),
            "creation_date" => $date->format('Y-m-d H:i')
        ];
        return $this->json($data);
    }

    #[Route('/api/wallets/add/address', name: 'app_wallet_set_address_relation', methods: ["POST"])]
    public function addAddress(Request $request): JsonResponse
    {
        $address = new Address;
        #генерация адреса
        try {
            $alphabet = '123456789ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz';
            $cadRand = '';
            $alphaLength = strlen($alphabet) - 1; #FORTEST
            for ($i = 0; $i < 34; $i++) {
                $n = rand(0, $alphaLength);
                $cadRand .= $alphabet[$n];
            }
        } catch (\Exception $e) {
            return $this->json(['Error, address not created' => $e->getMessage()]);
        }
        #установление адреса 
        $idass = [];
        $decoded = json_decode($request->getContent());
        $currency = $decoded->currency;
        switch ($currency) {
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
            $repository = $this->doctrine->getRepository(Wallets::class);
            $pointer = 'chain';
            $selector = $chain;

            $entities = $repository->findBy(
                [$pointer => $selector]
            );

            foreach ($entities as $entity) {
                $idass[] =
                    $entity->getId();
            }
            $id = array_rand($idass, 1);
            $walletid = $this->doctrine->getRepository(Wallets::class)->findOneBy(['id' => $idass[$id]]); #FORTEST
        } catch (\Exception $e) {
            return $this->json(['Error, wallet not exist' => $e->getMessage()]);
        }
        #проверка на Multiple
        $multiple = true;
        try {
            switch ($currency) {
                case 'USDT(ERC20)':
                case 'USDC(ERC20)':
                case 'USDT(TRC20)':
                case 'USDC(TRC20)':
                    $multiple = true;
                    break;
                case 'BTC(B)':
                case 'BTC':
                    $multiple = false;
                    break;
                case 'ETH':
                    $multiple = false;
                    break;
            }
        } catch (\Exception $e) {
            return $this->json(['Error, multiple is not defined' => $e->getMessage()]);
        }
        try {
            #установление текущей даты создания
            $date_publ = new \DateTime();
            $address->setCreationDate($date_publ);
            #устанавливается wallet_id
            $address->setWallet($walletid);
            #устанавливается адрес кошелька
            $address->setAddress($cadRand);
            #устанавливаем multiple
            $address->setMultiple($multiple);
            #установление Derivation Path
            $address->setDerivationPath("m/44'/60'/0'/1");
            #установление даты последнего использования
            $address->setLastUsage($date_publ);
            $this->em->persist($address);
            $this->em->flush();
        } catch (\Exception $e) {
            return $this->json(['Error' => 'An error occurred, the data is not set in the database' . $e->getMessage()]);
        }
        $addressId = $address->getId();
        try {
            $currencies = new Currency;
            #задаем рандомный баланс
            $balance = $this->getRandomAmmount();
            if (($currency === 'USDT(ERC20)') | ($currency === 'USDC(ERC20)')) {
                $currencies = $this->flushCurrencies($address, $currency, 'ETH', $balance);
            } elseif (($currency === 'USDT(TRC20)') | ($currency === 'USDC(TRC20)')) {
                $currencies = $this->flushCurrencies($address, $currency, 'TRON', $balance);
            } elseif (($currency === 'BTC') | ($currency === 'BTC(B)')) {
                $currencies = $this->flushCurrencies($address, $currency, 'BTC', $balance);
            } elseif (($currency === 'ETH')) {

                $currencies = $this->flushCurrencies($address, $currency, 'ETH', $balance);
            }
        } catch (\Exception $e) {
            return $this->json(['Error, currency/currencies are not set/are set in the database' => $e->getMessage()]);
        }
        return $this->json(
            [
                "id" => $address->getId(),
                "multiple" => $address->isMultiple(),
                "walletId" => $idass[$id],
                "address" => $address->getAddress(),
                "derivation_path" => $address->getDerivationPath(),
                "last_usage" => $address->getLastUsage()->format('Y-m-d'),
                "creation_date" => $address->getCreationDate()->format('Y-m-d'),
                "currency" => $currency,
                "currency_balance" => $balance
            ]

        );
    }




    #[Route('/api/wallets/get/currentchain', name: 'app_wallets_get_currentchain', methods: ["GET"])]
    public function takeWalletsWithCurrentCurrency(Request $request): JsonResponse
    {
        try {
            $data = [];
            $chain = $request->query->get('chain');

            $repository = $this->doctrine->getRepository(Wallets::class);
            $pointer = 'chain';
            $selector = $chain;

            $entities = $repository->findBy(
                [$pointer => $selector],
            );
            foreach ($entities as $entity) {
                $data[] = [
                    "id" => $entity->getId(),
                    "chain" => $entity->getChain()
                ];
            }
        } catch (\Exception $e) {
            return $this->json(['Error, the currency search was performed incorrectly' => $e->getMessage()]);
        }
        return $this->json([
            $data
        ]);
    }






    #[Route('/api/wallets/information_for_delete', name: 'app_wallet_information_for_delete', methods: ["GET"])]
    public function DeleteWallet(Request $request, Del $del): JsonResponse
    {
        $password = $request->query->get('password');
        $id = $request->query->get('id');
        $passwordTrueFalse = $this->checkPassword($password, $id, $request);
        if ($passwordTrueFalse === true) {
            try {
                $walletRepository = $this->doctrine->getRepository(Wallets::class);
                $wallet = $walletRepository->findOneBy(['id' => $id]);
                $walletid = $wallet->getId();
                $addressRepository = $this->doctrine->getRepository(Address::class);
                $addresses = $addressRepository->findOneBy(['wallet' => $walletid]); #FORTEST
                $data = [
                    "master_pub_key" => $wallet->getMasterPubKey(),
                    "derivation_path" => $addresses->getDerivationPath()
                ];
                return $this->json($data);
            } catch (\Exception $e) {
                return $this->json(['Error, the wallet was searched incorrectly' => $e->getMessage()]);
            }
        } else {
            return $this->json('Wrong password');
        }
    }
    #[Route('/api/wallets/seedphrase_generation', name: 'app_wallets_seedphrase_generate', methods: ["GET"])]
    public function getRandomSeedPhraze(Del $del): JsonResponse
    {
        try {
            return $this->json([
                'seedphrase' => $del->randomSeedPhrase(), #FORTEST
            ]);
        } catch (\Exception $e) {
            return $this->json(['Error, seed phrase was not generated' => $e->getMessage()]);
        }
    }

    #[Route('/api/wallets/delete_wallet', name: 'app_wallets_delete_wallet', methods: ["DELETE"])]
    public function index(Request $request): JsonResponse
    {
        $id = $request->query->get('id');
        $password = $request->query->get('password');
        $passwordTrueFalse = $this->checkPassword($password, $id, $request);
        if ($passwordTrueFalse === true) {
            try {
                $walletRepository = $this->doctrine->getRepository(Wallets::class);
                $wallet = $walletRepository->findOneBy(['id' => $id]);
                $walletid = $wallet->getId();
                $addressRepository = $this->doctrine->getRepository(Address::class);
                $addresses = $addressRepository->findBy(['wallet' => $walletid]);
                $addressMixingRepository = $this->doctrine->getRepository(AddressMixing::class);
                $addressesMixing = $addressMixingRepository->findBy(['wallet' => $walletid]);
                foreach ($addresses as $address) {
                    $wallet->removeAddressId($address);
                }
                foreach ($addressesMixing as $addressMixing) {
                    $wallet->removeAddressMixing($addressMixing);
                    $this->em->remove($addressMixing);
                    $this->em->flush();
                }

                #удаляем output транзакции
                $outputtransactionsrepository = $this->doctrine->getRepository(OutputTransaction::class);
                $transactions = $outputtransactionsrepository->findBy(["sender_wallet" => $walletid]);
                foreach ($transactions as $transaction) {
                    $wallet->removeOutputTransaction($transaction);
                    $this->em->remove($transaction);
                    $this->em->flush();
                }

                try {
                    $this->em->remove($wallet);
                    $this->em->flush();
                } catch (\Exception $e) {
                    return $this->json(["Error" => $e->getMessage()]);
                }
                return $this->json('Wallet with id' . $walletid . ' ' . 'deleted successfully');
            } catch (\Exception $e) {
                return $this->json(['Error, wallet not found' => $e->getMessage()]);
            }
        } else {
            return $this->json('Wrong password');
        }
        return $this->json('Wallet deleted successfully');  #FORTEST должна быть проверка на баланс кошелька
    }

    #[Route('/api/wallets/send/getEncryptedMessage', name: 'app_wallet_send_get_encrypted_message', methods: ["GET"])]
    public function getEncryptedMessage(): JsonResponse
    {
        $getEncryptedMessage = 'This is an encrypted message';
        $data = [
            'enctypted_message' => $getEncryptedMessage
        ];
        return $this->json($data);
    }

    #[Route('/api/wallets/send/checkDecryptedMessage', name: 'app_testing', methods: ["POST"])]
    public function checkDecryptedMessage(Request $request,): JsonResponse
    {
        $decoded = json_decode($request->getContent());
        $decrypted_message = $decoded->decrypted_message;
        if ($decrypted_message === 'This is an encrypted message') {
            return $this->json('Request created');
        } elseif ($decrypted_message === '') {
            return $this->json('Decode the message');
        } else {
            return $this->json('Message decoded incorrectly');
        }
    }

    #[Route('/api/wallets/get_card', name: 'app_wallets_get_card', methods: ["GET"])]
    public function getWalletCard(Request $request,): JsonResponse
    {
        $id = $request->query->get('id');
        $password = $request->query->get('password');
        $passwordTrueFalse = $this->checkPassword($password, $id, $request);
        if ($passwordTrueFalse === true) {
            try {
                $walletRepository = $this->doctrine->getRepository(Wallets::class);
                $wallet = $walletRepository->findOneBy(['id' => $id]);
                if ($wallet) {
                    $walletid = $wallet->getId();
                    $addressRepository = $this->doctrine->getRepository(Address::class);
                    $addresses = $addressRepository->findBy(['wallet' => $walletid]);
                    $ids = [];
                    foreach ($addresses as $address) {
                        $ids[] = $address->getId();
                    }
                    $currencyRepository = $this->doctrine->getRepository(Currency::class);
                    $totalBalance = 0;
                    foreach ($ids as $addressid) {
                        $currencies = $currencyRepository->findBy(['address' => $addressid]);

                        foreach ($currencies as $currency) {
                            $result[$addressid] = [
                                'balance' => $currency->getBalance(),
                                'currency' => $currency->getCurrency()
                            ];
                            $totalBalance += $currency->getBalance();
                        }
                    }
                    $result['total_balance'] = $totalBalance;
                }
                if (empty($result)) {
                    return $this->json(['Error' => 'Wallet has no addresses']); #FORTEST после 1 этапа такого быть не должно
                } else {
                    return $this->json($result);
                }
            } catch (\Exception $e) {
                return $this->json(['Error, wallet not found' => $e->getMessage()]);
            }
        } else {
            return $this->json('Wrong password');
        }
        return $this->json('Wallet deleted successfully');  #FORTEST должна быть проверка на баланс кошелька
    }

    #[Route('/api/wallets/get_all_wallets', name: 'app_wallets_get_all_wallets', methods: ["GET"])]
    public function getAllWallets(): JsonResponse
    {
        $walletRepository = $this->doctrine->getRepository(Wallets::class);
        $wallets = $walletRepository->findAll();
        $data = [];
        foreach ($wallets as $wallet) {
            $walletid = $wallet->getId();
            $chain = $wallet->getChain();
            $created_at = $wallet->getCreationDate();
            $addressRepository = $this->doctrine->getRepository(Address::class);
            $addresses = $addressRepository->findBy(['wallet' => $walletid]);
            $ids = [];
            foreach ($addresses as $address) {
                $ids[] = $address->getId();
            }
            $currencyRepository = $this->doctrine->getRepository(Currency::class);
            $totalBalance = 0;
            $currencies = $currencyRepository->findBy(['address' => $ids]);
            foreach ($currencies as $currency) {
                $totalBalance += $currency->getBalance();
            }
            $data[] = [
                'wallet_id' => $walletid,
                'chain' => $chain,
                'total_balance' => round($totalBalance, 5),
                'created_at' => $created_at->format('Y-m-d H:i')
            ];
        }

        return $this->json($data);
    }
}
