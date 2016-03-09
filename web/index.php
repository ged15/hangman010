<?php

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

require_once __DIR__ . '/../vendor/autoload.php';

$app = new \Silex\Application();

$app['debug'] = true;

$app['game_file_path'] = __DIR__ . '/../game.data';

$app['dictionary'] = $app->share(function () {
    return new FileDictionary(__DIR__ . '/../dictionary.data');
});

$app['game_store'] = $app->share(function () use ($app) {
    return new class($app['game_file_path']) {
        private $gameFilePath;

        public function __construct($gameFilePath)
        {
            $this->gameFilePath = $gameFilePath;
        }

        public function store(Game $game)
        {
            file_put_contents($this->gameFilePath, serialize($game));
        }

        public function load()
        {
            return file_exists($this->gameFilePath)
                ? unserialize(file_get_contents($this->gameFilePath))
                : null;
        }
    };
});

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../src/views',
));

$app->get('/', function () use ($app) {
    /** @var Game $game */
    $game = $app['game_store']->load();

    return $app['twig']->render('index.html.twig', ['game' => $game]);
});

$app->post('/start_new_game', function () use ($app) {
    $game = Game::startUsingDictionary($app['dictionary']);
    $app['game_store']->store($game);

    return new RedirectResponse('/');
});

$app->post('/try_letter', function (Request $request) use ($app) {
    /** @var Game $game */
    $game = $app['game_store']->load();
    $game->tryLetter($request->request->get('letter'));
    $app['game_store']->store($game);

    return new RedirectResponse('/');
});

$app->run();
