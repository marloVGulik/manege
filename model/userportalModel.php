<?php

function checkRegisterData() {
    $tokenArray = [
        'loginName',
        'name',
        'address',
        'phoneNumber',
        'password'
    ];
    $doContinue = true;
    foreach($tokenArray as $token) {
        if(isset($_POST[$token])) {
            if(strlen($_POST[$token]) < 4) {
                $doContinue = false;
            }
        } else {
            $doContinue = false;
        }
    }
    if($doContinue) {
        if(strlen($_POST['password']) > 7) {
            $passCode = hash('sha512', SALT . $_POST['password']);

            $errCode = DBcommand("INSERT INTO riders (`id`, `login-name`, `name`, `address`, `phonenumber`, `password`) VALUES (null, :loginname, :name, :address, :phonenumber, :password)", [
                ':loginname' => $_POST['loginName'],
                ':name' => $_POST['name'],
                ':address' => $_POST['address'],
                ':phonenumber' => $_POST['phoneNumber'],
                ':password' => $passCode
            ])['errorCode'];

            // echo $errCode;
            header("location: " . URL . "userportal/login");
        }
    }
}

function checkLoginData() {
    $tokenArray = [
        'loginName',
        'password'
    ];
    $doContinue = true;
    foreach($tokenArray as $token) {
        if(isset($_POST[$token])) {
            if(strlen($_POST[$token]) < 4) {
                $doContinue = false;
            }
        } else {
            $doContinue = false;
        }
    }
    if($doContinue) {
        if(strlen($_POST['password']) > 7) {
            $passCode = hash('sha512', SALT . $_POST['password']);

            $result = DBcommand("SELECT id, name, admin FROM riders WHERE `login-name` = :loginname AND `password` = :password", [
                ':loginname' => $_POST['loginName'],
                ':password' => $passCode
            ])['output'];
            
            if(count($result) == 1) {
                $_SESSION['loggedInRName'] = $result[0]['name'];
                $_SESSION['loggedIn'] = $result[0]['id'];
                $_SESSION['adminCode'] = $result[0]['admin'];
                header("location: " . URL . "home");
            }
            // echo $errCode;
        }
    }
}