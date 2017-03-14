<?php
// src/AppBundle/Controller/TaskControlleur
namespace AppBundle\Controller;

use AppBundle\AppBundle;
use AppBundle\Entity\Task;
use AppBundle\Form\TaskType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TaskControlleur extends Controller
{

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        //recup du manager
        $categoryManager = $this->getCategoryManager();
        $taskmanager = $this->getTaskManager();

        $categorys = $categoryManager->getAllCategory();
        foreach ($categorys as $category)
        {
            $nbTaskByCategory = $taskmanager->getCountByCategory($category);
            $category->setCount($nbTaskByCategory);
        }

        // retourne la vue
        return $this->render(':Task:index.html.twig', [
            'colonnes' => $categorys,
        ]);
    }

    /**
     * @Route("/newtask", name="app_new_task", methods={"GET","POST"})
     */
    public function newAction(Request $request)
    {
        //recup du manager
        $taskManager = $this->getTaskManager();

        //on crée une tache
        $task = $taskManager->create();

        //on recup le form relié à la requete
        $form = $this->getForm($request,$task);

        if ($form->isSubmitted() AND $form->isValid())
        {
            //ajout de la tache en bdd
            $taskManager->save($task);

            //message de notification
            $this->addFlash(
                'success',
                'Votre tache a bien été ajouté !'
            );

            return $this->redirectToRoute('homepage');
        }
        // retourne la vue
        return $this->render(':Task:new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/modiftask/{idtask}",name="app_modif_task", methods={"GET","POST"})
     */
    public function modifAction(Request $request,$idtask)
    {
        //recup du manager
        $taskManager = $this->getTaskManager();

        //on recup la tache
        $task = $taskManager->getTaskById($idtask);

        //on recup le form relié à la requete
        $form = $this->getForm($request,$task);

        if ($form->isSubmitted() AND $form->isValid())
        {
            //ajout de la tache en bdd
            $taskManager->save($task);

            //message de notification
            $this->addFlash(
                'success',
                'Votre tache a bien été modifié !'
            );

            return $this->redirectToRoute('homepage');
        }
        // retourne la vue
        return $this->render(':Task:new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    private function getForm(Request $request,Task $task)
    {
        $form = $this->createForm(TaskType::class,$task);
        $form->handleRequest($request);
        return $form;
    }

    public function getTaskManager()
    {
        return $this->container->get('app.task_manager');
    }

    /**
     * @return \AppBundle\Manager\CategoryManager|object
     */
    public function getCategoryManager()
    {
        return $this->container->get('app.category_manager');
    }
}