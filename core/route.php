<?php
// Met de route functie wordt bepaald welke controller en welke action er moet worden ingeladen
function route() {
	// Hier wordt de functie aangeroepen die de URL op splitst op het standaard seperatie teken (in PHP is dit een /)
	$url = splitUrl();
	print_r($url);
	// print_r(ROOT);
	// print_r(ROOT . 'controller/' . $url['controller'] . '.php');
	if (!isset($url['controller']) || $url['controller'] == NULL) { // Bestaat controller?
		require(ROOT . 'controller/' . DEFAULT_CONTROLLER . 'Controller.php');
		call_user_func('index');
	} elseif (file_exists(ROOT . 'controller/' . $url['controller'] . '.php')) { // Bestaat controller bestand?
		require(ROOT . 'controller/' . $url['controller'] . '.php');
		if (function_exists($url['action'])) { // Bestaan acties of parameters?
			if ($url['params']) {
				call_user_func_array($url['action'], $url['params']);
			} else {
				// Als ze niet bestaan, wordt alleen de functie uitgevoerd
				call_user_func($url['action']);
			}
		} else { // Error @ action
			require(ROOT . 'controller/ErrorController.php');
			call_user_func('error_404_act');
		}
	} else { // Error @ controller
		require(ROOT . 'controller/ErrorController.php');
		call_user_func('error_404_con');
	}
}

// De in de functie Route aangeroepen functie splitUrl
function splitUrl() {
	// Als er iets in de key url zit van $_GET, wordt de code uitgevoerd
	if (isset($_GET['url'])) {
		// $start_url = explode("?", $_SERVER['PHP_SELF'])[0];
		$start_url = explode("?", $_GET['url'])[0]; // ^^ De originele lijn werkt niet
		$tmp_url = trim($start_url , "/");

		// Dit haalt de vreemde karakters uit de strings weg
		$tmp_url = filter_var($tmp_url, FILTER_SANITIZE_URL);

		// Met explode splits je een string op. Elk gedeelte voor de "/" wordt in een nieuwe index van een array gestopt.
		$tmp_url = explode("/", $tmp_url);

		// Hier worden op basis van de eerder opgegeven variable $tmp_url de keys controller en action gevuld

		$url['controller'] = isset($tmp_url[0]) ? ucwords($tmp_url[0] . 'Controller') : null;
		$url['action'] = isset($tmp_url[1]) ? $tmp_url[1] : 'index';

		// Die twee waarden worden uit de array gehaald
		unset($tmp_url[0], $tmp_url[1]);

		// De overige variabelen worden in de key params gestopt

		$url['params'] = array_values($tmp_url);

		// Dit wordt teruggegeven aan de functie
		return $url;	
	}	
}
