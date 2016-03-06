<?php

final class Game
{
    private $word;
    private $guessesAvailable = 11;

    private function __construct(Dictionary $dictionary)
    {
        $this->word = $dictionary->provideWord();
        $this->revealedWord = str_repeat('-', strlen($this->word));
    }

    public static function startUsingDictionary(Dictionary $dictionary)
    {
        return new Game($dictionary);
    }

    public function getGuessesAvailable()
    {
        return $this->guessesAvailable;
    }

    public function getRevealedWord()
    {
        return $this->revealedWord;
    }

    public function tryLetter($letter)
    {
        $trySuccessful = false;

        for ($i = 0; $i < strlen($this->word); $i++) {
            if ($this->word[$i] === $letter) {
                $this->revealedWord[$i] = $letter;
                $trySuccessful = true;
            }
        }

        if (!$trySuccessful) {
            $this->guessesAvailable--;
        }
    }
}
