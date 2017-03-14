<?php
// src/AppBundle/Controller/AdminControlleur.php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AdminControlleur extends Controller
{
    /**
     * @Route("/admin", name="app_admin")
     */
    public function adminAction(Request $request)
    {
        return $this->render(':admin:index.html.twig', array(
            "tableau" => array(),
        ));
    }
}