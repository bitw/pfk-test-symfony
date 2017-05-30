<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Item
 *
 * @ORM\Table(name="item")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ItemRepository")
 */
class Item
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="product", type="string", length=255)
     */
    private $product;

    /**
     * @var int
     *
     * @ORM\Column(name="amount", type="integer")
     */
    private $amount;
	/**
	 * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Distributor", inversedBy="items")
	 * @ORM\JoinColumn(name="distributor_id", referencedColumnName="id")
	 */
	private $distributor;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return Item
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set product
     *
     * @param string $product
     *
     * @return Item
     */
    public function setProduct($product)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return string
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set amount
     *
     * @param integer $amount
     *
     * @return Item
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return integer
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set distributor
     *
     * @param \AppBundle\Entity\Distributor $distributor
     *
     * @return Item
     */
    public function setDistributor(\AppBundle\Entity\Distributor $distributor = null)
    {
        $this->distributor = $distributor;

        return $this;
    }

    /**
     * Get distributor
     *
     * @return \AppBundle\Entity\Distributor
     */
    public function getDistributor()
    {
        return $this->distributor;
    }
}
