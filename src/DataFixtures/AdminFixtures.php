<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Encoder\PasswordHasherEncoder;

class AdminFixtures extends Fixture
{
    public function __construct(private readonly UserPasswordHasherInterface $hasher) {}

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setEmail('kamil.marynovski@gmail.com');
        $user->setRoles(['ROLE_ADMIN', 'ROLE_USER']);
        $user->setPassword($this->hasher->hashPassword($user, '123456'));

        $manager->persist($user);
        $manager->flush();
    }
}
