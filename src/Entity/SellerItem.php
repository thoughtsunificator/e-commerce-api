<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiSubresource;

/**
 * @ApiResource(
 *     attributes={"security"="is_granted('ROLE_USER')"},
 *     collectionOperations={
 *         "get",
 *         "post"={"security"="is_granted('ROLE_ADMIN')"}
 *     },
 *     itemOperations={
 *         "get",
 *         "put"={"security"="is_granted('ROLE_ADMIN') or object.seller == user.seller"},
 *     }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\SellerItemRepository")
 */
class SellerItem
{
	/**
	 * @ORM\Id()
	 * @ORM\GeneratedValue()
	 * @ORM\Column(type="integer")
	 */
	private $id;

	/**
	 * @ORM\ManyToOne(targetEntity="App\Entity\Seller", inversedBy="items")
	 * @ORM\JoinColumn(nullable=false)
	 */
	private $seller;

	/**
	 * @ORM\ManyToOne(targetEntity="App\Entity\Product", inversedBy="sellerItems")
	 * @ORM\JoinColumn(nullable=false)
	 * @ApiSubresource
	 */
	private $product;

	/**
	 * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="sellerItems")
	 * @ORM\JoinColumn(nullable=false)
	 * @ApiSubresource
	 */
	private $category;

	/**
	 * @ORM\Column(type="integer")
	 */
	private $quantity;

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
