<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainPageController extends AbstractController
{
    /**
     * @Route("/", name="mainPage")
     */
    public function index(): Response
    {
        $user = $this->getUser();
        return $this->render('index.html.twig',['user'=>$user]);
    }

}
