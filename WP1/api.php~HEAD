<?php

require "vendor/autoload.php";
require "AltoRouter.php";


use model\PDOEventRepository;
use view\EventJsonView;
use controller\EventController;

$user = 'root';
$password = 'user';
$database = 'WedAdvanced';
$hostname = '127.0.0.1';
$pdo = null;
try {

    $pdo = new PDO("mysql:host=$hostname;dbname=$database", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $PDOEventRepository = new PDOEventRepository($pdo);
    $EventJsonView = new EventJsonView();
    $EventController = new EventController($PDOEventRepository, $EventJsonView);
    $router = new AltoRouter();
    $router->setBasePath('/~user/businessMonkey');

    $router->map('GET','/',
        function() use ($EventController){

        }
    );

    $router->map('GET','/events/',
        function() use ($EventController) {
            $EventController->handleFindAllEvents();
        },'get_all_events'
    );

    $router->map('GET','/events/?[*dates]?',
        function() use ($EventController) {
            $EventController->handleFindAllFromDate();
        },'get_events_by_date'
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

    $router->map('GET','/person/',
        function() use ($EventController) {
            $EventController->handleFindAllPersons();
        },'get_all_person'
    );

    $router->map('GET', '/person/[i:id]/',
        function($id) use ($EventController){
            $EventController->handleFindEventByPersonId($id);
        },'find_person_by_id'
    );

    $router->map('POST','/events/[i:id]/[delete|update|create|read:action]/',
            function($id, $action) use ($EventController) {
                    $EventController->handlePostEvent($id, $action);
        }
    ,'post_events'
    );

    $match = $router->match();
    if( $match && is_callable( $match['target'] ) ){
        call_user_func_array( $match['target'], $match['params'] );
        $parameters = $match['params'];
    }
} catch (Exception $e) {
    var_dump($e);
}

?>

<h1>Page</h1>

<?php echo $router->generate('get_all_events'); ?>
<form action=" <?php echo $router->generate('get_all_events'); ?> " method="get">
    <button type="submit">get all events</button>
</form>

<?php echo $router->generate('get_events_by_id',array('id'=>1)); ?>
<form action=" <?php echo $router->generate('get_events_by_id',array('id'=>1)); ?> " method="get">
    <button type="submit">get events by id</button>
</form>

<?php echo $router->generate('get_events_by_person_id',array('id'=>1)); ?>
<form action=" <?php echo $router->generate('get_events_by_person_id',array('id'=>1)); ?> " method="get">
    <button type="submit">get events by person id</button>
</form>

<?php echo $router->generate('get_events_by_date'); ?>
<form action=" <?php echo $router->generate('get_events_by_date'); ?> " method="get">
    <label>start_date:<input name="from" type="text" /></label> <br>
    <label>end_date:<input name="until" type="text" /></label> <br>
    <button type="submit">get event from dates</button>
</form>

<?php echo $router->generate('post_events',array('id'=>3, 'action'=>'update')); ?>
<form action=" <?php echo $router->generate('post_events',array('id'=>3, 'action'=>'update')); ?> " method="post">
    <label>person_id:<input name="person_id" type="text" /></label> <br>
    <label>start_date:<input name="start_date" type="text" /></label> <br>
    <label>end_date:<input name="end_date" type="text" /></label> <br>
    <button type="submit">update event</button>
</form>

<?php echo $router->generate('post_events',array('id'=>5, 'action'=>'create')); ?>
<form action=" <?php echo $router->generate('post_events',array('id'=>5, 'action'=>'create')); ?> " method="post">
    <label>person_id:<input name="person_id" type="text" /></label> <br>
    <label>start_date:<input name="start_date" type="text" /></label> <br>
    <label>end_date:<input name="end_date" type="text" /></label> <br>
    <button type="submit">create event</button>
</form>

<?php echo $router->generate('post_events',array('id'=>3, 'action'=>'read')); ?>
<form action=" <?php echo $router->generate('post_events',array('id'=>3, 'action'=>'read')); ?> " method="post">
    <button type="submit">Read event met id 3</button>
</form>

<?php echo $router->generate('post_events',array('id'=>2, 'action'=>'delete')); ?>
<form action=" <?php echo $router->generate('post_events',array('id'=>2, 'action'=>'delete')); ?> " method="post">
    <button type="submit">Delete event met id 2</button>
</form>


