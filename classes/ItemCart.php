<?php

class ItemCart
{
    var $code;
    var $product;
    var $quantity;
    var $amount;

    public function __construct($code, $product, $quantity, $amount)
    {
        $this->code = $code;
        $this->product = $product;
        $this->quantity = $quantity;
        $this->amount = $amount;
    }

    public function formattedNumber($value)
    {
        return number_format($value, 2);
    }

}