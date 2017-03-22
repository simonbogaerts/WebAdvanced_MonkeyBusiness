<?php

require "vendor/autoload.php";

use model\PDOEventRepository;
use view\EventJsonView;
use controller\EventController;

$user = 'root';
$password = 'root';
$database = 'MonkeyBusinessDB';
$hostname = '127.0.0.1';
$pdo = null;

try {

    $pdo = new PDO("mysql:host=$hostname;dbname=$database", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $PDOEventRepository = new PDOEventRepository($pdo);
    $EventJsonView = new EventJsonView();
    $EventController = new EventController($PDOEventRepository, $EventJsonView);
    $router = new AltoRouter();
    $router->setBasePath('/~user/MonkeyBusiness');

    $router->map('GET','/events/',
        function() use ($EventController) {
            $EventController->handleFindAllEvents();
        }
    );

    $router->map('GET','/events/[i:id]',
        function($id) use ($EventController) {
            $EventController->handleFindEventById($id);
        }
    );

    $match = $router->match();
    if( $match && is_callable( $match['target'] ) ){
        call_user_func_array( $match['target'], $match['params'] );
    }
} catch (Exception $e) {
    var_dump($e);
}
