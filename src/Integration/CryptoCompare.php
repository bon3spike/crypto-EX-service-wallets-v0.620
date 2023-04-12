<?php
// src/Integration/CryptoCompare.php
namespace App\Integration;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Request;

# Получение

class CryptoCompare
{

    public function getCurrencyPrice($currency, $apikey)
    {
        $client = HttpClient::create();
        $response = $client->request('GET', "https://min-api.cryptocompare.com/data/price?fsym=$currency&tsyms=USD&api_key=$apikey");
        $content = $response->getContent();
        $content = $response->toArray();
        return $content;
    }
}
