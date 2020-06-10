<?php

require(ROOT . "model/userportalModel.php");

function register() {
    checkRegisterData();
    render("login/register");
}
function login() {
    checkLoginData();
    render("login/login");
}
function logout() {
    session_destroy();
    header("location: " . URL . "/userportal/login");
}