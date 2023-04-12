<?php

namespace App\Controller;

use App\Entity\Currency;
use App\Handler\MessageHandler;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class WalletsStatisticController extends AbstractController
{
    public $cryptocurrencies = [
        'USDT(ERC20)',
        'USDT(TRC20)',
        'USDC(ERC20)',
        'USDC(TRC20)',
        'BTC',
        'BTC(B)',
        'ETH',
    ];

    private $doctrine;
    private $em;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
        $this->em = $doctrine->getManager();
    }

    public function getInstansEntity($repository, $selector, $take)
    {
        $valuev = 0;

        $currencies = $repository->findBy(
            ["currency" => "$selector"],
        );

        if ($take == "sum") {
            foreach ($currencies as $currency) {
                $valuev = $valuev + $currency->getBalance();
            }
        } elseif ($take == "count") {
            foreach ($currencies as $currency) {
                $valuev++;
            }
        } elseif ($take == "all") {
            $currencies = $repository->findAll();
            foreach ($currencies as $currency) {
                $valuev++;
            }
        }
        return $valuev;
    }

    #[Route('/api/wallet/statistic/add', name: 'app_wallet_statistictest', methods: ["GET"])]
    public function getcurrencies(Request $request): JsonResponse
    {
        $take = $request->query->get('take');
        $data = [];
        $repository = $this->doctrine->getRepository(Currency::class);
        # вывод суммы кошельков
        if ($take == "stat") {


            foreach ($this->cryptocurrencies as $id) {
                $data[] = [
                    "currency_type" => $id,
                    "total_currencies" => $this->getInstansEntity($repository, $id, 'count'),
                    "total_balance" => $this->getInstansEntity($repository, $id, 'sum'),

                ];
            }
        } elseif ($take == "total") {
            $data[] = [

                "total_currencies" => $this->getInstansEntity($repository, 'all', 'all'),
                "total_balance_usd" => "125259",  #FORTEST
            ];
        }
        return $this->json($data);
    }
}
