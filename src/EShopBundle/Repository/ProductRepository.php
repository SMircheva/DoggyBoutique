<?php
namespace EShopBundle\Repository;
/**
 * ProductRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProductRepository extends \Doctrine\ORM\EntityRepository
{public function getListOfCatCol() {
         $query = $this->getEntityManager()->createQuery(
             'SELECT p, c, cat
                 FROM EShopBundle:Product p
                 JOIN p.colors c
                 JOIN p.category cat'
         );
         return $query->getResult();
     }
}