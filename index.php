<?php

// This file is your starting point (= since it's the index)
// It will contain most of the logic, to prevent making a messy mix in the html

// This line makes PHP behave in a more strict way
declare(strict_types=1);
require 'classes/Product.php';
require 'classes/ItemCart.php';
require 'classes/Cart.php';


// We are going to use session variables so we need to enable sessions
session_start();

// TODO: provide some products (you may overwrite the example)
/*$products = [
    ['name' => 'Cupcake', 'price' => 2.5, 'image' => 'https://i.imgur.com/A8qWeg8.jpeg'],
    ['name' => 'Blueberry lemon cake', 'price' => 22.5, 'image' => 'https://i.imgur.com/UfQS5r3.jpg'],
    ['name' => 'Pistachio cardamom cake', 'price' => 22.5, 'image' => 'https://i.imgur.com/cKMzbDx.jpeg'],
    ['name' => 'Salted pistachio', 'price' => 2.5, 'image' => 'https://i.imgur.com/Qmzp5JV.jpeg'],
    ['name' => 'Blueberry lemon cake', 'price' => 22.5, 'image' => 'https://i.imgur.com/UfQS5r3.jpg'],
    ['name' => 'Pistachio cardamom cake', 'price' => 22.5, 'image' => 'https://i.imgur.com/cKMzbDx.jpeg'],
    ['name' => 'Cupcake', 'price' => 2.5, 'image' => 'https://i.imgur.com/A8qWeg8.jpeg'],
    ['name' => 'Blueberry lemon cake', 'price' => 22.5, 'image' => 'https://i.imgur.com/UfQS5r3.jpg'],
    ['name' => 'Pistachio cardamom cake', 'price' => 22.5, 'image' => 'https://i.imgur.com/cKMzbDx.jpeg'],
];*/

$products[] = new Product(0, 'Cupcake', 2.5, 'https://i.imgur.com/A8qWeg8.jpeg');
$products[] = new Product(1, 'Blueberry lemon cake', 22.5, 'https://i.imgur.com/UfQS5r3.jpg');
$products[] = new Product(2, 'Pistachio cardamom cake', 22.5, 'https://i.imgur.com/cKMzbDx.jpeg');
$products[] = new Product(3, 'Raspberry cake', 20, 'https://i.imgur.com/TFCW7n1.jpg');
$products[] = new Product(4, 'Orange Curd Tartlets', 2.0, 'https://i.imgur.com/MAPever.jpeg');
$products[] = new Product(5, 'Donas', 2.0, 'https://i.imgur.com/Ortoi85.jpeg');
$products[] = new Product(6, 'Salted pistachio', 2.5, 'https://i.imgur.com/Qmzp5JV.jpeg');
$products[] = new Product(7, 'Chocolate cake', 22.5, 'https://i.imgur.com/HxDgKgB.jpg');
$products[] = new Product(8, 'Cocoa Rolls', 1.2, 'https://i.imgur.com/3FUnmgm.jpg');



$cart = new Cart();
$totalValue = 0;
$totalItems = 0;
$itemCart = [];

//Load up session
if ( !isset($_SESSION['total']) ) {
    $_SESSION['total'] = 0;
}
if (!isset($_SESSION['items'])){
    $_SESSION['items'] = 0;
}

/*if(isset($_POST['addCart'])) {
    $index = $_POST['addCart'];
    $selectedProduct = $products[$index];
    //$cart[count($cart)][] = $products[4];
    addProduct($cart, $selectedProduct);

    //  echo "This is Button1 that is selected " . $currentProduct['name'];
}*/
//Add
if (isset($_POST['addCart'])) {
    $indexCode = $_POST['addCart'];
    $quantity = $_POST['quantity'.$indexCode];

    addProduct($cart, (int)$indexCode, $products[(int)$indexCode], (int)$quantity);
    $cart = $_SESSION["cart"];
    $totalValue = $cart->calculateTotal();
    $totalItems = $cart->calculateQuantityItems();
    $_SESSION["total"] = $totalValue;
    $_SESSION['items'] = $totalItems;
    echo "<br> total".$_SESSION["total"] . "<br>";
    echo "ADD - cart variable </br>";
    var_dump($cart);
    echo "</br>ADD - SESSION CART </br>";
    var_dump($_SESSION["cart"]);
}

if (isset($_POST['removeItem'])) {
    $indexCode = $_POST['removeItem'];
    $cart = $_SESSION["cart"];
    $cart->removeItem((int)$indexCode);
    $_SESSION["cart"] = $cart;
    $totalValue = $cart->calculateTotal();
    $totalItems = $cart->calculateQuantityItems();
    $_SESSION["total"] = $totalValue;
    $_SESSION['items'] = $totalItems;
    echo "<br> total".$_SESSION["total"] . "<br>";
    echo "ADD - cart variable </br>";
    var_dump($cart);
    echo "</br>ADD - SESSION CART </br>";
    var_dump($_SESSION["cart"]);
}



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

whatIsHappening();

function addProduct($cart, $productCode, $product, $quantity)
{
    if (empty($_SESSION["cart"])) {
        echo "IF cart empty </br>";
        // $cartArray[count($cartArray)][0] = array_merge(['code' => $index, 'amount' => $amount], $product);
        $amount = $product->price * $quantity;
        $cart->addItem(new ItemCart(count($cart->items), $product, $quantity, $amount));
        $_SESSION["cart"] = $cart;
    }
    else {
        echo "IF cart with elements </br>";
        $cart = $_SESSION["cart"];
        $foundedIndex = $cart->searchItemByProductCode($productCode);
        // echo "codeIndex". $codeIndex."</br>";*/
         if ($foundedIndex !== -1) {
             echo "ELSE IF founded </br>";
             $cart->items[$foundedIndex]->quantity += $quantity;
             $addAmount = $cart->items[$foundedIndex]->product->price * $quantity;
             $cart->items[$foundedIndex]->amount += $addAmount;
             $_SESSION["cart"] = $cart;
         } else {
             echo "ELSE2 not founded </br>";
             // $cartArray[count($cartArray)][0] = array_merge(['code' => $index, 'amount' => $amount], $product);
             $amount = $product->price * $quantity;
             $cart->addItem(new ItemCart(count($cart->items), $product, $quantity, $amount));
             //$cartArray[count($cartArray)] = array_merge(['code' => $index, 'quantity' => $quantity, 'amount' => $amount], $product);
             $_SESSION["cart"] = $cart;
         }
    }

     echo "ADD - cart variable </br>";
     var_dump($cart);
     echo "</br>ADD - SESSION CART </br>";
     var_dump($_SESSION["cart"]);
 }


function getName($array)
{
    return $array[0]['name'];
}

















/*require 'form-view.php';*/