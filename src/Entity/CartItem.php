<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;

use App\Entity\Cart;
use App\Entity\Product;
use App\Repository\CartItemRepository;

#[ORM\Entity]
#[ApiResource]
#[ApiFilter(SearchFilter::class, properties: ['cart_item' => 'exact'])]
class CartItem
{
	#[ORM\Id, ORM\Column, ORM\GeneratedValue]
	private int $id;

	#[ORM\ManyToOne(inversedBy: 'cartItems')]
	private ?Cart $cart = null;

	#[ORM\ManyToOne(inversedBy: 'cartItems')]
	private ?Product $product = null;

	public function getId(): ?int
	{
		return $this->id;
	}

	public function getCart(): ?Cart
	{
		return $this->cart;
	}

	public function setCart(?Cart $cart): self
	{
		$this->cart = $cart;

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
}
