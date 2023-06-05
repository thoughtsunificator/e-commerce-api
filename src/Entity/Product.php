<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;

use App\Entity\Category;
use App\Entity\CartItem;
use App\Repository\ProductRepository;

#[ORM\Entity]
#[ApiResource]
#[ApiFilter(SearchFilter::class, properties: ["id" => "exact", 'name' => 'partial'])]
class Product
{
	#[ORM\Id, ORM\Column, ORM\GeneratedValue]
	private int $id;
		
	#[ORM\Column]
	private string $name;
		
	#[ORM\Column]
	private string $description;
		
	#[ORM\Column(type: 'decimal')]
	private float $price;
	
	#[ORM\ManyToOne(inversedBy: 'products')]
	private ?Category $category = null;
		
	#[ORM\Column(type: 'json')]
	private $images = [];
	
	/**
	 * @var CartItem[]
	 */
	#[ORM\OneToMany(targetEntity: CartItem::class, mappedBy: 'product', cascade: ['persist', 'remove'])]
	private iterable $cartItems;
	
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
	* @var CartItem[]
	*/
	public function getCartItems(): iterable
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
