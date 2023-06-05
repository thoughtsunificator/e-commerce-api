<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;

use App\Entity\Category;
use App\Repository\CategoryRepository;

#[ORM\Entity]
#[ApiResource]
class Category
{
	#[ORM\Id, ORM\Column, ORM\GeneratedValue]
	private $id;

	#[ORM\Column]
	private string $name;

	#[ORM\OneToOne(mappedBy: 'parent')]
    #[ORM\JoinColumn(referencedColumnName: 'id', unique: true)]
	private ?Category $parent= null;

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

	public function getParent(): ?self
	{
		return $this->parent;
	}

	public function setParent(?self $parent): self
	{
		$this->parent = $parent;

		return $this;
	}

}