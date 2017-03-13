<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        //recup du manager
        $taskmanager = $this->container->get('app.task_manager');
        $categorymanager = $this->container->get('app.category_manager');

        $categorys = $categorymanager->getAllCategory();

        foreach ($categorys as $category)
        {
            $tasks[$category->getOrderId()] = $taskmanager->getTasksByCategory($category);
        }

        // retourne la vue
        return $this->render(':Task:index.html.twig', [
            "colonnes" => $categorys,
            "taches" => $tasks,
        ]);
    }

}
