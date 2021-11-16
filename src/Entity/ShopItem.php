<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiSubresource;
use ApiPlatform\Core\Annotation\ApiFilter;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

/**
 * @ApiResource(
 *     collectionOperations={
 *         "get",
 *         "post"={"security"="is_granted('ROLE_ADMIN')"}
 *     },
 *     itemOperations={
 *         "get",
 *         "put"={"security"="is_granted('ROLE_ADMIN') or object.shop == user.merchant.shop"},
 *     },
* 	   normalizationContext={"groups"={"shop_item"}}
 * )
 * @ApiFilter(SearchFilter::class, properties={"shop"})
 * @ORM\Entity(repositoryClass="App\Repository\ShopItemRepository")
 */
class ShopItem
{
	/**
	 * @ORM\Id()
	 * @ORM\GeneratedValue()
	 * @ORM\Column(type="integer")
	 */
	private $id;

	/**
	 * @ORM\ManyToOne(targetEntity="App\Entity\Product")
	 * @ORM\JoinColumn(nullable=false)
	 * @ApiSubresource
	 * @Groups({"shop_item", "shop"})
	 */
	private $product;

	/**
	 * @ORM\ManyToOne(targetEntity="App\Entity\Shop", inversedBy="shopItems")
	 * @ORM\JoinColumn(nullable=false)
	 * @Groups({"shop_item", "shop"})
	 */
	private $shop;

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
