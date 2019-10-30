<?php

namespace Tests\Unit;

use App\Actions\{
	ExchangeCurrency,
	GetExchangeRates,
};
use Tests\TestCase;

class ExchangeCurrencyTest extends TestCase
{
	// Store the mocked exchange rate for easy reuse
	protected $usdToEur = 0.8;

	/** @test */
	function it_successfully_converts_currency()
    {
    	$this->mock(GetExchangeRates::class, function ($mock) {
    		$mock
    			// Assert that GetExchangeRate's `execute(..)` method is called
    			->shouldReceive('execute')
    			// with argument 'USD'
    			->with('USD')
    			// And return this (instead of actally executing it)
    			->andReturn([
					'base' => 'USD',
					'rates' => [
						'EUR' => $this->usdToEur,
					],
				]);
    	});

    	// Instantiate through IoC and call execute 
    	$converted = app(ExchangeCurrency::class)->execute('USD', 'EUR', $amount = 3);

    	// Assert that the returned amount equals to $amount * (our mocked rate)
    	$this->assertEquals(
    		$this->usdToEur * $amount,
    		$converted
    	);
    }
}
