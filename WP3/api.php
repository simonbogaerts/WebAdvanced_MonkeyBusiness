<?php

require "vendor/autoload.php";
require "AltoRouter.php";


use model\PDOEventRepository;
use view\EventJsonView;
use controller\EventController;

use model\PDOPersonRepository;
use view\PersonJsonView;
use controller\PersonController;

$user = 'root';
$password = 'user';
$database = 'monkey_business';
$hostname = '127.0.0.1';
$pdo = null;
try {

    $pdo = new PDO("mysql:host=$hostname;dbname=$database", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $PDOPersonRepository = new PDOPersonRepository($pdo);
    $PDOEventRepository = new PDOEventRepository($pdo);
    $PersonJsonView = new PersonJsonView();
    $PersonController = new PersonController($PDOPersonRepository, $PersonJsonView);
    $EventJsonView = new EventJsonView();
    $EventController = new EventController($PDOEventRepository, $EventJsonView);
    $router = new AltoRouter();
    $router->setBasePath('/~user/MonkeyBusiness');

    $router->map('GET','/',
        function() use ($EventController){

        }
    );

    $router->map('GET','/events/',
        function() use ($EventController) {
            $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $parts = parse_url($url);
            if (count($parts) > 3 && strpos($url, 'from') && strpos($url, 'until')) {
                parse_str($parts['query'], $query);
                $from = $query['from'];
                $until = $query['until'];
                if($from != null && $until != null) {
                    $EventController->handleFindAllFromDate($from, $until);
                }else{
                    $EventController->handleFindAllEvents();
                }
            } else {
                $EventController->handleFindAllEvents();
            }
        },'get_all_events'
    );
    $router->map('GET','/person/[i:id]/events/',
        function($id) use ($EventController) {
            $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $parts = parse_url($url);
            if (count($parts) > 3 && strpos($url, 'from') && strpos($url, 'until')) {
                parse_str($parts['query'], $query);
                $from = $query['from'];
                $until = $query['until'];

                    $EventController->handleFindByPersonAndDate($id, $from, $until);

            } else {
                $EventController->handleFindAllEventsByPersonId($id);
            }
        },'get_events_by_person_and_date'
    );

    $router->map('GET','/events/[i:id]/',
        function($id) use ($EventController) {
            $EventController->handleFindEventById($id);
        },'get_events_by_id'
    );

    $router->map('GET','/events/person/[i:id]/',
        function($id) use ($EventController) {
            $EventController->handleFindAllEventsByPersonId($id);
        },'get_events_by_person_id'
    );

    //CRUD events

    //Read
    $router->map('GET','/person/',
        function() use ($PersonController) {
            $PersonController->handleFindAllPersons();
        },'get_all_person'
    );

    //Create
    $router->map('PUT','/events/[i:id]/',
        function($id) use ($EventController) {
            $EventController->handlePutEvents($id);
        }
        ,'put_events'
    );
    //Update
    $router->map('POST','/events/[i:id]/',
        function($id) use ($EventController) {
            $EventController->handlePostEvents($id);
        }
        ,'post_events'
    );

    //Delete
    $router->map('DELETE','/events/[i:id]/',
        function($id) use ($EventController) {
            $EventController->handleDeleteEvents($id);
        }
        ,'delete_events'
    );

    $match = $router->match();
    if( $match && is_callable( $match['target'] ) ){
        call_user_func_array( $match['target'], $match['params'] );
    }
} catch (Exception $e) {
    var_dump($e);
}

?>

