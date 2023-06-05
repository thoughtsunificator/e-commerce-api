<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;

use App\Entity\Shop;
use App\Repository\ShopItemRepository;

#[ORM\Entity]
#[ApiResource]
#[ApiFilter(SearchFilter::class, properties: ['shop' => 'exact'])]
class ShopItem
{
	#[ORM\Id, ORM\Column, ORM\GeneratedValue]
	private int $id;
	
	#[ORM\ManyToOne]
	private Product $product;

	#[ORM\ManyToOne(inversedBy: 'shopItems')]
	private ?Shop $shop = null;

	public function getId(): ?int
	{
		return $this->id;
	}

	public function getProduct(): ?Product
	{
		return $this->product;
	}

	public function setProduct(?Product $product): self
	{
		$this->product = $product;

		return $this;
	}

	public function getShop(): ?Shop
	{
		return $this->shop;
	}

	public function setShop(?Shop $shop): self
	{
		$this->shop = $shop;

		return $this;
	}
}
