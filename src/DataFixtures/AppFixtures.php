<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{

    protected $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {

        $admin = new User();

        $hash = $this->hasher->hashPassword($admin, 'god');

        $admin->setEmail('god@gmail.com')
            ->setFullName('Andy Davis')
            ->setPassword($hash)
            ->setRoles(['ROLE_ADMIN']);
        
        $manager->persist($admin);

        $user = new User();

        $hash = $this->hasher->hashPassword($admin, 'hungry');

        $user->setEmail('hungry@gmail.com')
            ->setFullName('Wendy Davis')
            ->setPassword($hash);


        $manager->persist($user);
        $manager->flush();
    }
}
