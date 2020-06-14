<?php

function getAllUsers() {
    return DBcommand("SELECT `name`, `login-name`, `admin`, `id` FROM riders", [])['output'];
}
function getSingleUser($id) {
    return DBcommand("SELECT * FROM riders WHERE id = :id", [':id' => $id])['output'][0];
}
function edit($id = null) {
    if($id == null) header("location: " . URL . "adminPanel/userManagement");
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

            $errCode = DBcommand("UPDATE riders SET `login-name` = :loginname, `name` = :name, `address` = :address, `phonenumber` = :phonenumber, `password` = :password WHERE id = :id", [
                ':id' => $id,
                ':loginname' => $_POST['loginName'],
                ':name' => $_POST['name'],
                ':address' => $_POST['address'],
                ':phonenumber' => $_POST['phoneNumber'],
                ':password' => $passCode
            ])['errorCode'];

            // echo $errCode;
            header("location: " . URL . "adminPanel/userManagement");
        }
    }
}

function delete() {
    if(!isset($_POST['id'])) header("location: " . URL . "adminPanel/userManagement");
    DBcommand("DELETE FROM riders WHERE id = :id", [':id' => $_POST['id']]);
}
function grant() {
    if(!isset($_POST['id'])) header("location: " . URL . "adminPanel/userManagement");
    DBcommand("UPDATE riders SET `admin` = 1 WHERE id = :id", [':id' => $_POST['id']]);
}
function revoke() {
    if(!isset($_POST['id'])) header("location: " . URL . "adminPanel/userManagement");
    DBcommand("UPDATE riders SET `admin` = 0 WHERE id = :id", [':id' => $_POST['id']]);
}