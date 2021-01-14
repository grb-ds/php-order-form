<?php

class Product
{
    var $code;
    var $name;
    var $price;
    var $image;

    public function __construct($code, $name, $price, $image)
    {
        $this->code = $code;
        $this->name = $name;
        $this->price = $price;
        $this->image = $image;
    }

    public function formattedNumber($value)
    {
        return number_format($value, 2);
    }
}