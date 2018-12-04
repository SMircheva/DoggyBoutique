<?php
/**
 * Created by PhpStorm.
 * User: Silviya
 * Date: 02-Dec-18
 * Time: 3:53 PM
 */


namespace EShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="products")
 *
 */
class Product
{
    /**
     * @var int
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", unique=true)
     */
    private $name;

    /**
     * @var double
     * @ORM\Column(type="decimal", scale=2)
     */
    private $price;

    /**
     * @var string
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", name="create_date")
     */
    private $createDate;

    public function __construct()
    {
        $this->createDate = new \DateTime('now');
    }
}