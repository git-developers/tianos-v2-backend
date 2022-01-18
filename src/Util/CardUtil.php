<?php

namespace App\Util;

class CardUtil
{

    public static function generateBingoCards($numberOfCards): array
    {
        $columns = [
            range(1,15),
            range(16,30),
            range(31,45),
            range(46,60),
            range(61,75)
        ];

        $i = 0;
        $bingoCards = [];
        $cardHashes = [];

        while ($i < $numberOfCards) {
            $bingoCard = [];

            for ($j = 0; $j < 5; $j++) {
                $randomKeys = array_rand($columns[$j], 5);
                $randomValues = array_intersect_key($columns[$j], array_flip($randomKeys));
                $bingoCard = array_merge($bingoCard, $randomValues);
            }

            $cardHash = md5(json_encode($bingoCard));

            if(!in_array($cardHash, $cardHashes)) {
                $bingoCards[$cardHash] = $bingoCard;
                $cardHashes[] = $cardHash;
                $i += 1;
            }
        }

        $out = [];
        foreach ($bingoCards as $key => $value) {
            $out[$key] = array_chunk($value, 5);
        }

        return $out;
    }
    
}