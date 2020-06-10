<?php

if($_SESSION['adminCode'] < 1) header("location: " . URL);

function index() {
    render("admin/index");
}