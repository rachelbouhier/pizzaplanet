<?php

namespace App\DataFixtures;

use App\Entity\Ingredient;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class IngredientFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $this->createIngredient($manager, 'Tomates', 4);
        $this->createIngredient($manager, 'Basilic', 4);
        $this->createIngredient($manager, 'Mozarella', 4);
        $this->createIngredient($manager, 'Chorizo', 7);
        $this->createIngredient($manager, 'Fromage râpé', 3);
        $this->createIngredient($manager, 'Crème fraîche', 2);
        $this->createIngredient($manager, 'Chèvre', 4);
        $this->createIngredient($manager, 'Gorgonzola', 4);

        $manager->flush();
    }

    protected function createIngredient(ObjectManager $manager, string $name, int $price): void {
        $ingredient = new Ingredient(); 

        $ingredient->setName($name)
        ->setPrice($price);

        $manager->persist($ingredient);
    }
}
