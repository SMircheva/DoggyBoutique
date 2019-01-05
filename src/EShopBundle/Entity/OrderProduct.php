<?php
/**
 * Created by PhpStorm.
 * User: Silviya
 * Date: 05-Jan-19
 * Time: 12:39 PM
 */

namespace EShopBundle\Entity;


/**
 * Class OrderProduct
 * no connection to database - to be used only to store items in session
 */
class OrderProduct
{
    /**
     * @var string
     */
    private $product;

    /**
     * @var string
     */
    private $size;

    /**
     * @var string
     */
    private $color;

    /**
     * @var string
     */
    private $image;

    /**
     * @var int
     */
    private $quantity;

    /**
     * @var double
     */
    private $price;

    /**
     * @return int
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param Product $product
     */
    public function setProduct($product)
    {
        $this->product = $product;
    }

    /**
     * @return int
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param int $size
     */
    public function setSize( $size)
    {
        $this->size = $size;
    }

    /**
     * @return int
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param int $color
     */
    public function setColor( $color)
    {
        $this->color = $color;
    }

    /**
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity( $quantity)
    {
        $this->quantity = $quantity;
    }

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
    public function setImage( $image)
    {
        $this->image = $image;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

}