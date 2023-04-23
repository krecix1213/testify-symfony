<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Exams;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="mainPageAdmin")
     */
    public function index(): Response
    {
        $user = $this->getUser();
        return $this->render('admin/index.html.twig',['user' => $user]);
    }
    /**
     * @Route("/admin/exam", name="AdminExam")
     */
    public function exam(ManagerRegistry $doctrine): Response
    {
        $user = $this->getUser();
        $exams = $doctrine->getRepository(Exams::class)->findAll();
        return $this->render('admin/exam/main.html.twig',['user' => $user, 'exams' => $exams]);
    }
    /**
     * @Route("/admin/exam/{id}", name="AdminExamView")
     */
    public function examView(ManagerRegistry $doctrine,$id): Response
    {
        $user = $this->getUser();
        $exam = $doctrine->getRepository(Exams::class)->findOneBy(['id'=>$id]);
        $users = $doctrine->getRepository(User::class)->searchUserWithBelongByRoles($id);
        dump($users);
        return $this->render('admin/exam/view.html.twig',['user' => $users, 'exam' => $exam, 'Users' => $users]);
    }
    // /**
    //  * @Route("/admin/exam/edit/{id}", name="AdminExamEdit")
    //  */
    // public function examEdit($id): Response
    // {
    //     $user = $this->getUser();
    //     return $this->render('admin/examEdit.html.twig',['user' => $user]);
    // }
}
