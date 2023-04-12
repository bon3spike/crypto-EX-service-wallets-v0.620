<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Commission;

class CommissionController extends AbstractController
{
    private $doctrine;
    private $em;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
        $this->em = $doctrine->getManager();
    }

    #[Route('/api/commission', name: 'app_commission', methods: ["PATCH"])]
    public function takeWalletsWithCurrentCurrency(Request $request): JsonResponse
    {

        $decoded = json_decode($request->getContent());
        $target = $decoded->target;
        $value = $decoded->value;
        $commission = $this->em->getRepository(Commission::class)->findOneBy([]);
        try {
            if ($target === "exchange_min") {
                $commission->setExchangeMin($value);
            } elseif ($target === "exchange_max") {
                $commission->setExchangeMax($value);
            } elseif ($target === "exchange_for_sending_high_risk") {
                $commission->setExchangeForSendingHighRisk($value);
            } elseif ($target === "exchange_for_reciving_btc_b") {
                $commission->setExchangeForBtcB($value);
            } elseif ($target === "mix_btc_min") {
                $commission->setMixBtcMin($value);
            } elseif ($target === "mix_btc_max") {
                $commission->setMixBtcMax($value);
            } elseif ($target === "mix_eth_min") {
                $commission->setMixEthMin($value);
            } elseif ($target === "mix_eth_max") {
                $commission->setMixEthMax($value);
            } elseif ($target === "mix_usdt_min") {
                $commission->setMixUsdtMin($value);
            } elseif ($target === "mix_usdt_max") {
                $commission->setMixUsdtMax($value);
            } elseif ($target === "mix_usdc_min") {
                $commission->setMixUsdcMin($value);
            } elseif ($target === "mix_usdc_max") {
                $commission->setMixUsdcMax($value);
            } elseif ($target === "mix_for_sending_high_risk") {
                $commission->setMixForSendingHighRisk($value);
            } elseif ($target === "mix_for_reciving_btc_b") {
                $commission->setMixForBtcB($value);
            } elseif ($target === "btc_per_address") {
                $commission->setBtcPerAddress($value);
            } elseif ($target === "eth_per_address") {
                $commission->setEthPerAddress($value);
            } elseif ($target === "usdt_per_address") {
                $commission->setUsdtPerAddress($value);
            } elseif ($target === "usdc_per_address") {
                $commission->setUsdcPerAddress($value);
            }
            $this->em->persist($commission);
            $this->em->flush();
        } catch (\Exception $e) {
            return $this->json(["Error:" => $e->getMessage()]);
        }
        return $this->json([

            "$target" => "$value",
        ]);
    }

    #[Route('/api/commission/get', name: 'app_commission_get', methods: ["GET"])]
    public function getCommission(): JsonResponse
    {
        $repository = $this->doctrine->getRepository(Commission::class);
        $data = [];
        # получаем все заявки на обмен
        foreach ($repository->findAll() as $entity) {
            $data[] = [
                'exchange_min' => $entity->getExchangeMin(),
                'exchange_max' => $entity->getExchangeMax(),
                'exchange_for_sending_high_risk' => $entity->getExchangeForSendingHighRisk(),
                'exchange_for_reciving_low_risk' => $entity->getExchangeForBtcB(),
                'mix_btc_min' => $entity->getMixBtcMin(),
                'mix_btc_max' => $entity->getMixBtcMax(),
                'mix_eth_min' => $entity->getMixEthMin(),
                'mix_eth_max' => $entity->getMixEthMax(),
                'mix_usdt_min' => $entity->getMixUsdtMin(),
                'mix_usdt_max' => $entity->getMixUsdtMax(),
                'mix_usdc_min' => $entity->getMixUsdcMin(),
                'mix_usdc_max' => $entity->getMixUsdcMax(),
                'mix_for_sending_high_risk' => $entity->getMixForSendingHighRisk(),
                'mix_for_reciving_low_risk' => $entity->getMixForBtcB(),
                'btc_per_address' => $entity->getBtcPerAddress(),
                'eth_per_address' => $entity->getEthPerAddress(),
                'usdt_per_address' => $entity->getUsdtPerAddress(),
                'usdc_per_address' => $entity->getUsdcPerAddress()
            ];
        }
        return $this->json($data);
    }
}
