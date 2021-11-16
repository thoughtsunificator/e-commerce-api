<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
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
 *         "put"={"security"="is_granted('ROLE_ADMIN') or object.user == user"},
 *     }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\SellerRepository")
 */
class Seller
{
	/**
	 * @ORM\Id()
	 * @ORM\GeneratedValue()
	 * @ORM\Column(type="integer")
	 */
	private $id;

	/**
	 * @ApiFilter(SearchFilter::class, strategy="ipartial")
	 * @ORM\Column(type="string", length=255)
	 */
	private $name;

	/**
	 * @ORM\Column(type="string", length=255)
	 */
	private $address;

	/**
	 * @ORM\OneToOne(targetEntity="App\Entity\User", mappedBy="seller", cascade={"persist", "remove"})
	 * @ApiSubresource
	 */
	private $user;

	/**
	 * @ORM\OneToMany(targetEntity="App\Entity\SellerItem", mappedBy="seller", orphanRemoval=true)
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
	 * @return Collection|SellerItem[]
	 */
	public function getItems(): Collection
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
