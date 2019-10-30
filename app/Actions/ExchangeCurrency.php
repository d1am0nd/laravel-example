<?php

namespace App\Actions;

use App\Actions\GetExchangeRates;

class ExchangeCurrency
{
	protected $getExchangeRates;

	public function __construct(GetExchangeRates $getExchangeRates)
	{
		$this->getExchangeRates = $getExchangeRates;
	}

	public function execute(string $fromCurrency = 'USD', $toCurrency = 'EUR', int $amount = 1)
	{
		return $this
			->getExchangeRates
			->execute($fromCurrency)['rates'][$toCurrency] * $amount;
	}
}