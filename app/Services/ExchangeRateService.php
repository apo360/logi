<?php

namespace App\Services;

use App\Models\Cambio;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;

class ExchangeRateService
{

    public function getExchangeRates()
    {
        $cacheKey = 'exchange_rates';

        $cachedData = Cache::get($cacheKey);

        // Verificar se há dados em cache
        if ($cachedData) { return $cachedData; }

        $appId = 'c7fb26049f164fec9a76651964087f66';

        $client = new Client();

        try {
            $response = $client->get("https://openexchangerates.org/api/latest.json?app_id={$appId}");

            $data = json_decode($response->getBody(), true);

            // Atualizar os dados em cache com uma expiração de 24 horas
            Cache::put($cacheKey, $data, now()->addDay());

            // Salvar os dados no banco de dados
            $this->saveExchangeRatesToDatabase($data);

            // Agora $data contém as taxas de câmbio, você pode fazer o que quiser com elas
            return $data;
        } catch (\Exception $e) {
            // Trate os erros aqui, por exemplo, log ou lançar uma exceção
            throw new \Exception('Erro ao obter as taxas de câmbio.');
        }
    }

    private function saveExchangeRatesToDatabase($data)
    {
        Cambio::create([
            'dataactual' => now(),
            'GBP' => $data['rates']['GBP'],
            'EUR' => $data['rates']['EUR'],
            'USD' => $data['rates']['AOA'],
            'ZAR' => $data['rates']['ZAR'],
        ]);
    }

    public function convertCurrency($amount, $fromCurrency, $toCurrency)
    {
        // Obtenha as taxas de câmbio
        $exchangeRates = $this->getExchangeRates();

        // Verifique se as moedas de origem e destino são válidas
        if (!isset($exchangeRates['rates'][$fromCurrency]) || !isset($exchangeRates['rates'][$toCurrency])) {
            throw new \Exception('Moeda de origem ou destino inválida.');
        }

        // Calcule o valor convertido
        $convertedAmount = $amount * ($exchangeRates['rates'][$toCurrency] / $exchangeRates['rates'][$fromCurrency]);

        return number_format($convertedAmount, 2);
    }

    public function getAvailableCurrencies()
    {
        // Obtenha as taxas de câmbio
        $exchangeRates = $this->getExchangeRates();

        // Retorne a lista de moedas disponíveis
        return array_keys($exchangeRates['rates']);
    }

    public function getLastUpdateDate()
    {
        // Obtenha as taxas de câmbio
        $exchangeRates = $this->getExchangeRates();

        // Retorne a data da última atualização
        return $exchangeRates['date'];
    }

    public function getSpecificExchangeRate($fromCurrency, $toCurrency)
    {
        // Obtenha as taxas de câmbio
        $exchangeRates = $this->getExchangeRates();

        // Verifique se as moedas de origem e destino são válidas
        if (!isset($exchangeRates['rates'][$fromCurrency]) || !isset($exchangeRates['rates'][$toCurrency])) {
            throw new \Exception('Moeda de origem ou destino inválida.');
        }

        // Retorne a taxa de câmbio específica
        return $exchangeRates['rates'][$toCurrency] / $exchangeRates['rates'][$fromCurrency];
    }
}

