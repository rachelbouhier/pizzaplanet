<?php

namespace App\Form;

use App\Entity\Pizza;
use App\Entity\Ingredient;
use App\Repository\IngredientRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\ChoiceList\Factory\Cache\ChoiceAttr;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class DashboardIngredientType extends AbstractType
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
            'placeholder' => 'Choisissez l\'ingrédient à modifier ou supprimer',
            'choices' => $options,
            ]);
            // ->add('save', SubmitType::class, ['label' => 'Create Task']);
    }
}
