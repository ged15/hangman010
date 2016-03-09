<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\MinkContext;

class WebFeatureContext extends MinkContext implements SnippetAcceptingContext
{
    private $dictionaryFile = __DIR__ . '/../../dictionary.data';
    private $gameFile = __DIR__ . '/../../game.data';

    /**
     * @BeforeScenario
     */
    public function clearDataFiles()
    {
        @unlink($this->dictionaryFile);
        @unlink($this->gameFile);
    }

    /**
     * @Given the dictionary provides :word
     */
    public function theDictionaryProvides($word)
    {
        file_put_contents($this->dictionaryFile, $word);
    }

    /**
     * @When I start a game using the dictionary
     */
    public function iStartAGameUsingTheDictionary()
    {
        $this->visit('/');
        $this->pressButton('Start new game');
    }

    /**
     * @Then there should be :count guesses available
     */
    public function thereShouldBeGuessesAvailable($count)
    {
        $this->assertElementContains('#guesses-available', $count);
    }

    /**
     * @Then the revealed word should be :revealedWord
     */
    public function theRevealedWordShouldBe($revealedWord)
    {
        $this->assertElementContains('#revealed-word', $revealedWord);
    }

    /**
     * @Given a game has been started for the word :word
     */
    public function aGameHasBeenStartedForTheWord($word)
    {
        file_put_contents(__DIR__ . '/../../dictionary.data', $word);

        $this->iStartAGameUsingTheDictionary();
    }

    /**
     * @When I try the letter :letter
     */
    public function iTryTheLetter($letter)
    {
        $this->fillField('Letter', $letter);
        $this->pressButton('Try letter');
    }
}
