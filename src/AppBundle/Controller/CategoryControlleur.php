<?php
// src/AppBundle/Controlleur.php
namespace AppBundle\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CategoryControlleur extends Controller
{
    /**
     * @Route("/category", name="app_list_category")
     */
    public function listAction(Request $request)
    {
        $categorymanager = $this->getCategoryManager();
        $categorys = $categorymanager->getAllCategory();
        foreach ($categorys as $category)
        {
            $nbTasksByCategory = $this->getTaskManager()->getCountByCategory($category);
            $category->setCount($nbTasksByCategory);
        }

        //vue
        return $this->render(':Category:index.html.twig',array(
           "colonnes" => $categorys,
        ));
    }

    /**
     * @return \AppBundle\Manager\TaskManager|object
     */
    private function getTaskManager()
    {
        return $this->container->get('app.task_manager');
    }

    /**
     * @return \AppBundle\Manager\CategoryManager|object
     */
    private function getCategoryManager()
    {
        return $this->container->get('app.category_manager');
    }
}