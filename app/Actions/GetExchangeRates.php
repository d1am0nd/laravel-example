<?php

namespace App\Actions;

use GuzzleHttp\{
	RequestOptions,
	ClientInterface,
};

class GetExchangeRates
{
	protected $client;
	protected $appId;

	public function __construct(ClientInterface $client, string $appId)
	{
		$this->client = $client;
		$this->appId = $appId;
	}

	public function execute(string $baseCurrency = 'USD')
	{
		return json_decode(
			$this
				->client
				->request(
					'GET', 
					'latest.json', 
					[
						RequestOptions::QUERY => [
							'base' => $baseCurrency,
							'app_id' => $this->appId,
						],
					]
				)
				->getBody(),
			true
		);
	}
}