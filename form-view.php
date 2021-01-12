<?php // This files is mostly containing things for your view / html ?>
<?php
require 'index.php';
//session_start();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" type="text/css"
          rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" type="text/css"
          rel="stylesheet"/>
    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'type="text/css"
          rel="stylesheet"/>
    <link rel="stylesheet" href="styleProducts.css">

    <title>Your fancy store</title>
</head>
<body>
<div class="container">
    <h1>Place your order</h1>
    <?php // Navigation for when you need it ?>
    <?php /*
    <nav>
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link active" href="?food=1">Order food</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?food=0">Order drinks</a>
            </li>
        </ul>
    </nav>
    */ ?>
    <form method="post">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="email">E-mail:</label>
                <input type="text" id="email" name="email" class="form-control"/>
            </div>
            <div></div>
        </div>

        <fieldset>
            <legend>Address</legend>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="street">Street:</label>
                    <input type="text" name="street" id="street" class="form-control">
                </div>
                <div class="form-group col-md-6">
                    <label for="streetnumber">Street number:</label>
                    <input type="text" id="streetnumber" name="streetnumber" class="form-control">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="city">City:</label>
                    <input type="text" id="city" name="city" class="form-control">
                </div>
                <div class="form-group col-md-6">
                    <label for="zipcode">Zipcode</label>
                    <input type="text" id="zipcode" name="zipcode" class="form-control">
                </div>
            </div>
        </fieldset>

<!--        <fieldset>
            <legend>Products</legend>
            <?php /*foreach ($products as $i => $product): */?>
                <label>
                    <?php /*// <?p= is equal to <?php echo */?>
                    <input type="checkbox" value="1" name="products[<?php /*echo $i */?>]"/> <?php /*echo $product['name'] */?> -
                    &euro; <?/*= number_format($product['price'], 2) */?></label><br />
            <?php /*endforeach; */?>
        </fieldset>-->

        <fieldset>
           <!-- <div class="row">-->
                <div class="col-md-4 order-md-2 mb-4">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">Your cart</span>
                        <span class="badge badge-secondary badge-pill">3</span>
                    </h4>
                    <ul class="list-group mb-3">
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">Product name</h6>
                                <small class="text-muted">Brief description</small>
                            </div>
                            <span class="text-muted">$12</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">Second product</h6>
                                <small class="text-muted">Brief description</small>
                            </div>
                            <span class="text-muted">$8</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">Third item</h6>
                                <small class="text-muted">Brief description</small>
                            </div>
                            <span class="text-muted">$5</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between bg-light">
                            <div class="text-success">
                                <h6 class="my-0">Promo code</h6>
                                <small>EXAMPLECODE</small>
                            </div>
                            <span class="text-success">-$5</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Total (USD)</span>
                            <strong>$20</strong>
                        </li>
                    </ul>
                </div>

           <!-- </div>-->
        </fieldset>

        <fieldset>
            <legend>Products</legend>
            <div class="col-md-9">
                <div class="row g-2">
                    <?php foreach ($products as $i => $product): ?>
                        <div class="col-md-4">
                            <div class="product py-4">
                                <div class="text-center"> <img src="<?php echo $product['image'] ?>" width="200"> </div>
                                <div class="about text-center">
                                    <h5><?php echo $product['name'] ?></h5> <span> &euro; <?= number_format($product['price'], 2) ?></span>
                                </div>
                                <div class="cart-button mt-3 px-2 d-flex justify-content-between align-items-center">
                                    <div class="form-group">
                                        <button class="btn btn-primary text-uppercase" name="addCart" value="<?php echo $i ?>">Add to cart</button>
                                        <!--<span class="product_fav"><i class="fa fa-heart-o"></i></span>-->
                                    </div>
                                    <div class="col-xs-2">
                                        <div class="form-group">
                                            <!--<select  class="custom-select" name = "amount">-->
                                            <select  class="custom-select" name = "<?php echo 'quantity'.$i ?>">
                                                <?php for($i = 1; $i <= 10; $i++) {?>
                                                    <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                                <?php }?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-2">
                                        <div class="form-group">
                                            <span class="product_fav"><i class="fa fa-opencart"></i></span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </fieldset>



        <button type="submit" class="btn btn-primary">Order!</button>
    </form>

    <footer>You already ordered <strong>&euro; <?php echo $totalValue ?></strong> in food and drinks.</footer>
</div>

<style>
    footer {
        text-align: center;
    }
</style>
</body>
</html>