<?php

final class Dictionary
{
    private $word;

    public function willProvide($word)
    {
        $this->word = $word;
    }

    public function provideWord()
    {
        return $this->word;
    }
}
