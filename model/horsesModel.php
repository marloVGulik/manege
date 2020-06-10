<?php 

function getAllHorses() {
    $horses = DBcommand("SELECT * FROM horses", [])['output'];
    $count = 0;
    foreach($horses as $horse) {
        $racename = DBcommand("SELECT racename FROM races WHERE id = :id", [':id' => $horse['id']])['output'];
        $horses[$count]['race'] = $racename[0]['racename'];
        $count++;
    }

    return $horses;
}
function getSingleHorse($id) {
    if($id != null) {
        $horseData = DBcommand("SELECT * FROM horses WHERE id = :id", [':id' => $id])['output'][0];
        if(!isset($horseData[0])) header("location: " . URL . "horses"); // Check if it exists

        $outputData = array(
            'name' => $horseData['name'],
            'race' => getSingleRace($horseData['race'])['racename'],
            'age' => $horseData['age'],
            'height' => $horseData['height']
        );
        if($horseData['used-for-jump'] == 0) {
            $outputData['jumps'] = "no";
        } else {
            $outputData['jumps'] = "yes";
        }

        if(getSingleRace($horseData['race'])['witherheight-max'] > $horseData['height']) {
            $outputData['ageStatus'] = "Pony";
        } else {
            $outputData['ageStatus'] = "Horse";
        }

        return $outputData;
    }
    header("location: " . URL . "horses");
}
function getAllRaces() {
    return DBcommand("SELECT * FROM races", [])['output'];
}
function getSingleRace($id) {
    return DBcommand("SELECT * FROM races WHERE id = :id", [':id' => $id])['output'][0];
}
function checkHorseRaceCreation() {
    $tokenArray = [
        'raceName',
        'minWitherHeight',
        'maxWitherHeight'
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
        $errCode = DBcommand("INSERT INTO races (`id`, `racename`, `witherheight-min`, `witherheight-max`) VALUES (null, :racename, :witherheightmin, :witherheightmax)", [
            ':racename' => htmlspecialchars($_POST['raceName']),
            ':witherheightmin' => htmlspecialchars($_POST['minWitherHeight']),
            ':witherheightmax' => htmlspecialchars($_POST['maxWitherHeight'])
        ])['errorCode'];

        // echo $errCode;
        // die;
        header("location: " . URL . "horses");
    }
}
function checkHorseCreation() {
    $tokenArray = [
        'name',
        'race',
        'witherHeight',
        'age',
        'usedForJump'
    ];
    $doContinue = true;
    if(!isset($_POST['usedForJump'])) {
        $_POST['usedForJump'] = false;
    } else {
        $_POST['usedForJump'] = true;
    }

    foreach($tokenArray as $token) {
        if(!isset($_POST[$token])) {
            $doContinue = false;
        }
    }

    if($doContinue) {
        $errCode = DBcommand("INSERT INTO horses (`id`, `name`, `race`, `age`, `height`, `used-for-jump`) VALUES (null, :name, :race, :age, :witherheight, :usedForJump)", [
            ':name' => $_POST['name'],
            ':race' => $_POST['race'],
            ':age' => $_POST['age'],
            ':witherheight' => $_POST['witherHeight'],
            ':usedForJump' => $_POST['usedForJump']
        ])['errorCode'];

        header("location: " . URL . "horses/races");
    }
}
function checkHorseRaceEdit() {
    $tokenArray = [
        'id',
        'raceName',
        'minWitherHeight',
        'maxWitherHeight'
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
        $errCode = DBcommand("UPDATE races SET `racename` = :racename, `witherheight-min` = :witherheightmin, `witherheight-max` = :witherheightmax WHERE `id` = :id", [
            ':id' => $_POST['id'],
            ':racename' => htmlspecialchars($_POST['raceName']),
            ':witherheightmin' => htmlspecialchars($_POST['minWitherHeight']),
            ':witherheightmax' => htmlspecialchars($_POST['maxWitherHeight'])
        ])['errorCode'];

        // echo $errCode;
        // die;
        header("location: " . URL . "horses/races");
    }
}

function delRace($id) {
    if($id != null) {
        DBcommand("DELETE FROM races WHERE id = :id", [':id' => $id]);
    } else {
        echo "uwu";
    }
}
function delHorse($id) {
    if($id != null) {
        DBcommand("DELETE FROM horses WHERE id = :id", [':id' => $id]);
    }
}