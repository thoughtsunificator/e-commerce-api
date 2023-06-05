<?php

namespace App\DataFixtures;

use App\Entity\Customer;
use Doctrine\Persistence\ObjectManager;

class CustomerFixtures extends BaseFixture
{
		public function loadData(ObjectManager $manager)
		{
				$this->createMany(Customer::class, 10, function(Customer $customer, $count) {
						$customer->setFirstname($this->faker->firstName())
								->setLastname($this->faker->lastName())
								->setAddress($this->faker->address());
				});

				$manager->flush();
		}
}
