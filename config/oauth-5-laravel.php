<?php

return [

	/*
	|--------------------------------------------------------------------------
	| oAuth Config
	|--------------------------------------------------------------------------
	*/

	/**
	 * Storage
	 */
	'storage' => 'Session',

	/**
	 * Consumers
	 */
	'consumers' => [

		'Xing' => [
			'client_id'     => env('XING_CONSUMER_KEY'),
			'client_secret' => env('XING_CONSUMER_SECRET')
		],

		'LinkedIn' => [
			'client_id'     => env('LINKEDIN_CONSUMER_KEY'),
			'client_secret' => env('LINKEDIN_CONSUMER_SECRET')
		],

	]

];