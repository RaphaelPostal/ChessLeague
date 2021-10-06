<?php

namespace App\Controller;

use App\Repository\GameRepository;
use App\Repository\PlayerRepository;
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
     * @return Response
     */
    public function index(GameRepository $gameRepository): Response
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

        //datas white black general
        $nbGamesWonWithWhite = count($gameRepository->findAllWonByColor('Blancs'));
        $nbGamesWonWithBlack = count($gameRepository->findAllWonByColor('Noirs'));
        $nbGamesDraw = count($gameRepository->findAllDraw());
        $allGamesWon = json_encode([$nbGamesWonWithWhite,$nbGamesDraw, $nbGamesWonWithBlack]);

        //Raphaël : donut victoires blancs/noirs
        $nbRaphWinWhite = count($gameRepository->findALLWonByColorAndName('Blancs', 'Raphaël'));
        $nbRaphWinBlack = count($gameRepository->findALLWonByColorAndName('Noirs', 'Raphaël'));
        $tabRaphWin = json_encode([$nbRaphWinWhite, $nbRaphWinBlack]);
        //Constant : donut victoires blancs/noirs
        $nbCstWinWhite = count($gameRepository->findALLWonByColorAndName('Blancs', 'Constant'));
        $nbCstWinBlack = count($gameRepository->findALLWonByColorAndName('Noirs', 'Constant'));
        $tabCstWin = json_encode([$nbCstWinWhite, $nbCstWinBlack]);

        //Raphael : ratio victoires sur abandon ou mat

        //Constant : ratio victoires sur abandon ou mat

        //Raphaël : donut victoires/défaites/nulles

        //Constant : donut victoires/défaites/nulles




        return $this->render('home/index.html.twig', [
            'all_games' => $all_games,
            'pts_raph' => $pointsRaphael,
            'pts_cst' => $pointsConstant,
            'allGamesWon' => $allGamesWon,
            'tabRaphWin' => $tabRaphWin,
            'tabCstWin' => $tabCstWin,
        ]);
    }
}
