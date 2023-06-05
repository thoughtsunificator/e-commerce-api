<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\Cookie;  
use ApiPlatform\Metadata\ApiResource;

use App\Entity\Cart;
use App\Entity\CartItem;
use App\Repository\CartRepository;

#[ORM\Entity]
#[ApiResource]
class Cart
{
	#[ORM\Id, ORM\Column, ORM\GeneratedValue]
	private int $id;
	
	#[ORM\OneToOne(mappedBy: 'cart')]
	public CartItem $session;
	
	/**
	 * @var CartItem[]
	 */
	#[ORM\OneToMany(targetEntity: CartItem::class, mappedBy: 'cart', cascade: ['persist', 'remove'])]
	private iterable $cartItems;
	
	#[ORM\Column]
	private \DateTimeImmutable $session_time;
	
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
	* @var CartItem[]
	*/
	public function getCartItems(): iterable
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
