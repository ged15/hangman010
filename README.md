# hangman010
Hangman game developed to demonstrate capabilities of Behat for 010PHP meetup

## Local Setup

```shell
composer install
php -S 127.0.0.1:8000 -t web
```

## Running tests

### Domain

```shell
vendor/bin/behat -sdomain
```

### GUI

```shell
php -S 127.0.0.1:8000 -t web
java -jar selenium.jar
vendor/bin/behat -sgui
```
