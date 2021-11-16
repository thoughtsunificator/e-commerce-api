<?php

namespace App\Entity;use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiSubresource;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

/**
 * @ApiResource(
 *     collectionOperations={
 *         "get",
 *         "post"={"security"="is_granted('ROLE_ADMIN')"}
 *     },
 *     itemOperations={
 *         "get",
 *         "put"={"security"="is_granted('ROLE_ADMIN') or object.merchant == user.merchant"},
 *     }
 * )
 * 
 * @ApiFilter(SearchFilter::class, properties={"id": "exact", "category": "exact"})
 * @ORM\Entity(repositoryClass="App\Repository\ShopRepository")
 */
class Shop

{
	
	/**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;   
     /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="shops")
     * @ORM\JoinColumn(nullable=false)
     * @ApiSubresource
     */

	private $category;    
	
	/**
     * @ORM\Column(type="string", length=255)
     */
	private $name;    
	
	/**
     * @ORM\ManyToOne(targetEntity="App\Entity\Merchant", inversedBy="shop")
     * @ORM\JoinColumn(nullable=false)
     * @ApiSubresource
     */
	private $merchant;    
	
	/**
     * @ORM\OneToMany(targetEntity="App\Entity\ShopItem", mappedBy="shop")
     * @ApiSubresource
     */
	
	 private $items;    
	 
	 public function __construct()
    {
        $this->items = new ArrayCollection();
	}    
	
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
     * @return Collection|ShopItem[]
     */

    public function getItems(): Collection
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