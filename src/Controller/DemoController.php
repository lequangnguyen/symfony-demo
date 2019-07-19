<?php

namespace App\Controller;

use App\Entity\Users;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DemoController extends AbstractController
{
    /**
     * @Route("/demo", name="demo")
     */
    public function index()
    {
        return $this->render('demo/index.html.twig', [
            'controller_name' => 'DemoController',
        ]);
    }
    /**
     * @Route("/users", name="getUsers")
    */

    public function showUser() {
        dd(DateTime::getTimezone());

        $users = $this->getDoctrine()->getRepository(Users::class)->findAll();
        return $this->json($users, 200);
    }

    /**
     * @Route("/create-user", name="createUser")
     * @return Response
     */
    public function createUser() : Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $user = new Users();
       $user->setName('datnt');
       $user->setAge(23);
       $user->setCreatedAt();
       $user->setUpdatedAt();
       $entityManager->persist($user);
       $entityManager->flush();
        return new Response('Saved new product with id '.$user->getId(), 200);
    }
}
