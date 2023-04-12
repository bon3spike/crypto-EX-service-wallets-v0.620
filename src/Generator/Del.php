<?php
// src/Generator/Del.php
namespace App\Generator;

# Получение

class Del
{

    public function randomSeedPhrase()
    {
        $words = array('apple', 'banana', 'orange', 'strawberry', 'grape', 'pineapple', 'kiwi', 'mango', 'pear', 'lemon', 'coconut', 'apricot');
        $string = '';
        $length = count($words);
        for ($i = 0; $i < $length; $i++) {
            if ($i === $length - 1) {
                $string .= $words[rand(0, $length - 1)];
            } else {
                $string .= $words[rand(0, $length - 1)] . ' ';
            }
        }
        return $string;
    }
}
