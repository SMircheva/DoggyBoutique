<?php

namespace EShopBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Product
 *
 * @ORM\Table(name="products")
 * @ORM\Entity(repositoryClass="EShopBundle\Repository\ProductRepository")
 */
class Product
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var double
     *
     * @ORM\Column(name="price", type="decimal", precision=10, scale=2)
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createDate", type="datetime")
     */
    private $createDate;

    /**
     * @ORM\ManyToOne(targetEntity="EShopBundle\Entity\Category", inversedBy="products")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $category;

    /**
     * @var Color[]
     * @ORM\ManyToMany(targetEntity="EShopBundle\Entity\Color", inversedBy="products")
     * @ORM\JoinTable(name="products_colors",
     *      joinColumns={@ORM\JoinColumn(name="products_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="color_id",referencedColumnName="id")})
     */
    private $colors;

    /**
     * @var Size[]
     * @ORM\ManyToMany(targetEntity="EShopBundle\Entity\Size", inversedBy="products")
     * @ORM\JoinTable(name="products_sizes",
     *     joinColumns={@ORM\JoinColumn(name="product_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="size_id", referencedColumnName="id")})
     */
    private $sizes;

    /**
     * @var string
     * @ORM\Column(name="image", type="string")
     */
    private $image;

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return Color[]
     */
    public function getColors()
    {
        return $this->colors;
    }

    /**
     * @return Size[]
     */
    public function getSizes()
    {
        return $this->sizes;
    }

    /**
     * @param Color[] $colors
     */
    public function setColors($colors)
    {
        $this->colors = $colors;
    }

    /**
     * @param Size[]
     */
    public function setSizes($sizes)
    {
        $this->colors = $sizes;
    }

    /**
     * @return Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    public function __construct()
    {
        $this->createDate = new \DateTime('now');
        $this->colors = new ArrayCollection();
        $this->sizes = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Product
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set price
     *
     * @param double $price
     *
     * @return Product
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return double
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Product
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set createDate
     *
     * @param \DateTime $createDate
     *
     * @return Product
     */
    public function setCreateDate($createDate)
    {
        $this->createDate = $createDate;

        return $this;
    }

    /**
     * Get createDate
     *
     * @return \DateTime
     */
    public function getCreateDate()
    {
        return $this->createDate;
    }


}

