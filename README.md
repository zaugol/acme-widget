# Acme Widget (Proof of Concept)

## Overview

This is a proof of concept for Acme Widget's new sales system. It includes functionality for adding products to a basket, calculating the total price with special offers and delivery charges, and testing the overall logic with PHPUnit.

### Products

The system handles the following products:

- **Red Widget (R01)**: $32.95
- **Green Widget (G01)**: $24.95
- **Blue Widget (B01)**: $7.95

### Special Offers

The system currently implements a special offer for red widgets (**R01**):

- **Buy One Red Widget, Get the Second Half Price**: When two red widgets are added to the basket, the second one is discounted to half of its original price.

### Delivery Charges

Delivery charges are based on the total amount spent:

- Orders below $50: $4.95 delivery charge.
- Orders between $50 and $90: $2.95 delivery charge.
- Orders of $90 or more: Free delivery.