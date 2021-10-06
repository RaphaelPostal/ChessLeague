<?php

namespace App\Controller;

use App\Entity\Game;
use App\Form\FormGameType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     * @param FormGameType $formGameType
     * @param Request $request
     * @return Response
     */
    public function index(FormGameType $formGameType, Request $request, EntityManagerInterface $entityManager): Response
    {
        $game=new Game();
        $form = $this->createForm(FormGameType::class, $game);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $game = $form->getData();
            if (strpos($game->getEnd(), 'Nulle')) {
                $game->setWinner(null);
            }
            $entityManager->persist($game);
            $entityManager->flush();
        }
        return $this->render('admin/index.html.twig', [
            'form' => $form->createView(),
        ]);

    }
}
