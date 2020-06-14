<?php 

function getAllHorses() {
    $horses = DBcommand("SELECT * FROM horses", [])['output'];
    $count = 0;
    foreach($horses as $horseKey => $horseValue) {
        $racename = getSingleRace($horseValue['race']);
        $horses[$horseKey]['race'] = $racename['racename'];
        $count++;
    }

    return $horses;
}
function getSingleHorse($id) {
    if($id != null) {
        $horseData = DBcommand("SELECT * FROM horses WHERE id = :id", [':id' => $id])['output'][0];
        if(!isset($horseData['id'])) header("location: " . URL . "horses"); // Check if it exists
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
    // header("location: " . URL . "horses");
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

        header("location: " . URL . "horses");
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
function checkHorseEdit() {
    $tokenArray = [
        'id',
        'name',
        'race',
        'witherHeight',
        'age',
        'usedForJump'
    ];
    if(!isset($_POST['usedForJump'])) {
        $_POST['usedForJump'] = 0;
    }
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
        $errCode = DBcommand("UPDATE horses SET `name` = :name, `race` = :race, `age` = :age, `height` = :height, `used-for-jump` = :usedForJump WHERE `horses` . `id` = :id", [
            ':id' => $_POST['id'],
            ':name' => $_POST['name'],
            ':race' => $_POST['race'],
            ':age' => $_POST['age'],
            ':height' => $_POST['witherHeight'],
            ':usedForJump' => $_POST['usedForJump']
        ])['errorCode'];

        // echo $errCode;
        header("location: " . URL . "horses");
    }
}

function delRace($id) {
    if($id != null && $_SESSION['adminCode'] > 0) {
        DBcommand("DELETE FROM races WHERE id = :id", [':id' => $id]);
        $horsesToRemove = DBcommand("SELECT id FROM horses WHERE `race` = :id", [':id' => $id])['output'];
        DBcommand("DELETE FROM horses WHERE `race` = :id", [':id' => $id]);
        foreach($horsesToRemove as $horseToRemove) {
            DBcommand("DELETE FROM planning WHERE `horse-id` = :horse", [':horse' => $horseToRemove['id']]);
        }
    }
}
function delHorse($id) {
    if($id != null && $_SESSION['adminCode'] > 0) {
        DBcommand("DELETE FROM horses WHERE id = :id", [':id' => $id]);
        DBcommand("DELETE FROM planning WHERE `horse-id` = :id", [':id' => $id]);
    }
}