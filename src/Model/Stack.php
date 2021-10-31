<?php

namespace App\Model;

class Stack
{

    /**
     * @var Card[]
     */
    private $cards;

    /**
     * @param Card[] $cards
     */
    public function __construct(array $cards)
    {
        $this->cards = $cards;
    }

    /**
     * @return int
     */
    public function countCards(): int
    {
        return count($this->cards);
    }

    /**
     * @return Card|null
     */
    public function getFirstCard(): ?Card
    {
        return array_shift($this->cards);
    }

    /**
     * @param Card $card
     */
    public function addOneCard(Card $card): void
    {
        array_push($this->cards, $card);
    }

    /**
     * @param Card[] $cards
     */
    public function addCards(array $cards): Stack
    {
        foreach ($cards as $card) {
            $this->addOneCard($card);
        }
        return $this;
    }

    /**
     * @return Card[]
     */
    public function getAllCards(?bool $purge = true): array
    {
        if (!$purge) {
            return $this->cards;
        }
        $cards = $this->cards;
        shuffle($cards);
        $this->cards = [];
        return $cards;
    }
}