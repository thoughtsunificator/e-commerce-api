<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{

	private $userPasswordHasherInterface;

    public function __construct (UserPasswordHasherInterface $userPasswordHasherInterface) 
    {
        $this->userPasswordHasherInterface = $userPasswordHasherInterface;
    }

	public function load(ObjectManager $manager)
	{

		$user = new User();
		$user->setUsername('user');
		$user->setEmail('user@localhost');
		$user->setPassword( $this->userPasswordHasherInterface->hashPassword(
            $user,
            "user"
        ));
		$this->addReference($user->getUsername(), $user); 
		$manager->persist($user);

		$userAdmin = new User();
		$userAdmin->setUsername('admin');
		$userAdmin->setEmail('admin@localhost');
		$userAdmin->setPassword($this->userPasswordHasherInterface->hashPassword(
            $user,
            "password"
        ));
		$userAdmin->setRoles(["ROLE_ADMIN"]);

		$manager->persist($userAdmin);
		$manager->flush();
	}
}