<?php

class Cart
{
    var $items;
    var $total;
    var $quantity;

    public function __construct()
    {
        $this->items = [];
        $this->total = 0.00;
        $this->quantity = 0;
    }

    public function addItem($item)
    {
        $this->items[] = $item;
    }

    public function removeItem($itemCode)
    {
        $index = $this->searchItemByItemCode($itemCode);
        if ($index > -1) {
             unset($this->items[$index]);
        }
        echo "<br> remove item <br>";
        var_dump($this->items);
    }

    public function searchItemByProductCode($productCode)
    {
        $index = -1; //Not found
        foreach ($this->items as $key => $item){
            if ($item->product->code === $productCode) {
                $index = $key;
                break;
            }
        }
        return $index;
    }

    public function searchItemByItemCode($itemCode)
    {
        $index = -1; //Not found
        foreach ($this->items as $key => $item){
            if ($item->code === $itemCode) {
                $index = $key;
                break;
            }
        }
        return $index;
    }

    public function calculateTotal()
    {
        $this->total = 0.00;
        foreach ($this->items as $key => $item){
            $this->total += $item->amount;
        }
        return $this->total;
    }

    public function calculateQuantityItems()
    {
        $this->quantity = 0.00;
        foreach ($this->items as $key => $item){
            $this->quantity += $item->quantity;
        }
        return $this->quantity;
    }

    public function formattedNumber($value)
    {
        return number_format($value, 2);
    }

}

