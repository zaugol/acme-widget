<?php

require_once 'vendor/autoload.php';

use App\Basket;

// Define the product catalogue
$catalogue = [
    'R01' => 32.95,
    'G01' => 24.95,
    'B01' => 7.95
];

// Define delivery rules
$deliveryRules = [
    'under_50' => 4.95,
    'under_90' => 2.95,
    'free' => 0
];

// Define offers
$offers = [
    'red_widget_offer' => 'buy_one_get_second_half_price'
];

// Instantiate the Basket class
$basket = new Basket($catalogue, $deliveryRules, $offers);

// Add products to the basket
$basket->add('R01');
$basket->add('R01');
$basket->add('B01');
$basket->add('G01');

// Calculate and display the total
echo "Total: $" . $basket->total();
