<?php 

session_start();

$_SESSION = [];

header('location: /bienesraices');

var_dump($_SESSION);