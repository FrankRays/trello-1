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

    /**
     * @param $idtask
     * @return mixed
     */
    public function getTaskById($idtask)
    {
        return $this->getRepository()->getTaskById($idtask);
    }
    /**
     * @param Category $category
     * @return array
     */
    public function getTasksByCategory(Category $category)
    {
        return $this->getRepository()->getTasksByCategory($category);
    }

    /**
     * @param Category $category
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getCountByCategory(Category $category)
    {
        return $this->getRepository()->getCountByCategory($category);
    }

    /**
     * @param Task $task
     */
    public function save(Task $task)
    {
        if ($task->getId()=== null)
        {
            $this->manager->persist($task);
        }
        $this->manager->flush();
    }

    /**
     * @param Task $task
     */
    public function remove(Task $task)
    {
        $this->manager->remove($task);
        $this->manager->flush();
    }

    /**
     * @return Task
     */
    public function create()
    {
        return new Task();
    }

    /**
     * @return \AppBundle\Repository\TaskRepository|\Doctrine\Common\Persistence\ObjectRepository
     */
    public function getRepository()
    {
        return $this->manager->getRepository(Task::class);
    }
}