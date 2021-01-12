<?php

// This file is your starting point (= since it's the index)
// It will contain most of the logic, to prevent making a messy mix in the html

// This line makes PHP behave in a more strict way
declare(strict_types=1);


// We are going to use session variables so we need to enable sessions
session_start();

// TODO: provide some products (you may overwrite the example)
$products = [
    ['name' => 'Cupcake', 'price' => 2.5, 'image' => 'https://i.imgur.com/A8qWeg8.jpeg'],
    ['name' => 'Blueberry lemon cake', 'price' => 22.5, 'image' => 'https://i.imgur.com/UfQS5r3.jpg'],
    ['name' => 'Pistachio cardamom cake', 'price' => 22.5, 'image' => 'https://i.imgur.com/cKMzbDx.jpeg'],
    ['name' => 'Salted pistachio', 'price' => 2.5, 'image' => 'https://i.imgur.com/Qmzp5JV.jpeg'],
    ['name' => 'Blueberry lemon cake', 'price' => 22.5, 'image' => 'https://i.imgur.com/UfQS5r3.jpg'],
    ['name' => 'Pistachio cardamom cake', 'price' => 22.5, 'image' => 'https://i.imgur.com/cKMzbDx.jpeg'],
    ['name' => 'Cupcake', 'price' => 2.5, 'image' => 'https://i.imgur.com/A8qWeg8.jpeg'],
    ['name' => 'Blueberry lemon cake', 'price' => 22.5, 'image' => 'https://i.imgur.com/UfQS5r3.jpg'],
    ['name' => 'Pistachio cardamom cake', 'price' => 22.5, 'image' => 'https://i.imgur.com/cKMzbDx.jpeg'],
];

//var_dump($products);

$cart = [];
$totalValue = 0;
$itemCart = [];

//Load up session
if ( !isset($_SESSION['total']) ) {
    $_SESSION['total'] = 0;
}
if (!isset($_SESSION['amount'])){
    $_SESSION['amount'] = 0;
}

/*if(isset($_POST['addCart'])) {
    $index = $_POST['addCart'];
    $selectedProduct = $products[$index];
    //$cart[count($cart)][] = $products[4];
    addProduct($cart, $selectedProduct);

    //  echo "This is Button1 that is selected " . $currentProduct['name'];
}*/
//Add
if(isset($_POST['addCart'])) {
    $index = $_POST['addCart'];
    $quantity = $_POST['quantity'.$index];
    //$selectedProduct = $products[$index];
    //$cart[count($cart)][] = $products[4];
  //  $cart[count($cart)]= [['code' => $index],];
   // var_dump($cart);
    addProduct($cart,(int)$index, $products[(int)$index], (int)$quantity);
    //$itemArray = array($productByCode[0]["code"]=>array('name'=>$productByCode[0]["name"], 'code'=>$productByCode[0]["code"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode[0]["price"], 'image'=>$productByCode[0]["image"]));

    //  echo "This is Button1 that is selected " . $currentProduct['name'];
    foreach (array_column($_SESSION["cart_item"], 'amount') as $item) {
        $totalValue += $item;
    }
    $_SESSION["total"] = $totalValue;

    echo $_SESSION["total"];
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

function addProduct($cartArray, $index, $product, $quantity) {
   // $cartArray[count($cartArray)][] = $product;

    if (empty($_SESSION["cart_item"])) {
       // $cartArray[count($cartArray)][0] = array_merge(['code' => $index, 'amount' => $amount], $product);
        $amount = $product['price'] * $quantity;
        $cartArray[count($cartArray)] = array_merge(['code' => $index, 'quantity' => $quantity, 'amount' => $amount], $product);
        $_SESSION["cart_item"] = $cartArray;
    }
    else {
       /* $codes = array_column($_SESSION["cart_item"], 'code');
        print_r($codes);*/
        $codeIndex = array_search($index, array_column($_SESSION["cart_item"], 'code'), true);
       // echo "codeIndex". $codeIndex."</br>";
        if (isset($codeIndex)){
            if (is_numeric($codeIndex)) {
                $_SESSION["cart_item"][$codeIndex]["quantity"] += $quantity;
                $addAmount = $_SESSION["cart_item"][$codeIndex]["price"] * $quantity;
                $_SESSION["cart_item"][$codeIndex]["amount"] += $addAmount;
            } else {
                echo "ELSE2 </br>";
                // $cartArray[count($cartArray)][0] = array_merge(['code' => $index, 'amount' => $amount], $product);
                $amount = $product['price'] * $quantity;
                $cartArray[count($cartArray)] = array_merge(['code' => $index, 'quantity' => $quantity, 'amount' => $amount], $product);
                $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$cartArray);
            }
        }
       else {
           echo "ELSE2 </br>";
           // $cartArray[count($cartArray)][0] = array_merge(['code' => $index, 'amount' => $amount], $product);
           $amount = $product['price'] * $quantity;
           $cartArray[count($cartArray)] = array_merge(['code' => $index, 'quantity' => $quantity, 'amount' => $amount], $product);
           $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$cartArray);

       }
    }
    echo "ADD - cartArray </br>";
    var_dump($cartArray);
    echo "</br>ADD - SESSION CART </br>";
    var_dump($_SESSION["cart_item"]);
}

    //echo implode('-', $cartArray[0][0]);
/*    foreach ($cartArray as $i => $item) {
        echo $i;
        echo implode(', ', $item[0]);
        echo $item[0]['name'];
    }*/

   // echo implode(', ', array_map('getName', $cartArray));




//}

function getName($array)
{
    return $array[0]['name'];
}

















//require 'form-view.php';