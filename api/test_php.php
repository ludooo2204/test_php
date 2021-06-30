<?php
// header('Access-Control-Allow-Origin: *');
// header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');


header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: HEAD, GET, POST, PUT, PATCH, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method,Access-Control-Request-Headers, Authorization");
header('Content-Type: application/json');
$method = $_SERVER['REQUEST_METHOD'];
if ($method == "OPTIONS") {
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method,Access-Control-Request-Headers, Authorization");
header("HTTP/1.1 200 OK");
die();
}

// Connect to database
include("db_connect.php");
// header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');

$request_method = $_SERVER["REQUEST_METHOD"];

function getItems()
{
	global $conn;
	$query = "SELECT * FROM mock_data";
	$response = array();
	$result = mysqli_query($conn, $query);
        //   echo 'lolo3';
          
	while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
	{
		$response[] = $row;
	}
	header('Content-Type: application/json');
	echo json_encode($response, JSON_PRETTY_PRINT);
}

function getItem($id = 0)
{
	global $conn;
	$query = "SELECT * FROM mock_data";
	if ($id != 0) {
		$query .= " WHERE id=" . $id . " LIMIT 1";
	}
	$response = array();
	$result = mysqli_query($conn, $query);
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		$response[] = $row;
	}
	header('Content-Type: application/json');
	echo json_encode($response, JSON_PRETTY_PRINT);
}

function AddItem()
{
	global $conn;
	$json = file_get_contents(('php://input'));
	$object = json_decode($json);
	echo ($json);




	$first_name = $object->first_name;
	$last_name = $object->last_name;
	$email = $object->email;
	$company = $object->company;
	$createdAt = date('Y-m-d');
	$modifiedAt = date('Y-m-d');
	echo $query = "INSERT INTO mock_data(first_name, last_name, email, company, createdAt, modifiedAt) VALUES('" . $first_name . "', '" . $last_name . "', '" . $email . "', '" . $company . "', '" . $createdAt . "', '" . $modifiedAt . "')";
	if (mysqli_query($conn, $query)) {
		$response = array(
			'status' => 1,
			'status_message' => 'personnne ajoutée avec succés.'
		);
	} else {
		$response = array(
			'status' => 0,
			'status_message' => 'ERREUR!.' . mysqli_error($conn)
		);
	}
	header('Content-Type: application/json');
	echo json_encode($response);
}

function updateItem($id)
{
	global $conn;
	$_PUT = array();
	parse_str(file_get_contents('php://input'), $_PUT);
	$first_name = $_PUT["first_name"];
	$last_name = $_PUT["last_name"];
	$email = $_PUT["email"];
	$company = $_PUT["company"];
	$createdAt = 'NULL';
	$modifiedAt = date('Y-m-d');
	$query = "UPDATE mock_data SET first_name='" . $first_name . "', last_name='" . $last_name . "', email='" . $email . "', company='" . $company . "', modifiedAt='" . $modifiedAt . "' WHERE id=" . $id;

	if (mysqli_query($conn, $query)) {
		$response = array(
			'status' => 1,
			'status_message' => 'item mise a jour avec succes.'
		);
	} else {
		$response = array(
			'status' => 0,
			'status_message' => 'Echec de la mise a jour de la item. ' . mysqli_error($conn)
		);
	}

	header('Content-Type: application/json');
	echo json_encode($response);
}

function deleteItem($id)
{
	global $conn;
	$query = "DELETE FROM mock_data WHERE id=" . $id;
	if (mysqli_query($conn, $query)) {
		$response = array(
			'status' => 1,
			'status_message' => 'item supprime avec succes.'
		);
	} else {
		$response = array(
			'status' => 0,
			'status_message' => 'La suppression de la item a echoue. ' . mysqli_error($conn)
		);
	}
	header('Content-Type: application/json');
	echo json_encode($response);
}

switch ($request_method) {

	case 'GET':
		// Retrive Products
		if (!empty($_GET["id"])) {
			$id = intval($_GET["id"]);
			getItem($id);
		} else {
			getItems();
		}
		break;
	default:
		// Invalid Request Method
		header("HTTP/1.0 405 Method Not Allowed");
		break;

	case 'POST':
		// Ajouter un produit
		AddItem();
		break;

	case 'PUT':
		// Modifier un produit
		$id = intval($_GET["id"]);
		updateItem($id);
		break;

	case 'DELETE':
		// Supprimer un produit
		$id = intval($_GET["id"]);
		deleteItem($id);
		break;
}
