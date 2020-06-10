<?php 

function getPlanningData() {
    $dataArray = [];

    $planningData = DBcommand("SELECT * FROM planning", [])['output'];

    for($i = 0; $i < count($planningData); $i++) {
        $plannedDate = new DateTime($planningData[$i]['planned-date']);

        $dataArray[$i] = array(
            'id' => $planningData[$i]['id'],
            'rider' => DBcommand("SELECT `name` FROM riders WHERE `id` = :riderid", [':riderid' => $planningData[$i]['rider-id']])['output'][0]['name'],
            'horse' => DBcommand("SELECT `name` FROM horses WHERE `id` = :horseid", [':horseid' => $planningData[$i]['horse-id']])['output'][0]['name'],
            'date' => $plannedDate->format('Y-m-d H:i:s')
        );
    }

    return $dataArray;
}
function getMyPlanningData() {
    $dataArray = [];

    $planningData = DBcommand("SELECT * FROM planning WHERE `rider-id` = :id", [':id' => $_SESSION['loggedIn']])['output'];

    for($i = 0; $i < count($planningData); $i++) {
        $plannedDate = new DateTime($planningData[$i]['planned-date']);

        $dataArray[$i] = array(
            'id' => $planningData[$i]['id'],
            'rider' => DBcommand("SELECT `name` FROM riders WHERE `id` = :riderid", [':riderid' => $planningData[$i]['rider-id']])['output'][0]['name'],
            'horse' => DBcommand("SELECT `name` FROM horses WHERE `id` = :horseid", [':horseid' => $planningData[$i]['horse-id']])['output'][0]['name'],
            'date' => $plannedDate->format('Y-m-d H:i:s')
        );
    }

    return $dataArray;
}

function checkCreate() {
    $tokenArray = [
        'horseId',
        'setDate',
        'setTime'
    ];
    $doContinue = true;
    foreach($tokenArray as $token) {
        if(isset($_POST[$token])) {
            if(strlen($_POST[$token]) < 1) {
                $doContinue = false;
            }
        } else {
            $doContinue = false;
        }
    }
    if($doContinue) {
        $dt = new DateTime($_POST['setDate'] . "T" . $_POST['setTime']);
        $sendDT = $dt->format('Y-m-d\TH:i:s.u');
        $errCode = DBcommand("INSERT INTO planning (`id`, `rider-id`, `horse-id`, `planned-date`) VALUES (null, :riderId, :horseId, :plannedDate)", [
            ':riderId' => htmlspecialchars($_SESSION['loggedIn']),
            ':horseId' => htmlspecialchars($_POST['horseId']),
            ':plannedDate' => $sendDT
        ])['errorCode'];

        // echo $errCode;
        // die;
        header("location: " . URL . "home");
    }
}