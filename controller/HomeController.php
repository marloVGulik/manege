<?php

require(ROOT . "model/homeModel.php");
require(ROOT . "model/horsesModel.php");

function index() {
	render("home/index", array(
		'planningData' => getMyPlanningData()
	));	
}
function all() {
	render("home/index", array(
		'planningData' => getPlanningData()
	));
}

function createplanning() {
	checkCreate();
	render("home/createPlanning", array(
		'allHorses' => getAllHorses()
	));
}