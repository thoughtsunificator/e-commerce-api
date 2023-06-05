<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;

use App\Entity\Seller;
use App\Entity\Product;
use App\Entity\Category;
use App\Repository\SellerItemRepository;

#[ORM\Entity]
#[ApiResource]
class SellerItem
{

	#[ORM\Id, ORM\Column, ORM\GeneratedValue]
	private int $id;

	#[ORM\ManyToOne(inversedBy: 'items')]
	private Seller $seller;

	#[ORM\ManyToOne(inversedBy: 'sellerItems')]
	private Product $product;

	#[ORM\ManyToOne(inversedBy: 'sellerItems')]
	private Category $category;

	#[ORM\Column(type: 'smallint')]
	private int $quantity;

	public function getId(): ?int
	{
		return $this->id;
	}

	public function getSeller(): ?Seller
	{
		return $this->seller;
	}

	public function setSeller(?Seller $seller): self
	{
		$this->seller = $seller;

		return $this;
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

	public function getCategory(): ?Category
	{
		return $this->category;
	}

	public function setCategory(?Category $category): self
	{
		$this->category = $category;

		return $this;
	}

	public function getQuantity(): ?int
	{
		return $this->quantity;
	}

	public function setQuantity(int $quantity): self
	{
		$this->quantity = $quantity;

		return $this;
	}
}
