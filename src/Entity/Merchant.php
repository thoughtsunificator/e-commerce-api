<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;

use App\Entity\User;
use App\Entity\Shop;
use App\Repository\MerchantRepository;

#[ORM\Entity]
#[ApiResource]
class Merchant
{
	#[ORM\Id, ORM\Column, ORM\GeneratedValue]
	private int $id;

	#[ORM\Column]
	private string $name;

	#[ORM\Column]
	private string $address;

	#[ORM\ManyToOne(inversedBy: 'merchants')]
	private User $user;

	/**
	 * @var Shop[]
	 */
	#[ORM\OneToMany(targetEntity: Shop::class, mappedBy: 'merchant', cascade: ['persist', 'remove'])]
	private iterable $shop;

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
		$newMerchant = null === $user ? null : $this;
		if ($user->getMerchant() !== $newMerchant) {
			$user->setMerchant($newMerchant);
		}

		return $this;
	}

	/**
	 * @var Shop[]
	 */
	public function getShop(): iterable
	{
		return $this->shop;
	}

	public function addShop(Shop $shop): self
	{
		if (!$this->shop->contains($shop)) {
			$this->shop[] = $shop;
			$shop->setMerchant($this);
		}

		return $this;
	}

	public function removeShop(Shop $shop): self
	{
		if ($this->shop->contains($shop)) {
			$this->shop->removeElement($shop);
			// set the owning side to null (unless already changed)
			if ($shop->getMerchant() === $this) {
				$shop->setMerchant(null);
			}
		}

		return $this;
	}

}
