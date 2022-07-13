<?php

namespace App\Entity;

use App\Repository\CustomersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CustomersRepository::class)]
class Customers
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $firstName;

    #[ORM\Column(type: 'string', length: 255)]
    private $lastName;

    #[ORM\Column(type: 'string', length: 255)]
    private $dateOfBirth;

    #[ORM\Column(type: 'string', length: 255)]
    private $status;

    #[ORM\Column(type: 'datetime_immutable')]
    private $createdAt;

    #[ORM\Column(type: 'datetime_immutable')]
    private $updatedAt;

    #[ORM\Column(type: 'datetime_immutable')]
    private $deletedAt;

    #[ORM\Column(type: 'string', length: 255)]
    private $products;

    #[ORM\OneToMany(mappedBy: 'Customers', targetEntity: Products::class)]
    private $Customers;

    #[ORM\OneToMany(mappedBy: 'Products', targetEntity: Products::class)]
    private $Products;

    public function __construct()
    {
        $this->Customers = new ArrayCollection();
        $this->Products = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getDateOfBirth(): ?string
    {
        return $this->dateOfBirth;
    }

    public function setDateOfBirth(string $dateOfBirth): self
    {
        $this->dateOfBirth = $dateOfBirth;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getDeletedAt(): ?\DateTimeImmutable
    {
        return $this->deletedAt;
    }

    public function setDeletedAt(\DateTimeImmutable $deletedAt): self
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    public function getProducts(): ?string
    {
        return $this->products;
    }

    public function setProducts(string $products): self
    {
        $this->products = $products;

        return $this;
    }

    /**
     * @return Collection<int, Products>
     */
    public function getCustomers(): Collection
    {
        return $this->Customers;
    }

    public function addCustomer(Products $customer): self
    {
        if (!$this->Customers->contains($customer)) {
            $this->Customers[] = $customer;
            $customer->setCustomers($this);
        }

        return $this;
    }

    public function removeCustomer(Products $customer): self
    {
        if ($this->Customers->removeElement($customer)) {
            // set the owning side to null (unless already changed)
            if ($customer->getCustomers() === $this) {
                $customer->setCustomers(null);
            }
        }

        return $this;
    }

    public function addProduct(Products $product): self
    {
        if (!$this->Products->contains($product)) {
            $this->Products[] = $product;
            $product->setProducts($this);
        }

        return $this;
    }

    public function removeProduct(Products $product): self
    {
        if ($this->Products->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getProducts() === $this) {
                $product->setProducts(null);
            }
        }

        return $this;
    }
}
