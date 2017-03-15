<?php
// src/AppBundle/Controller/API/CategoryController.php
namespace AppBundle\Controller\API;

use AppBundle\Entity\Category;
use AppBundle\Form\CategoryType;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as FOSRest;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * CategoryController.
 *
 * @FOSRest\Route(path="/api/categories")
 */
class CategoryController extends FOSRestController
{
    /**
     * @FOSRest\Get("/")
     * @FOSRest\View()
     *
     * @ApiDoc(
     *     section="categories",
     *     description="affichage des categories et taches associées"
     * )
     *
     */
    public function listAction()
    {
        return $this->getCategoryManager()->getAllCategory();
    }

    /**
     * @FOSRest\Get("/{id}")
     * @FOSRest\View()
     *
     * @ApiDoc(
     *     section="getonecategorie",
     *     description="Afficher une catégorie"
     * )
     *
     * @param $id
     * @return Category
     */
    public function getOneAction(Category $category)
    {
        return $category;
    }

    /**
     * @FOSRest\Post("/")
     * @FOSRest\View()
     *
     * @ApiDoc(
     *     section="ajouter une catégorie",
     *     description="Ajouter une catégorie",
     *     input="AppBundle\Form\CategoryType",
     * )
     * @param Request $request
     * @return array|\Symfony\Component\Form\FormView
     */
    public function addAction(Request $request)
    {
        $category = $this->getCategoryManager()->create();

        $form = $this->getForm($request,$category);

        if($form->isSubmitted() AND $form->isValid())
        {
            $this->getCategoryManager()->save($category);
            return $category;
        }
        return $form->getErrors();
    }

    /**
     * @param Request $request
     * @param Category $category
     * @return \Symfony\Component\Form\Form
     */
    private function getForm(Request $request, Category $category)
    {
        $form = $this->createForm(CategoryType::class,$category);
        $form->handleRequest($request);
        return $form;
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