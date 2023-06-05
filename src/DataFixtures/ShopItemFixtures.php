<?php

namespace App\DataFixtures;

use App\Entity\Shop;
use App\Entity\Product;
use App\Entity\ShopItem;
use Doctrine\Persistence\ObjectManager;

class ShopItemFixtures extends BaseFixture
{
		public function loadData(ObjectManager $manager)
		{
				$this->createMany(ShopItem::class, 15, function($shopitem) {
                        $shopitem->setProduct($this->getRandomReference(Product::class))
						->setShop($this->getRandomReference(Shop::class)); 
				});
				$manager->flush();
		}
}