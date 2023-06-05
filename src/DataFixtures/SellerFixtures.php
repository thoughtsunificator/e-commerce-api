<?php

namespace App\DataFixtures;

use App\Entity\Seller;
use Doctrine\Persistence\ObjectManager;

class SellerFixtures extends BaseFixture
{
		public function loadData(ObjectManager $manager)
		{
				$this->createMany(Seller::class, 10, function(Seller $seller, $count) {
						$seller->setName($this->faker->name())
								->setAddress($this->faker->address());
				});

				$manager->flush();
		}
}
