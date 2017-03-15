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
     * @param $id
     * @return mixed
     */
    public function getCategoryById($id)
    {
        return $this->getRepository()->getCategoryById($id);
    }

    /**
     * @return Category
     */
    public function create()
    {
        return new Category();
    }

    /**
     * @param Category $category
     */
    public function save(Category $category)
    {
        if ($category->getId() === null)
        {
            $this->manager->persist($category);
        }
        $this->manager->flush();
    }

    public function remove(Category $category)
    {
        $this->manager->remove($category);
        $this->manager->flush();
    }

    /**
     * @return \AppBundle\Repository\CategoryRepository|\Doctrine\Common\Persistence\ObjectRepository
     */
    private function getRepository()
    {
        return $this->manager->getRepository(Category::class);
    }
}