<?php
// src/Generator/AddressGenerator.php
namespace App\Generator;

use App\Entity\Address;
use App\Entity\Currency;
use App\Entity\Wallets;


use Doctrine\Persistence\ManagerRegistry;

class AddressGenerator
{
    private $doctrine;
    private $em;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
        $this->em = $doctrine->getManager();
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


    public function addAddress($currency)
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
            return 'Произошла ошибка, адрес не создан';
        }
        #установление адреса 
        $idass = [];
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
            $walletid = $this->em->getRepository(Wallets::class)->findOneBy(['id' => $idass[$id]]); #FORTEST
        } catch (\Exception $e) {
            return 'Произошла ошибка, кошелёк не найден';
        }
        #проверка на Multiple
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
            return 'Произошла ошибка, Multiple не определён';
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
            return 'Произошла ошибка, данные не заданы в бд';
        }
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
            return 'Произошла ошибка, валюта/валюты не задана/заданы в бд';
        }
        $newaddress = $address->getAddress();
        $newcurrency = $currencies->getCurrency();
        $data = [
            "address" => $newaddress,
            "currency" => $newcurrency,
            "walletid" => $idass[$id]
        ];
        return $data;
    }
}
