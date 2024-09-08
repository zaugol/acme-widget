<?php

use PHPUnit\Framework\TestCase;
use App\Basket;

class BasketTest extends TestCase
{
    private $catalogue;
    private $deliveryRules;
    private $offers;

    protected function setUp(): void
    {
        // Initialize the product catalogue
        $this->catalogue = [
            'R01' => 32.95,
            'G01' => 24.95,
            'B01' => 7.95
        ];

        // Initialize the delivery rules
        $this->deliveryRules = [
            'under_50' => 4.95,
            'under_90' => 2.95,
            'free' => 0
        ];

        // Initialize offers (this may be useful for future offers)
        $this->offers = [
            'red_widget_offer' => 'buy_one_get_second_half_price'
        ];
    }

    public function testBasketTotalForTwoRedWidgets()
    {
        // Create a new basket and add two Red Widgets (R01)
        $basket = new Basket($this->catalogue, $this->deliveryRules, $this->offers);
        $basket->add('R01');
        $basket->add('R01');

        // Total should be $32.95 + ($32.95 / 2) = $54.38
        $this->assertEquals('54.38', $basket->total());
    }

    public function testBasketTotalForMixedProducts()
    {
        // Create a new basket with a mixture of products (R01, G01)
        $basket = new Basket($this->catalogue, $this->deliveryRules, $this->offers);
        $basket->add('R01');
        $basket->add('G01');

        // Total should be $32.95 + $24.95 + $2.95 (delivery) = $60.85
        $this->assertEquals('60.85', $basket->total());
    }

    public function testBasketTotalWithMultipleProductsAndDelivery()
    {
        // Create a new basket with multiple products including delivery
        $basket = new Basket($this->catalogue, $this->deliveryRules, $this->offers);
        $basket->add('B01');
        $basket->add('B01');
        $basket->add('R01');
        $basket->add('R01');
        $basket->add('R01');

        // Total should account for three red widgets, two blue widgets, and delivery
        // (R01 + R01 (half price) + R01 + B01 + B01) + delivery = $98.28
        $this->assertEquals('98.28', $basket->total());
    }

    public function testBasketWithFreeDelivery()
    {
        // Create a new basket that qualifies for free delivery
        $basket = new Basket($this->catalogue, $this->deliveryRules, $this->offers);
        $basket->add('R01');
        $basket->add('R01');
        $basket->add('G01');
        $basket->add('G01');

        // Total should be $32.95 + $16.48 + $24.95 + $24.95 = $99.33 with free delivery
        $this->assertEquals('99.33', $basket->total());
    }

    public function testInvalidProductCodeThrowsException()
    {
        // Expect an exception for invalid product code
        $this->expectException(\InvalidArgumentException::class);

        // Create a new basket and add an invalid product
        $basket = new Basket($this->catalogue, $this->deliveryRules, $this->offers);
        $basket->add('INVALID_CODE'); // This should trigger the exception
    }
}
