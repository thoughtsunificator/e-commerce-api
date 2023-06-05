<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;

use App\Entity\ShopItem;
use App\Entity\Merchant;
use App\Repository\ShopRepository;

#[ORM\Entity]
#[ApiResource]
#[ApiFilter(SearchFilter::class, properties: ['id' => 'exact', 'category' => 'partial'])]
class Shop
{
	
	#[ORM\Id, ORM\Column, ORM\GeneratedValue]
	private int $id;

    #[ORM\ManyToOne(inversedBy: 'shops')]
	private Category $category;    
	
	#[ORM\Column]
	private string $name;    
	
	#[ORM\ManyToOne(inversedBy: 'shops')]
	private Merchant $merchant;    
	
	/**
	 * @var ShopItem[]
	 */
    #[ORM\OneToMany(targetEntity: ShopItem::class, mappedBy: 'shop', cascade: ['persist', 'remove'])]
    private iterable $items;    
	
	public function getId(): ?int
    {
        return $this->id;
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
	
	public function getName(): ?string
    {
        return $this->name;
	}    
	
	public function setName(string $name): self
    {
		$this->name = $name;        
		return $this;
	}    
	
	public function getMerchant(): ?Merchant
    {
        return $this->merchant;
	}    
	
	public function setMerchant(?Merchant $merchant): self
    {
		$this->merchant = $merchant;        
		return $this;
	}    
	
	/**
     * @var ShopItem[]
     */

    public function getItems(): iterable
    {
        return $this->items;
	}    
	
	public function addItem(ShopItem $item): self
    {
        if (!$this->items->contains($item)) {
            $this->items[] = $item;
        }        return $this;
	}    
	
	public function removeItem(ShopItem $item): self
    {
        if ($this->items->contains($item)) {
            $this->items->removeElement($item);
		}        
		return $this;
    }
}