<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

use App\Entity\Customer;
use App\Entity\Merchant;
use App\Entity\Seller;

#[ORM\Table(name: 'users')]
#[ORM\Entity]
#[UniqueEntity('email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
	#[ORM\Id, ORM\Column, ORM\GeneratedValue]
	private int $id;
	
	#[ORM\Column]
    #[Assert\Email]
	private string $email;

	#[ORM\Column(type: 'json')]
	private $roles = [];

	#[ORM\Column]
	private string $username;

	#[ORM\Column]
	private string $password;

	#[ORM\OneToOne(mappedBy: 'user')]
    #[ORM\JoinColumn(referencedColumnName: 'id', unique: true)]
	public ?Customer $customer = null;

	#[ORM\OneToOne(mappedBy: 'user')]
    #[ORM\JoinColumn(referencedColumnName: 'id', unique: true)]
	public ?Merchant $merchant = null;

	#[ORM\OneToOne(mappedBy: 'user')]
    #[ORM\JoinColumn(referencedColumnName: 'id', unique: true)]
	public ?Seller $seller = null;


	public function getId(): ?int
	{
		return $this->id;
	}

	public function getEmail(): ?string
	{
		return $this->email;
	}

	public function setEmail(string $email): self
	{
		$this->email = $email;

		return $this;
	}

	/**
	 * A visual identifier that represents this user.
	 *
	 * @see UserInterface
	 */
	public function getUsername(): string
	{
		return (string) $this->username;
	}
	
	/**
	 * A visual identifier that represents this user.
	 *
	 * @see UserInterface
	 */
	public function getUserIdentifier(): string
	{
		return (string) $this->username;
	}

	/**
	 * @see UserInterface
	 */
	public function getRoles(): array
	{
		$roles = $this->roles;
		// guarantee every user at least has ROLE_USER
		$roles[] = 'ROLE_USER';

		return array_unique($roles);
	}

	public function setRoles(array $roles): self
	{
		$this->roles = $roles;

		return $this;
	}

	/**
	 * @see UserInterface
	 */
	public function getPassword(): string
	{
		return (string) $this->password;
	}

	public function setPassword(string $password): self
	{
		$this->password = $password;

		return $this;
	}

	/**
	 * @see UserInterface
	 */
	public function getSalt()
	{
		// not needed when using the "bcrypt" algorithm in security.yaml
	}

	/**
	 * @see UserInterface
	 */
	public function eraseCredentials()
	{
		// If you store any temporary, sensitive data on the user, clear it here
		// $this->plainPassword = null;
	}

	public function getCustomer(): ?Customer
	{
		return $this->customer;
	}

	public function setCustomer(?Customer $customer): self
	{
		$this->customer = $customer;

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

	public function getSeller(): ?Seller
	{
		return $this->seller;
	}

	public function setSeller(?Seller $seller): self
	{
		$this->seller = $seller;

		return $this;
	}

	public function setUsername(string $username): self
	{
			$this->username = $username;

			return $this;
	}

}
