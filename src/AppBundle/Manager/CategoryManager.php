<?php
// src/AppBundle/Manager/CategoryManager.php
namespace AppBundle\Manager;

use AppBundle\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;

class CategoryManager {

    private $manager;

    /**
     * CategoryManager constructor.
     * @param EntityManagerInterface $manager
     */
    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @return array
     */
    public function getAllCategory()
    {
        return $this->getRepository()->getAllCategory();
    }

    /**
     * @return int
     */
    public function getFirstCategory()
    {
        return $this->getRepository()->getFirstCategory();
    }

    /**
     * @return \AppBundle\Repository\CategoryRepository|\Doctrine\Common\Persistence\ObjectRepository
     */
    private function getRepository()
    {
        return $this->manager->getRepository(Category::class);
    }
}