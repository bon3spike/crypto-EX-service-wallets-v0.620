<?php

namespace App\Controller;

use App\Integration\CryptoCompare;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class PriceController extends AbstractController
{
    #[Route('/api/price/currencies', name: 'app_get_price_currencies', methods: ["GET"])]
    public function index(Request $request, CryptoCompare $integration): JsonResponse
    {
        $take = $request->query->get('take');
        $apikey = $request->query->get('key');
        $currency = $request->query->get('currency');
        try {
            $price = $integration->getCurrencyPrice($currency, $apikey);
        } catch (\Exception $e) {
            return $this->json(["Error: " . $e->getMessage()]);
        }
        if ($take === 'all') {
            $currencies = ['BTC', 'ETH', 'USDT', 'USDC'];
            $prices = [];
            foreach ($currencies as $currency) {
                $price = $integration->getCurrencyPrice($currency, $apikey);
                $prices[$currency] = $price;
            }
            return $this->json($prices);
        } elseif ($take === 'current') {

            if ($currency === 'BTC') {
                return $this->json([
                    'BTC' => $price
                ]);
            } elseif ($currency === 'ETH') {
                return $this->json([
                    'ETH' => $price
                ]);
            } elseif ($currency === 'USDC') {
                return $this->json([
                    'USDC' => $price
                ]);
            } elseif ($currency === 'USDT') {
                return $this->json([
                    'USDT' => $price
                ]);
            }
        }
    }
}
