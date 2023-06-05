<?php

namespace App\DataFixtures;

use App\Entity\Shop;
use App\Entity\Category;
use App\Entity\Merchant;
use Doctrine\Persistence\ObjectManager;

class ShopFixtures extends BaseFixture
{
		public function loadData(ObjectManager $manager)
		{
				$this->createMany(Shop::class, 15, function($shop) {
                        $shop->setName($this->faker->promotionCode())
						->setCategory($this->getRandomReference(Category::class))
						->setMerchant($this->getRandomReference(Merchant::class));
                        
				});

				$manager->flush();
		}
}
