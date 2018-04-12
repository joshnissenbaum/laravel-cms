<?php 

return array( 
	
	/*
	|--------------------------------------------------------------------------
	| Pusher Config
	|--------------------------------------------------------------------------
	|
	| Pusher is a simple hosted API for quickly, easily and securely adding
	| realtime bi-directional functionality via WebSockets to web and mobile 
	| apps, or any other Internet connected device.
	|
	| NOTE: The options debug, host, port and timeout is deprecated.
	| Please use this values inside the options field.
	*/

	/**
	 * App id
	 */
	'app_id' => '256966', 

	/**
	 * App Key
	 */
	'key' => 'da9dfe71098e7b5e7d2c',

	/**
	 * App Secret
	 */
	'secret' => '037e63816069941ddf4a',
    
    'cluster' => 'ap1',

	/**
	 * App Options
	 * Avaliables: scheme, host, port, timeout, encrypted
	 */
	'options' => array(
        'cluster' => 'ap1',
		'encrypted' => 'true'
	),
);
