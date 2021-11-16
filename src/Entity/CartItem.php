<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Annotation\ApiFilter;

/**
 * @ApiResource(
 * normalizationContext={"groups"={"cart_item"}})
 * @ORM\Entity(repositoryClass="App\Repository\CartItemRepository")
 * @ApiFilter(SearchFilter::class, properties={"cart_item"})
 */
class CartItem
{
	/**
	 * @ORM\Id()
	 * @ORM\GeneratedValue()
	 * @ORM\Column(type="integer")
	 * @Groups({"cart_item"})
	 */
	private $id;

	/**
	 * @ORM\ManyToOne(targetEntity="App\Entity\Cart", inversedBy="cartItems")
	 * @ORM\JoinColumn(nullable=false)
	 * @ApiSubresource
	 */
	private $cart;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\Product", inversedBy="cartItems")
	* @ORM\JoinColumn(nullable=false)
	* @ApiSubresource
	* @Groups({"cart_item"})
	*/
	private $product;

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
