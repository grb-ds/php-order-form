<?php

// This file is your starting point (= since it's the index)
// It will contain most of the logic, to prevent making a messy mix in the html

// This line makes PHP behave in a more strict way
declare(strict_types=1);

// We are going to use session variables so we need to enable sessions
session_start();

// Use this function when you need to need an overview of these variables
function whatIsHappening() {
    echo '<h2>$_GET</h2>';
    var_dump($_GET);
    echo '<h2>$_POST</h2>';
    var_dump($_POST);
    echo '<h2>$_COOKIE</h2>';
    var_dump($_COOKIE);
    echo '<h2>$_SESSION</h2>';
    var_dump($_SESSION);
}

// TODO: provide some products (you may overwrite the example)
$products1 = [
    ['name' => 'Your favourite drink', 'price' => 2.5],
];

$products = [
    ['name' => 'cupcake', 'price' => 2.5, 'image' => 'https://i.imgur.com/A8qWeg8.jpeg'],
    ['name' => 'cupcake1', 'price' => 2.5, 'image' => 'https://i.imgur.com/A8qWeg8.jpeg'],
    ['name' => 'cupcake2', 'price' => 2.5, 'image' => 'https://i.imgur.com/A8qWeg8.jpeg'],
];

$totalValue = 0;

//require 'form-view.php';