<?php

namespace App\DataFixtures;

use App\Entity\Pizza;
use App\Repository\IngredientRepository;
use App\Repository\PizzaRepository;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class PizzaFixtures extends Fixture
{
    protected $ingredient;
    protected $pizza;
    public function __construct(IngredientRepository $ingredient, PizzaRepository $pizza)
    {
        $this->ingredient = $ingredient;
        $this->pizza = $pizza;
    }

    public function load(ObjectManager $manager): void
    {
        $pizzaMars = $this->createPizza($manager, 'Pizza Mars', 12, 'https://i.ibb.co/fpFStBJ/Settebello-Margherita-DOC-1.png');
        $pizzaSaturne = $this->createPizza($manager, 'Pizza Saturne', 14, 'https://i.ibb.co/VpRq83m/shutterstock-225746563.png');
        $pizzaLune = $this->createPizza($manager, 'Pizza Lune', 15, 'https://i.ibb.co/NVhKbk5/7f0a3782-933f-4f51-83c6-89b60216bc70-1.png');
        $manager->flush();

        $pizzaMars = $this->pizza->findOneBy(['name' => 'Pizza Mars']);
        $pizzaSaturne = $this->pizza->findOneBy(['name' => 'Pizza Saturne']);
        $pizzaLune = $this->pizza->findOneBy(['name' => 'Pizza Lune']);
        
        $tomato = $this->ingredient->findOneBy(['name' => 'Tomates']);
        $basilicum = $this->ingredient->findOneBy(['name' => 'Basilic']);
        $mozarella = $this->ingredient->findOneBy(['name' => 'Mozarella']);
        $goatCheese = $this->ingredient->findOneBy(['name' => 'Chèvre']);
        $gratedCheese = $this->ingredient->findOneBy(['name' => 'Fromage râpé']);
        $cream = $this->ingredient->findOneBy(['name' => 'Crème Fraîche']);
        $chorizo = $this->ingredient->findOneBy(['name' => 'Chorizo']);
        $gorgonzola = $this->ingredient->findOneBy(['name' => 'gorgonzola']);
        
        $pizzaMars->addIngredient($tomato)
                ->addIngredient($basilicum)
                ->addIngredient($mozarella);

        $pizzaSaturne->addIngredient($tomato)
                ->addIngredient($chorizo)
                ->addIngredient($gratedCheese);

        $pizzaLune->addIngredient($cream)
                ->addIngredient($mozarella)
                ->addIngredient($goatCheese)
                ->addIngredient($gratedCheese)
                ->addIngredient($gorgonzola);

        $manager->flush();
    }

    protected function createPizza(ObjectManager $manager, string $name, int $price, string $photo): void{
        $pizza = new Pizza();

        $pizza->setName($name)
                ->setPrice($price)
                ->setPhoto($photo);
        
        $manager->persist($pizza);
    }
}