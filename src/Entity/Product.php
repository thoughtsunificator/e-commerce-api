<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     collectionOperations={
 *         "get",
 *         "post"={"security"="is_granted('ROLE_ADMIN')"}
 *     },
 *     itemOperations={
 *         "get",
 *         "put"={"security"="is_granted('ROLE_ADMIN')"},
 *     }
 * )
 * @ApiFilter(SearchFilter::class, properties={"id", "name" : "partial"})
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product
{
	/**
	 * @ORM\Id()
	 * @ORM\GeneratedValue()
	 * @ORM\Column(type="integer")
	 * @Groups({"shop_item"})
	 */
	private $id;

	/**
	 * @ApiFilter(SearchFilter::class, strategy="ipartial")
	 * @ORM\Column(type="string", length=255)
	 * @Groups({"shop_item"})
	 */
	private $name;

	/**
	 * @ORM\Column(type="string", length=255)
	 * @Groups({"shop_item"})
	 */
	private $description;

	/**
	 * @ORM\Column(type="decimal")
	 * @Groups({"shop_item"})
	 */
	private $price;

	/**
	 * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="products")
	 * @ORM\JoinColumn(nullable=false)
	 * @ApiSubresource
	 */
	private $category;

	/**
	 * @ORM\Column(type="json")
	 * @Groups({"shop_item"})
	 */
	private $images = [];

		/**
		 * @ORM\OneToMany(targetEntity="App\Entity\CartItem", mappedBy="product", orphanRemoval=true)
		 */
		private $cartItems;

	public function __construct()
								{
									$this->sellerItems = new ArrayCollection();
								 $this->cartItems = new ArrayCollection();
								}

	public function getId(): ?int
								{
									return $this->id;
								}

	public function getName(): ?string
								{
									return $this->name;
								}

	public function setName(string $name): self
								{
									$this->name = $name;
								
									return $this;
								}

	public function getDescription(): ?string
								{
									return $this->description;
								}

	public function setDescription(string $description): self
												{
													$this->description = $description;
											 
													return $this;
												}

	public function getPrice(): ?float
												{
													return $this->price;
												}

	public function setPrice(float $price): self
												{
													$this->price = $price;
											 
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

		public function getImages(): ?array
		{
				return $this->images;
		}

		public function setImages(array $images): self
		{
				$this->images = $images;

				return $this;
		}

	/**
	 * @return Collection|CartItem[]
	 */
	public function getCartItems(): Collection
	{
			return $this->cartItems;
	}

	public function addCartItem(CartItem $cartItem): self
	{
			if (!$this->cartItems->contains($cartItem)) {
					$this->cartItems[] = $cartItem;
					$cartItem->setProduct($this);
			}

			return $this;
	}

	public function removeCartItem(CartItem $cartItem): self
	{
			if ($this->cartItems->contains($cartItem)) {
					$this->cartItems->removeElement($cartItem);
					// set the owning side to null (unless already changed)
					if ($cartItem->getProduct() === $this) {
							$cartItem->setProduct(null);
					}
			}

			return $this;
	}

}
