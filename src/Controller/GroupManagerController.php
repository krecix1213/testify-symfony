<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Groups;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GroupManagerController extends AbstractController
{
    /**
     * @Route("/admin/groups", name="mainPageAdminGroupManager")
    */
    public function index(ManagerRegistry $doctrine): Response
    {
        $user = $this->getUser();
        $groups = $doctrine->getRepository(Groups::class)->findAll();
        return $this->render('groupManager/index.html.twig', [
            'user' => $user,
            'groups' => $groups
        ]);
    }

    /**
     * @Route("/admin/groups/add", name="addGroupAdminGroupManager")
    */
    public function add(ManagerRegistry $doctrine): Response
    {
        $user = $this->getUser();
        return $this->getUser('groupManager/add.html.twig', [
            'user' => $user
        ]);
    }

}
