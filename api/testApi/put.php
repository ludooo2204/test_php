<?php
$url = "http://127.0.0.1/test_php/api/test_php/1001"; // modifier le produit 1
$data = array('first_name' => 'ludovic', 'last_name' => 'vachon', 'email' => 'ludovic.vachon@toto.com', 'company' => 'trescal', 'createdAt' => '2021-06-29');



$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($data));

$response = curl_exec($ch);

var_dump($response);

if (!$response) 
{
    return false;
}
?>