<?php

namespace App\Form;

use App\Repository\PizzaRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class RetrievePizzaIdType extends AbstractType
{
    protected $pizzaRepository;

    public function __construct(PizzaRepository $pizzaRepository)
    {
        $this->pizzaRepository = $pizzaRepository;
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $options = [];
        foreach ($this->pizzaRepository->findAll() as $pizza) {
            $options[$pizza->getName()] = $pizza->getId();
        }
    
        $builder
            ->add('pizza', ChoiceType::class, [
            'label' => 'Modifier ou supprimer une pizza',
            'choices' => $options,
            ]);
    }
}
