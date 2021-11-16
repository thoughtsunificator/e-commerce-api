<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\HttpFoundation\Cookie;  


/**
 * @ApiResource
 * @ORM\Entity(repositoryClass="App\Repository\CartRepository")
 * normalizationContext={"groups"={"cart"}})
 */
class Cart
{
	/**
	 * @ORM\Id()
	 * @ORM\GeneratedValue()
	 * @ORM\Column(type="integer")
	 */
	private $id;

	/**
	 * @ORM\OneToOne(targetEntity="App\Entity\CartItem", inversedBy="cart", cascade={"persist", "remove"})
	 * @ORM\JoinColumn(nullable=false)
	 */
	public $session;


	/**
	 * @ApiSubresource
	 * @ORM\OneToMany(targetEntity="App\Entity\CartItem", mappedBy="cart", orphanRemoval=true)
	 * @Groups({"cart"})
	 */
	private $cartItems;

    /**
     * @ORM\Column(type="date")
     */
    private $session_time;

	public function __construct()
         	{
         		$this->cartItems = new ArrayCollection();
         	}

	public function getId(): ?int
         	{
         		return $this->id;
         	}

	public function getSession(): ?string
         	{
         		return $this->session;
         	}

	public function setSession(string $session): self
         	{
				$this->$session = new Cookie('color', 'green', strtotime('tomorrow'), '/', 
				'somedomain.com', true, true);
         
         		return $this;
         	}

	/**
	 * @return Collection|CartItem[]
	 */
	public function getCartItems(): Collection
         	{
         		return $this->cartItems;
         	}

	public function addCartItem(CartItem $cartItem): self
         	{
         		if (!$this->cartItems->contains($cartItem)) {
         			$this->cartItems[] = $cartItem;
         			$cartItem->setCart($this);
         		}
         
         		return $this;
         	}

	public function removeCartItem(CartItem $cartItem): self
         	{
         		if ($this->cartItems->contains($cartItem)) {
         			$this->cartItems->removeElement($cartItem);
         			// set the owning side to null (unless already changed)
         			if ($cartItem->getCart() === $this) {
         				$cartItem->setCart(null);
         			}
         		}
         
         		return $this;
         	}

    public function getSessionTime(): ?\DateTimeInterface
    {
        return $this->session_time;
    }

    public function setSessionTime(\DateTimeInterface $session_time): self
    {
        $this->session_time = $session_time;

        return $this;
    }
}
