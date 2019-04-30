<?php

//include a file but checks if it has already been included
require_once 'core/init.php';

//initiate the class 'User()'
$user = new User();

//log the user out
$user->logout();

Redirect::to('index.php');