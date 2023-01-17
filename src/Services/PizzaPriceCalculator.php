<?php

namespace App\Services;

use App\Entity\Pizza;

class PizzaPriceCalculator 
{
    public function calculate(Pizza $pizza): int {
        $pizzaPrice = 0;
        foreach ($pizza->getIngredients() as $ingredient) {
            $ingredientPrice = $ingredient->getPrice();
            $pizzaPrice += $ingredientPrice;
        }

        return $pizzaPrice;
    }
}