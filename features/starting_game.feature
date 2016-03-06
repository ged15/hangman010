Feature: Starting a game

  Rules:
  - Game initially has 11 guesses
  - Dictionary provides game with a random word
  - Word of the game is masked
  - Number of letters in word are exposed

  Scenario: Starting a game
    Given the dictionary provides "coconut"
    When I start a game using the dictionary
    Then there should be 11 guesses available
    And the revealed word should be "-------"
