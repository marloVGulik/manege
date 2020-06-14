<?php

if($_SESSION['adminCode'] < 1) header("location: " . URL);
require(ROOT . "model/adminPanelModel.php");

function index() {
    render("admin/index");
}

function userManagement() {
    render("admin/userManagement", array(
        'users' => getAllUsers()
    ));
}

function editUser($id = null) {
    if($id == null) header("location: " . URL . "adminPanel/userManagement");
    edit($id);
    render("admin/editUser", array(
        'userData' => getSingleUser($id)
    ));
}

function deleteUser() {
    delete();
    header("location: " . URL . "adminPanel/userManagement");
}
function grantAdmin() {
    grant();
    header("location: " . URL . "adminPanel/userManagement");
}
function revokeAdmin() {
    revoke();
    header("location: " . URL . "adminPanel/userManagement");
}