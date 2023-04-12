<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Statistics;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;

# ВРЕМЕННО будет доработан после реализации функционала транзакций

class StatisticsController extends AbstractController
{
    private $doctrine;
    private $em;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
        $this->em = $doctrine->getManager();
    }

    public function getAllOf($entity, $atomic, $range, $coin, $from, $datatype)
    {

        $counter = 0;
        $middleweare = 0;
        $coin = strtoupper($coin);
        if ($from == "exchange") {
            foreach ($entity as $id) {
                if ($id->getDate()->format($range) == $atomic) {
                    if ($coin == 'BTC') {
                        $middleweare = $middleweare + 1;
                        $counter = $counter + $id->getExchangeOrderBtc();
                    } elseif ($coin == 'ETH') {
                        $counter = $counter + $id->getExchangeOrderEth();
                        $middleweare = $middleweare + 1;
                    } elseif ($coin == 'USDC') {
                        $counter = $counter + $id->getExchangeOrderUsdc();
                        $middleweare = $middleweare + 1;
                    } elseif ($coin == 'USDT') {
                        $counter = $counter + $id->getExchangeOrderUsdt();
                        $middleweare = $middleweare + 1;
                    }
                }
            }
        } elseif ($from == "mixing") {
            foreach ($entity as $id) {


                if ($id->getDate()->format($range) == $atomic) {

                    if ($coin == 'BTC') {
                        $middleweare = $middleweare + 1;
                        $counter = $counter + $id->getMixingOrderBtc();
                    } elseif ($coin == 'ETH') {
                        $counter = $counter + $id->getMixingOrderEth();
                        $middleweare = $middleweare + 1;
                    } elseif ($coin == 'USDC') {

                        $counter = $counter + $id->getMixingOrderUsdc();
                        $middleweare = $middleweare + 1;
                    } elseif ($coin == 'USDT') {

                        $counter = $counter + $id->getMixingOrderUsdt();
                        $middleweare = $middleweare + 1;
                    }
                }
            }
        }



        if ($datatype == "counting") {

            return $middleweare;
        } elseif ($datatype == "average") {
            if ($middleweare == 0) {
                $middleweare++;
            }
            return $counter / $middleweare;
        }
    }

    #[Route("/api/statistics", name: "app_statistics", methods: ["GET"])]
    public function index(Request $request): Response
    {

        $take = $request->query->get('take');

        if ($take == "create") {
            $randomDateTime = new \DateTime();
            $datecreate = $request->query->get('datecreate');
            $dateTime = $randomDateTime->setTimestamp(rand(strtotime($datecreate), time()));
            #задаем формат даты

            $statistics = new Statistics();
            if ($dateTime instanceof \DateTimeInterface) {
                $statistics->setDate($dateTime);
                return $this->json(['Error' => "Successfully set date\n"]);
            } else {
                return $this->json(['Error' => 'Wrong date format, should be format: 2015-12-01 (Year-Month-Day)']);
            }
            #сделали проверку даты на правильный формат



            $statistics->setExchangeOrderAmountEth(mt_rand(1, 300) / 100);

            $statistics->setExchangeOrderAmountBtc(mt_rand(1, 300) / 100);

            $statistics->setExchangeOrderAmountUsdc(mt_rand(1, 300) / 100);

            $statistics->setExchangeOrderAmountUsdt(mt_rand(1, 300) / 100);

            $statistics->setMixingOrderAmountEth(mt_rand(1, 300) / 100);

            $statistics->setMixingOrderAmountBtc(mt_rand(1, 300) / 100);

            $statistics->setMixingOrderAmountUsdc(mt_rand(1, 300) / 100);

            $statistics->setMixingOrderAmountUsdt(mt_rand(1, 300) / 100);

            $statistics->setExchangeOrderEth(mt_rand(1, 300) / 100);

            $statistics->setExchangeOrderBtc(mt_rand(1, 300) / 100);

            $statistics->setExchangeOrderUsdc(mt_rand(1, 300) / 100);

            $statistics->setExchangeOrderUsdt(mt_rand(1, 300) / 100);

            $statistics->setMixingOrderEth(mt_rand(1, 300) / 100);

            $statistics->setMixingOrderBtc(mt_rand(1, 300) / 100);

            $statistics->setMixingOrderUsdc(mt_rand(1, 300) / 100);

            $statistics->setMixingOrderUsdt(mt_rand(1, 300) / 100);

            $statistics->setRevenueEth(mt_rand(1, 300) / 100);

            $statistics->setRevenueBtc(mt_rand(1, 300) / 100);

            $statistics->setRevenueUsdc(mt_rand(1, 300) / 100);

            $statistics->setRevenueUsdt(mt_rand(1, 300) / 100);

            #задали все параметры

            $this->em->persist($statistics);
            $this->em->flush();
            return $this->json(["message" => "All data was successfully generated and loaded into the database"]);
        }


        $repository = $this->doctrine->getRepository(Statistics::class);

        $data = [];

        if ($take == "all") {
            foreach ($repository->findAll() as $entity) {
                $data[] = [
                    "ID" => $entity->getId(),
                    [
                        "exchangeOrderAmount", [
                            "eth" => $entity->getExchangeOrderAmountEth(),
                            "btc" => $entity->getExchangeOrderAmountBtc(),
                            "usdc" => $entity->getExchangeOrderAmountUsdc(),
                            "usdt" => $entity->getExchangeOrderAmountUsdt()
                        ],
                        "mixingOrderAmount", [
                            "eth" => $entity->getMixingOrderAmountEth(),
                            "btc" => $entity->getMixingOrderAmountBtc(),
                            "usdc" => $entity->getMixingOrderAmountUsdc(),
                            "usdt" => $entity->getMixingOrderAmountUsdt()
                        ],
                        "exchangeOrder", [
                            "eth" => $entity->getExchangeOrderEth(),
                            "btc" => $entity->getExchangeOrderBtc(),
                            "usdc" => $entity->getExchangeOrderUsdc(),
                            "usdt" => $entity->getExchangeOrderUsdt()
                        ],
                        "MixingOrder", [
                            "eth" => $entity->getMixingOrderEth(),
                            "btc" => $entity->getMixingOrderBtc(),
                            "usdc" => $entity->getMixingOrderUsdc(),
                            "usdt" => $entity->getMixingOrderUsdt()
                        ],
                        "Revenue", [
                            "eth" => $entity->getRevenueEth(),
                            "btc" => $entity->getRevenueBtc(),
                            "usdc" => $entity->getRevenueUsdc(),
                            "usdt" => $entity->getRevenueUsdt()
                        ]

                    ]
                ];
            }
        } elseif ($take == "current") {


            $atomic = $request->query->get('atomic');
            $range = $request->query->get('range');
            $coin = $request->query->get('coin');
            $from = $request->query->get('from');
            $datatype = $request->query->get('datatype');
            $entity = $repository->findAll();
            $how_many_years = [];
            $how_many_week = [];
            # поиск уникальных лет
            foreach ($entity as $year) {
                if (!in_array($year->getDate()->format('Y'), $how_many_years)) {
                    $how_many_years[] = $year->getDate()->format('Y');
                }
            }

            for ($i = 1; $i <= 52; $i++) {

                $how_many_week[] = $i;
            }

            asort($how_many_years);
            asort($how_many_week);

            # вывод все - год
            if ($range == "all" && $atomic == "Y") {
                foreach ($how_many_years as $year) {
                    $data[] = [$year => $this->getAllOf($entity, $year, $atomic, $coin, $from, $datatype)];
                }
                return $this->json($data);
            }
            # вывод все - месяц
            if ($range == "all" && $atomic == "m") {
                $months = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];
                $dates = [];
                foreach ($how_many_years as $year) {
                    foreach ($months as $month) {
                        $dates[] = $year . '-' . $month;
                    }
                }
                $innerRange = "Y-m";
                foreach ($dates as $date) {
                    $data[] = [
                        $date =>  $this->getAllOf($entity, $date, $innerRange,  $coin, $from, $datatype)
                    ];
                }
                return $this->json($data);
            }

            # вывод все - неделя
            if ($range == "all" && $atomic == "W") {
                $innerRange = "Y-W";
                $dates = [];
                foreach ($how_many_years as $year) {
                    foreach ($how_many_week as $week) {
                        $dates[] = $year . '-' . $week;
                    }
                }
                foreach ($dates as $date) {
                    $data[] = [
                        $date =>  $this->getAllOf($entity, $date, $innerRange,  $coin, $from, $datatype)
                    ];
                }
                return $this->json($data);
            }
            # вывод все - день
            if ($range == "all" && $atomic == "d") {
                $months = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];
                $dates = [];
                $innerRange = "Y-m-d";
                foreach ($how_many_years as $year) {
                    foreach ($months as $month) {
                        $dates[] = $year . '-' . $month;
                    }
                }
                foreach ($dates as $date) {
                    $days = new \DateTime($date);
                    $daysInMonth = $days->format('t');
                    for ($i = 1; $i <= $daysInMonth; $i++) {
                        $atomic = $date . '-' . $i;
                        $data[] = [
                            $atomic =>  $this->getAllOf($entity, $atomic, $innerRange, $coin, $from, $datatype)
                        ];
                    }
                }
                return $this->json($data);
            }
            # вывод год - месяц
            elseif ($range == "Y" && $atomic == "m") {
                for ($i = 1; $i <= 12; $i++) {
                    $data[] = [
                        $i =>  $this->getAllOf($entity, $i, $atomic, $coin, $from, $datatype)
                    ];
                }
                return $this->json($data);
            }
            # вывод год - неделя
            # пройтись циклом по каждой недели из года ии собрать значения
            elseif ($range == "Y" && $atomic == "W") {
                $days = new \DateTime();
                $nowyear = $days->format('o');
                $months = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];
                $datesMY = [];
                $datesMYW = [];
                foreach ($months as $month) {
                    $datesMY[] = $nowyear . '-' . $month;
                }
                $weeksCounter = 1;
                foreach ($datesMY as $date) {
                    for ($i = 1; $i <= 4; $i++) {
                        if ($weeksCounter < 10) {
                            $datesMYW[] = $date . "-0" .  $weeksCounter;
                        } else {
                            $datesMYW[] = $date . "-" .  $weeksCounter;
                        }
                        $weeksCounter++;
                    }
                }
                $atomic = "Y-m-W";
                foreach ($datesMYW as $date) {
                    $data[] = [
                        $date =>  $this->getAllOf($entity, $date, $atomic, $coin, $from, $datatype)
                    ];
                }
                return $this->json($data);
            }
            # вывод год - день
            elseif ($range == "Y" && $atomic == "d") {
                for ($i = 1; $i <= 365; $i++) {
                    $data[] = [
                        $i =>  $this->getAllOf($entity, $i, $atomic, $coin, $from, $datatype)
                    ];
                }
                return $this->json($data);
            }
            # вывод месяц - неделя
            elseif ($range == "m" && $atomic == "W") {
                $days = new \DateTime(); // получаем текущую дату + текущую неделю 2023-02-06
                $nowYm = $days->format('Y-m'); // берем только год и месяц
                $days = new \DateTime($nowYm); // сгенерировали все даты внутри 2023-02 
                $manyweeksinM =  ltrim($days->format('W'), '0'); // сгенерировали все даты внутри 2023-02 
                if ($manyweeksinM == 52) {
                    $manyweeksinM = 1;
                };
                for ($i = 1; $i <= 4; $i++) {
                    $data[] = [
                        $i =>  $this->getAllOf($entity, $manyweeksinM, $atomic, $coin, $from, $datatype)
                    ];
                    $manyweeksinM++;
                }
                return $this->json($data);
            }
            # вывод месяц - день
            elseif ($range == "m" && $atomic == "d") {
                $days = new \DateTime();
                $nowYm = $days->format('Y-m');
                $days = new \DateTime($nowYm);
                $manyweeksinM =  $days->format('t');
                $atomic = 'Y-m-d';
                for ($i = 1; $i <= $manyweeksinM; $i++) {
                    if ($i < 10) {
                        $innerRange = $nowYm . '-0' . $i;
                    } else {
                        $innerRange = $nowYm . '-' . $i;
                    }
                    $data[] = [
                        $innerRange =>  $this->getAllOf($entity, $innerRange, $atomic, $coin, $from, $datatype)
                    ];
                }
                return $this->json($data);
            }
            # вывод неделя - день
            elseif ($range == "W" && $atomic == "d") {
                $days = new \DateTime();
                $nowYm = $days->format('Y-m-W');
                $days = new \DateTime($nowYm);
                $daysInMonth = $days->format('t');
                $daysInWeek = $days->format('W-d');
                $currentW = $days->format('W');
                $startDayOfWeek = ltrim(ltrim($daysInWeek, $currentW), '-0');
                $atomic = 'Y-m-W-d';
                for ($i = 1; $i <= 7; $i++) {
                    if ($startDayOfWeek < 10) {
                        $innerRange = $nowYm . '-0' .  $startDayOfWeek;
                    } else {
                        $innerRange = $nowYm . '-' .  $startDayOfWeek;
                    }
                    $data[] = [
                        $innerRange =>  $this->getAllOf($entity, $innerRange, $atomic, $coin, $from, $datatype)
                    ];
                    $startDayOfWeek++;
                }
                return $this->json($data);
            }
        }
        return new Response('Incorrect request type, read the documentation');
    }
}
