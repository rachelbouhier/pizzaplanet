<?php

namespace App\Entity;

use App\Repository\IngredientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IngredientRepository::class)]
class Ingredient
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $price = null;

    #[ORM\ManyToMany(targetEntity: Pizza::class, mappedBy: 'ingredients')]
    private Collection $pizzas;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'isAllergicTo')]
    private Collection $usersAllergicTo;

    public function __construct()
    {
        $this->pizzas = new ArrayCollection();
        $this->usersAllergicTo = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return Collection<int, Pizza>
     */
    public function getPizzas(): Collection
    {
        return $this->pizzas;
    }

    public function addPizza(Pizza $pizza): self
    {
        if (!$this->pizzas->contains($pizza)) {
            $this->pizzas->add($pizza);
            $pizza->addIngredient($this);
        }

        return $this;
    }

    public function removePizza(Pizza $pizza): self
    {
        if ($this->pizzas->removeElement($pizza)) {
            $pizza->removeIngredient($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsersAllergicTo(): Collection
    {
        return $this->usersAllergicTo;
    }

    public function addUserAllergicTo(User $userAllergicTo): self
    {
        if (!$this->usersAllergicTo->contains($userAllergicTo)) {
            $this->usersAllergicTo->add($userAllergicTo);
            $userAllergicTo->addAllergicTo($this);
        }

        return $this;
    }

    public function removeUserAllergicTo(User $userAllergicTo): self
    {
        if ($this->usersAllergicTo->removeElement($userAllergicTo)) {
            $userAllergicTo->removeAllergicTo($this);
        }

        return $this;
    }
}
