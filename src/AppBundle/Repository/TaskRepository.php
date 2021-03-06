<?php

namespace AppBundle\Repository;
use AppBundle\Entity\Category;

/**
 * TaskRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TaskRepository extends \Doctrine\ORM\EntityRepository
{

    /**
     * @param $idtask
     * @return mixed
     */
    public function getTaskById($idtask)
    {
        return $this->createQueryBuilder('t')
            ->select('t')
            ->andWhere('t.id = :id')
            ->setParameter(':id',$idtask)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @param Category $category
     * @return array
     */
    public function getTasksByCategory(Category $category)
    {
        return $this->createQueryBuilder('t')
            ->select('t')
            ->andWhere('t.category = :category')
            ->setParameter('category', $category->getId())
            ->getQuery()
            ->getResult();
    }

    /**
     * @param Category $category
     * @return mixed
     */
    public function getCountByCategory(Category $category)
    {
        return $this->createQueryBuilder('t')
            ->select('COUNT(t) as total')
            ->andWhere('t.category = :category')
            ->setParameter(':category', $category)
            ->getQuery()
            ->getSingleScalarResult();
    }
}
