<?php
	$json = file_get_contents(('php://input'));
    $object = json_decode($json);
 
    $first_name = $object->first_name;
    $last_name = $object->last_name;
    $email = $object->email;
    $company = $object->company;
    $createdAt = date('Y-m-d');
    $modifiedAt = date('Y-m-d');
try {
    $pdo = new PDO("mysql:host=localhost;dbname=essaiphp", "root", "",[PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_OBJ]);

    $query= $pdo->prepare("INSERT INTO mock_data(first_name, last_name, email, company, createdAt, modifiedAt) VALUES('" . $first_name . "', '" . $last_name . "', '" . $email . "', '" . $company . "', '" . $createdAt . "', '" . $modifiedAt . "')");
    $query->execute();


} catch (PDOException $e) {
    echo $e->getMessage();
}
