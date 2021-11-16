<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
 *         "put"={"security"="is_granted('ROLE_ADMIN') or object.user == user"},
 *     }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\MerchantRepository")
 */
class Merchant
{
	/**
	 * @ORM\Id()
	 * @ORM\GeneratedValue()
	 * @ORM\Column(type="integer")
	 */
	private $id;

	/**
	 * @ORM\Column(type="string", length=255)
	 */
	private $name;

	/**
	 * @ORM\Column(type="string", length=255)
	 */
	private $address;

	/**
	 * @ORM\OneToOne(targetEntity="App\Entity\User", mappedBy="merchant", cascade={"persist", "remove"})
	 * @ApiSubresource
	 */
	private $user;

	/**
	 * @ORM\OneToMany(targetEntity="App\Entity\Shop", mappedBy="merchant", orphanRemoval=true)
	 * @ApiSubresource
	 */
	private $shop;

	public function __construct()
	{
		$this->shop = new ArrayCollection();
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
		$newMerchant = null === $user ? null : $this;
		if ($user->getMerchant() !== $newMerchant) {
			$user->setMerchant($newMerchant);
		}

		return $this;
	}

	/**
	 * @return Collection|Shop[]
	 */
	public function getShop(): Collection
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
