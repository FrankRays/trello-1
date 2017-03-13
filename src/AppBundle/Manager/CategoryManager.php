<?php
// src/AppBundle/Manager/CategoryManager.php
namespace AppBundle\Manager;

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
}