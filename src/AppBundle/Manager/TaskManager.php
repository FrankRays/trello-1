<?php
// src/AppBundle/Manager/TaskManager.php
namespace AppBundle\Manager;

use AppBundle\Entity\Category;
use AppBundle\Entity\Task;
use Doctrine\ORM\EntityManagerInterface;

class TaskManager {

    private $manager;

    /**
     * TaskManager constructor.
     * @param EntityManagerInterface $manager
     */
    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    public function getTasksByCategory(Category $category)
    {
        return $this->getRepository()->getTasksByCategory($category);
    }

    /**
     * @return \AppBundle\Repository\TaskRepository|\Doctrine\Common\Persistence\ObjectRepository
     */
    public function getRepository()
    {
        return $this->manager->getRepository(Task::class);
    }
}