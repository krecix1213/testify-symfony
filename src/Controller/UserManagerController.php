<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Groups;
use App\Entity\GroupsUsers;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserManagerController extends AbstractController
{
    /**
     * @Route("/admin/users", name="mainPageAdminUserManager")
     */
    public function index(ManagerRegistry $doctrine): Response
    {
            $user = $this->getUser();
            $userListDoctrine = $doctrine->getRepository(User::class)->findAll();
            $userList = array();
            foreach ($userListDoctrine as $v){
                $tmp = array(
                    'id' => $v->getId(),
                    'email' => $v->getEmail(),
                    'name' => $v->getUserIdentifier(),
                    'role' => $v->getRoles()[0]
                );
                array_push($userList,$tmp);
                
            }
            unset($userListDoctrine);
            
            return $this->render('admin/userManager/index.html.twig',['user'=>$user, 'userList' => $userList]);
    }
    /**
     * @Route("/admin/users/add", name="addUserAdminUserManager")
     */
    public function addUser(ManagerRegistry $doctrine): Response
    {
        $user = $this->getUser();
        $groupDoctrine = $doctrine->getRepository(Groups::class)->findAll();
        $groups = array();
        foreach($groupDoctrine as $v){
            $tmp = array(
                'id' => $v->getId(),
                'groupName' => $v->getName()
            );
        }
        unset($groupDoctrine);
        return $this->render('admin/userManager/addUser.html.twig',['user' => $user, 'errors' => null, 'groups' => $groups]);
    }
}
