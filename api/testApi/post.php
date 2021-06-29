<?php
	$url = 'http://127.0.0.1/test_php/api/test_php';
	$data = array('first_name' => 'ludo', 'last_name' => 'vachon', 'email' => 'ludovic.vachon@toto.com', 'company' => 'trescal', 'createdAt' => '2021-06-29');

	// use key 'http' even if you send the request to https://...
	$options = array(
		'http' => array(
			'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
			'method'  => 'POST',
			'content' => http_build_query($data)
		)
	);
	$context  = stream_context_create($options);
	$result = file_get_contents($url, false, $context);
	if ($result === FALSE) { /* Handle error */ }

	var_dump($result);
?>