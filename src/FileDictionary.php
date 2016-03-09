<?php

final class FileDictionary implements Dictionary
{
    private $words;

    public function __construct($path)
    {
        $this->words = file($path);
    }

    public function provideWord()
    {
        return $this->words[array_rand($this->words)];
    }
}
