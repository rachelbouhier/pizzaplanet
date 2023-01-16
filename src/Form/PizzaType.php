<?php

namespace App\Form;

use App\Entity\Pizza;
use App\Entity\Ingredient;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;

class PizzaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom de la pizza',
                'attr' => [
                    'placeholder' => 'Tapez le nom de la pizza'
                ]
            ])
            ->add('photo', UrlType::class, [
                'label' => 'URL de la photo',
                'attr' => [
                    'placeholder' => 'Entrez l\'URL de la photo'
                ]
            ])
            ->add('price', MoneyType::class, [
                'label' => 'Prix de la pizza',
                'disabled' => true
            ])
            ->add('ingredients', EntityType::class, [
                'label' => 'Ajoutez des ingrédients',
                'placeholder' => 'Choisir les ingrédients',
                'class' => Ingredient::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
            ]);
        
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Pizza::class,
        ]);
    }
}