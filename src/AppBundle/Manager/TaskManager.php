<?php
// src/AppBundle/Manager/TaskManager.php
namespace AppBundle\Manager;

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
}