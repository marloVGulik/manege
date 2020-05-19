<?php

// Functie om een database verbinding op te zetten. Hij geeft het database object terug
// function openDatabaseConnection() 
// {
// 	$options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);
	
// 	$db = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET, DB_USER, DB_PASS, $options);

// 	return $db;
// }

function createConn($DBuser, $DBpass, $DBname) {
    $conn = NULL;
    try {
        $conn = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET, DB_USER, DB_PASS);
    } catch(PDOexception $exception) {
        echo $exception;
        return NULL;
    }
    return $conn;
}

// function DBcommand($connection, $statement, $args) {
function DBcommand($statement, $args) {
    foreach(array_keys($args) as $currentArgKey) {
        if($args[$currentArgKey] == NULL) {
            return ['output' => NULL, 'errorCode' => "NOT ALL THINGS SET! ERROR BACKUP"]; // It should not reach this place!
        }
        $args[$currentArgKey] = htmlspecialchars($args[$currentArgKey]);
    }

	$connection = createConn("games-bot", "JAN8dpNUIAJjoBNx", "games");
	if($connection != NULL) {
		$execStatement = $connection->prepare($statement);
		$execStatement->execute($args);
		$connection = null;
		$output = [
			'output' => $execStatement->fetchAll(),
			'errorCode' => $execStatement->errorCode()
		];
		return $output;
	}
}


// De render functie ontvangt het gevraagde bestandsnaam en heeft een data array als niet verplichte variabele
// Allereerst wordt er door de data array heen gelopen en wordt elk item omgezet in een variabele. Bijvoorbeeld: $data["voornaam"] wordt in de view beschikbaar als $voornaam
// Daarna worden er 3 bestanden ingeladen. De templates/header.php, jouw gewenste pagina en de templates/footer.php. Merk op dat .php hier al staat en je die dus niet mee hoeft te geven.
function render($filename, $data = null)
{
	if ($data) {

		foreach($data as $key => $value) {
			$$key = $value;
		}
	} 

	require(ROOT . 'view/templates/header.php');
	require(ROOT . 'view/' . $filename . '.php');
	require(ROOT . 'view/templates/footer.php');
}


// Mijn code
function printImg($location) {
    if(substr($location, 0, 4) != "http") {
        return "Data/" . $location;
    } else {
        return $location;
    }
}

function existPrintArray($arr, $key) {
    if(isset($arr[$key])) {
        return $arr[$key];
    }
    return NULL;
}