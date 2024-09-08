<?php

namespace App;

class Basket
{
    private $catalogue;
    private $deliveryRules;
    private $offers;
    private $basket;

    public function __construct(array $catalogue, array $deliveryRules, array $offers)
    {
        $this->catalogue = $catalogue;
        $this->deliveryRules = $deliveryRules;
        $this->offers = $offers;
        $this->basket = [];
    }

    // Method to add product by code
    public function add($productCode)
    {
        if (array_key_exists($productCode, $this->catalogue)) {
            $this->basket[] = $productCode;
        } else {
            throw new \InvalidArgumentException("Invalid product code: $productCode");
        }
    }

    // Method to calculate the total price
    public function total()
    {
        $total = 0;
        $redWidgetCount = 0;

        // Calculate total and handle "buy one get second half price" offer for Red Widgets
        foreach ($this->basket as $productCode) {
            if ($productCode === 'R01') {
                $redWidgetCount++;
                // Apply half price to every second Red Widget
                if ($redWidgetCount % 2 === 0) {
                    $total += round($this->catalogue['R01'] / 2, 2);  // Round to 2 decimal places
                } else {
                    $total += $this->catalogue['R01'];
                }
            } else {
                $total += $this->catalogue[$productCode];
            }
        }

        // Apply delivery rules based on the total cost
        if ($total < 50) {
            $total += $this->deliveryRules['under_50'];
        } elseif ($total < 90) {
            $total += $this->deliveryRules['under_90'];
        }

        return number_format($total, 2);
    }
}
