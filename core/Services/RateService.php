<?php
namespace core\Services;

class RateService
{
    private array $users = [];

    public function convert(float $amount, string $currency)
    {
        $curlService = new CurlService();
        if($currency != 'EUR')
        {
            $rate = $curlService->call('https://developers.paysera.com/tasks/api/currency-exchange-rates', 'get', [])->rates->$currency;
            $amount = $amount / $rate;
        }

        return (float)$amount;
    }
}