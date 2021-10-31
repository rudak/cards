<?php

namespace App\Service;

use App\Model\Card;
use Generator;

class CardGenerator
{
    public const COLORS = [
        'Pique',
        'Coeur',
        'Carreau',
        'Trèfle',
    ];

    public const VALEURS = [
        '2'     => 2,
        '3'     => 3,
        '4'     => 4,
        '5'     => 5,
        '6'     => 6,
        '7'     => 7,
        '8'     => 8,
        '9'     => 9,
        '10'    => 10,
        'Valet' => 11,
        'Dame'  => 12,
        'Roi'   => 13,
        'As'    => 14,
    ];


    /**
     * @param int|null $nbPlayers
     * @return array
     */
    public static function getPlayersDecks(?int $nbPlayers = 2): array
    {
        $deck = self::getFullDeck();
        return array_chunk($deck, count($deck) / $nbPlayers);
    }

    /**
     * @return array
     */
    public static function getFullDeck(): array
    {
        $cards = iterator_to_array(self::getCardGenerator());
        shuffle($cards);
        return $cards;
    }

    /**
     * @return \Generator|null
     */
    private static function getCardGenerator(): ?Generator
    {
        foreach (self::COLORS as $color) {
            foreach (self::VALEURS as $name => $value) {
                yield (new Card())
                    ->setColor($color)
                    ->setName($name)
                    ->setValue($value)
                ;
            }
        }
    }


}