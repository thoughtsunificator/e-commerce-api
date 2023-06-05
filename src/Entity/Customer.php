<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;

use App\Entity\User;
use App\Repository\CustomerRepository;

#[ORM\Entity]
#[ApiResource]
#[ApiFilter(SearchFilter::class, properties: ['lastname' => 'ipartial'])]
class Customer
{
	#[ORM\Id, ORM\Column, ORM\GeneratedValue]
	private int $id;

	#[ORM\Column]
	private string $firstname;

	#[ORM\Column]
	private string $lastname;

	#[ORM\Column]
	private string $address;

	#[ORM\OneToOne]
	private User $user;

	public function getId(): ?int
	{
		return $this->id;
	}

	public function getFirstname(): ?string
	{
		return $this->firstname;
	}

	public function setFirstname(string $firstname): self
	{
		$this->firstname = $firstname;
 
		return $this;
	}

	public function getLastname(): ?string
	{
		return $this->lastname;
	}

	public function setLastname(string $lastname): self
	{
		$this->lastname = $lastname;
 
		return $this;
	}

	public function getName(): string
	{
		return $this->firstname . ' ' . $this->lastname;
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

			return $this;
	}

}
