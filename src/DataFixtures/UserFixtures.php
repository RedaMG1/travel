<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $email = "admin@exemple.com";
        $existingUser = $manager->getRepository(User::class)->findOneBy(['email' => $email]);
        if(!$existingUser){
  

        $user->setEmail($email);
        $user->setFirstName("Jimmy");
        $user->setLastName("MG");
        $user->setLastName(21);
        $user->setRoles(['ROLE_ADMIN']);
        $user->setPassword($this->passwordHasher->hashPassword($user, 'password'));
        

        $manager->persist($user);
        $manager->flush();}
    }
}
