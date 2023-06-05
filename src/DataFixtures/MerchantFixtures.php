<?php

namespace App\DataFixtures;

use App\Entity\Merchant;
use Doctrine\Persistence\ObjectManager;

class MerchantFixtures extends BaseFixture
{
		public function loadData(ObjectManager $manager)
		{
				$this->createMany(Merchant::class, 10, function(Merchant $merchant, $count) {
						$merchant->setName($this->faker->company())
								->setAddress($this->faker->address());
				});

				$manager->flush();
		}
}
