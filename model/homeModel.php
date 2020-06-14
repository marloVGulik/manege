<?php 

function getPlanningData() {
    $dataArray = [];

    $planningData = DBcommand("SELECT * FROM planning", [])['output'];

    foreach($planningData as $currentPlanningKey => $currentPlanningData) {
        $plannedDate = new DateTime($planningData[$currentPlanningKey]['planned-date']);

        $dataArray[$currentPlanningKey] = array(
            'id' => $planningData[$currentPlanningKey]['id'],
            'rider' => DBcommand("SELECT `name` FROM riders WHERE `id` = :riderid", [':riderid' => $planningData[$currentPlanningKey]['rider-id']])['output'][0]['name'],
            'rider-id' => $planningData[$currentPlanningKey]['rider-id'],
            'horse' => DBcommand("SELECT `name` FROM horses WHERE `id` = :horseid", [':horseid' => $planningData[$currentPlanningKey]['horse-id']])['output'][0]['name'],
            'date' => $plannedDate->format('Y-m-d H:i:s')
        );
    }

    return $dataArray;
}
function getMyPlanningData() {
    $dataArray = [];

    $planningData = DBcommand("SELECT * FROM planning WHERE `rider-id` = :id", [':id' => $_SESSION['loggedIn']])['output'];
    

    foreach($planningData as $currentPlanningKey => $currentPlanningData) {
        $plannedDate = new DateTime($currentPlanningData['planned-date']);

        $dataArray[$currentPlanningKey] = array(
            'id' => $currentPlanningData['id'],
            'rider' => DBcommand("SELECT `name` FROM riders WHERE `id` = :riderid", [':riderid' => $currentPlanningData['rider-id']])['output'][0]['name'],
            'rider-id' => $planningData[$currentPlanningKey]['rider-id'],
            'horse' => DBcommand("SELECT `name` FROM horses WHERE `id` = :horseid", [':horseid' => $currentPlanningData['horse-id']])['output'][0]['name'],
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

function editPlanning() {
    $tokenArray = [
        'id',
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
        if($_SESSION['loggedIn'] == DBcommand("SELECT * FROM planning WHERE id = :id", [':id' => $_POST['id']])['output'][0]['user-id'] || $_SESSION['adminCode'] > 0) {
            $dt = new DateTime($_POST['setDate'] . "T" . $_POST['setTime']);
            $sendDT = $dt->format('Y-m-d\TH:i:s.u');
            $errCode = DBcommand("UPDATE planning SET `rider-id` = :riderId, `horse-id` = :horseId, `planned-date` = :plannedDate WHERE id = :id", [
                ':id' => $_POST['id'],
                ':riderId' => htmlspecialchars($_SESSION['loggedIn']),
                ':horseId' => htmlspecialchars($_POST['horseId']),
                ':plannedDate' => $sendDT
            ])['errorCode'];

            // echo $errCode;
            // die;
            header("location: " . URL . "home");
        }
    }
}

function delPlanning($id) {
    if($_SESSION['loggedIn'] == DBcommand("SELECT * FROM planning WHERE id = :id", [':id' => $_POST['id']])['output'][0]['user-id'] || $_SESSION['adminCode'] > 0) {
        if($id != null) {
            DBcommand("DELETE FROM planning WHERE id = :id", [":id" => $id]);
        }
    }
}