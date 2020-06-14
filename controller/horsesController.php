<?php

require(ROOT . "model/horsesModel.php");

function index() {
    render("horse/index", array(
        'allHorses' => getAllHorses()
    ));
}
function races() {
    render("horse/races", array(
        'allRaces' => getAllRaces()
    ));
}
function create($action) {
    if($action == "race") {
        checkHorseRaceCreation();
        render("horse/createRace");
    } else if($action == "horse") {
        checkHorseCreation();
        render("horse/createHorse", array(
            'allRaces' => getAllRaces()
        ));
    } else {
        header("location: " . URL . "horses");
    }
}
function edit($action, $id) {
    if($action == "race") {
        checkHorseRaceEdit();
        render("horse/editRace", array('raceInfo' => getSingleRace($id)));
    } else if($action == "horse") {
        checkHorseEdit();
        $horseData = getSingleHorse($id);
        render("horse/editHorse", array(
            'allRaces' => getAllRaces(),
            'id' => $id,
            'horseData' => $horseData
        ));
    } else {
        header("location: " . URL . "horses");
    }
}
function delete($action = "-1") {
    if($action == "race") {
        delRace($_POST['id']);
        header("location: " . URL . "horses/races");
    } else if($action == "horse") {
        delHorse($_POST['id']);
        header("location: " . URL . "horses");
    } else {
        header("location: " . URL . "horses");
    }
}
function details($id = "-1") {
    $horse = getSingleHorse($id);
    if(!empty($horse)) {
        render("horse/details", array(
            'horseData' => $horse,
            'id' => $id
        ));
    }
}