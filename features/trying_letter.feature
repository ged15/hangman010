Feature: Trying a letter
  In order to win the game
  As a player
  I need to be able to try letters

  Rules:
  - Successful try reveals all letters in word
  - Successful try does not decrease available guess count
  - Unsuccessful try decreases available guess count

  Scenario: Successful guess when trying a letter
    Given a game has been started for the word "coconut"
    When I try the letter "o"
    Then the revealed word should be "-o-o---"
    And there should be 11 guesses available

  Scenario: Unsuccessful guess when trying a letter
    Given a game has been started for the word "coconut"
    When I try the letter "a"
    Then the revealed word should be "-------"
    And there should be 10 guesses available
