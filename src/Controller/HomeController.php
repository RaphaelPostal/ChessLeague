<?php

namespace App\Controller;

use App\Repository\GameRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @param GameRepository $gameRepository
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function index(GameRepository $gameRepository, EntityManagerInterface $entityManager): Response
    {
        $all_games = $gameRepository->findAll();
        $pointsRaphael = 0;
        $pointsConstant = 0;

        foreach ($all_games as $game) {
            if($game->getWinner() !== null) {
                if ($game->getWinner()->getName() == 'Raphaël') {
                    $pointsRaphael ++;
                } elseif ($game->getWinner()->getName() == 'Constant') {
                    $pointsConstant ++;
                }
            } else {
                $pointsRaphael += 0.5;
                $pointsConstant += 0.5;
            }
        }

        return $this->render('home/index.html.twig', [
            'all_games' => $all_games,
            'pts_raph' => $pointsRaphael,
            'pts_cst' => $pointsConstant,
        ]);
    }
}
