<?php

namespace App\Service;

use App\Model\Stack;

class Game
{
    public const MAX_ROUND = 50000;

    /**
     * @var Stack
     */
    private $playerOne;

    /**
     * @var Stack
     */
    private $playerTwo;


    /**
     * @var int
     */
    private $round;

    /**
     * @var int
     */
    private $battle;

    /**
     * @var Stack
     */
    private $table;

    /**
     * @var string
     */
    public $result;

    /**
     * @var array
     */
    public $log;

    /**
     * @param array $decks
     */
    public function __construct(array $decks)
    {
        $this->round     = 0;
        $this->battle    = 0;
        $this->playerOne = new Stack($decks[0]);
        $this->playerTwo = new Stack($decks[1]);
        $this->table     = new Stack([]);
        $this->result    = '';
        $this->log       = [];
        $this->verifyTheCards();
    }


    /**
     * Lance le jeu
     */
    public function launch(): void
    {
        while ($this->playerOne->countCards() && $this->playerTwo->countCards() && $this->round < self::MAX_ROUND) {
            $this->fight();
        }
        if (!$this->playerOne->countCards()) {
            $this->result = 'Player 2 wins';
            return;
        }
        if (!$this->playerTwo->countCards()) {
            $this->result = 'Player 1 wins';
            return;
        }
        $this->result = 'Both players wins';
    }

    /**
     * Gestion des comparaison de cartes
     */
    private function fight(): void
    {
        $this->round++;
        $this->table->addOneCard($card1 = $this->playerOne->getFirstCard());
        $this->table->addOneCard($card2 = $this->playerTwo->getFirstCard());

        if ($card1->getValue() > $card2->getValue()) {
            $this->log[] = sprintf('%s gagne : %s VS %s', 'Player 1', $card1, $card2);
            $this->playerOne->addCards($this->table->getAllCards());
            return;
        }

        if ($card1->getValue() < $card2->getValue()) {
            $this->log[] = sprintf('%s gagne : %s VS %s', 'Player 2', $card1, $card2);
            $this->playerTwo->addCards($this->table->getAllCards());
            return;
        }

        $this->log[] = sprintf('Bataille ! %s VS %s', $card1, $card2);
        $this->battle();
    }

    /**
     * Cartes identiques
     */
    private function battle(): void
    {
        $this->battle++;
        if (!$this->playerOne->countCards() || !$this->playerTwo->countCards()) {
            return;
        }
        $this->table->addOneCard($card1 = $this->playerOne->getFirstCard());
        $this->table->addOneCard($card2 = $this->playerTwo->getFirstCard());

        $this->log[] = sprintf('Cartes retournées : %s VS %s', $card1, $card2);
    }

    /**
     * Juste pour avoir quelques infos rapides
     */
    private function verifyTheCards(): void
    {
        $sum1 = 0;
        $as1  = 0;
        foreach ($this->playerOne->getAllCards(false) as $card) {
            $sum1 += $card->getValue();
            $as1  += ($card->getValue() === 14) ? 1 : 0;
        }

        $sum2 = 0;
        $as2  = 0;
        foreach ($this->playerTwo->getAllCards(false) as $card) {
            $sum2 += $card->getValue();
            $as2  += ($card->getValue() === 14) ? 1 : 0;
        }

        $this->log[] = sprintf('Points Joueur 1 : %dpts avec %d As, Points Joueur 2 : %d pts avec %d As', $sum1, $as1, $sum2, $as2);
    }

}