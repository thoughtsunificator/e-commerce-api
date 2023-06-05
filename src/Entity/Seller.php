<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;

use App\Entity\User;
use App\Entity\SellerItem;
use App\Repository\SellerRepository;

#[ORM\Entity]
#[ApiResource]
#[ApiFilter(SearchFilter::class, properties: ['name' => 'partial'])]
class Seller
{

	#[ORM\Id, ORM\Column, ORM\GeneratedValue]
	private int $id;

	#[ORM\Column]
	private string $name;

	#[ORM\Column]
	private string $address;

	#[ORM\OneToOne(mappedBy: 'seller')]
	private User $user;
	
	/**
	 * @var SellerItem[]
	 */
	#[ORM\OneToMany(targetEntity: SellerItem::class, mappedBy: 'seller', cascade: ['persist', 'remove'])]
	private iterable $items;

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

	public function getAddress(): ?string
	{
		return $this->address;
	}

	public function setAddress(string $address): self
	{
		$this->address = $address;

		return $this;
	}

	public function getUser(): ?User
	{
		return $this->user;
	}

	public function setUser(?User $user): self
	{
		$this->user = $user;

		// set (or unset) the owning side of the relation if necessary
		$newSeller = null === $user ? null : $this;
		if ($user->getSeller() !== $newSeller) {
			$user->setSeller($newSeller);
		}

		return $this;
	}

	/**
	 * @var SellerItem[]
	 */
	public function getItems(): iterable
	{
		return $this->items;
	}

	public function addItem(SellerItem $item): self
	{
		if (!$this->items->contains($item)) {
			$this->items[] = $item;
			$item->setSeller($this);
		}

		return $this;
	}

	public function removeItem(SellerItem $item): self
	{
		if ($this->items->contains($item)) {
			$this->items->removeElement($item);
			// set the owning side to null (unless already changed)
			if ($item->getSeller() === $this) {
				$item->setSeller(null);
			}
		}

		return $this;
	}
}
