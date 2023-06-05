<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends BaseFixture
{
		public function loadData(ObjectManager $manager)
		{
				$this->createMany(Category::class, 5, function(Category $category, $count) {
						$category->setName($this->faker->department());
				});

				$manager->flush();
		}
}
