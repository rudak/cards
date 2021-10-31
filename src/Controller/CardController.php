<?php

namespace App\Controller;

use App\Service\CardGenerator;
use App\Service\Game;
use App\Service\GameAnalyzer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CardController extends AbstractController
{
    /**
     * @Route("/card", name="card")
     */
    public function index(): Response
    {
        $game   = new Game(CardGenerator::getPlayersDecks());
        $game->launch();

        return $this->render('card/index.html.twig', [
            'game' => $game,
        ]);
    }
}
