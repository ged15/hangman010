<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use PHPUnit_Framework_Assert as Assert;

class FeatureContext implements Context, SnippetAcceptingContext
{
    private $dictionary;

    /** @var Game */
    private $game;

    public function __construct()
    {
        $this->dictionary = new Dictionary();
    }

    /**
     * @Given the dictionary provides :word
     */
    public function theDictionaryProvides($word)
    {
        $this->dictionary->willProvide($word);
    }

    /**
     * @When I start a game using the dictionary
     */
    public function iStartAGameUsingTheDictionary()
    {
        $this->game = Game::startUsingDictionary($this->dictionary);
    }

    /**
     * @Then there should be :count guesses available
     */
    public function thereShouldBeGuessesAvailable($count)
    {
        Assert::assertEquals($count, $this->game->getGuessesAvailable());
    }

    /**
     * @Then the revealed word should be :revealedWord
     */
    public function theRevealedWordShouldBe($revealedWord)
    {
        Assert::assertEquals($revealedWord, $this->game->getRevealedWord());
    }

    /**
     * @Given a game has been started for the word :word
     */
    public function aGameHasBeenStartedForTheWord($word)
    {
        $this->dictionary->willProvide($word);
        $this->game = Game::startUsingDictionary($this->dictionary);
    }

    /**
     * @When I try the letter :letter
     */
    public function iTryTheLetter($letter)
    {
        $this->game->tryLetter($letter);
    }
}
