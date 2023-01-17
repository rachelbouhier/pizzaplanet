<?php

namespace App\Form;

use App\Repository\IngredientRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class RetrieveIngredientIdType extends AbstractType
{
    protected $ingredientRepository;

    public function __construct(IngredientRepository $ingredientRepository)
    {
        $this->ingredientRepository = $ingredientRepository;
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $options = [];
        foreach ($this->ingredientRepository->findAll() as $ingredient) {
            $options[$ingredient->getName()] = $ingredient->getId();
        }
    
        $builder
            ->add('ingredient', ChoiceType::class, [
            'label' => 'Modifier ou supprimer un ingrédient',
            'choices' => $options,
            ]);
    }
}
