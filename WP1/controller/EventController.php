<?php
/**
 * Created by PhpStorm.
 * User: 11500668
 * Date: 22/03/2017
 * Time: 10:35
 */

namespace controller;

use model\Event;
use view\EventJsonView;
use model\PDOEventRepository;

class EventController
{
    private $repository;
    private $view;

    public function __construct(PDOEventRepository $repository, EventJsonView $view)
    {
        $this->repository = $repository;
        $this->view = $view;
    }


    public  function  handleFindAllFromDate($from,$until){
        $events = $this->repository->getEventsFromDate($from, $until);
        $this -> view -> ShowAll($events);

    }

    public function handleFindAllEvents(){
        $events = $this->repository->getAll();
        $this -> view -> ShowAll($events);

    }

    public function handleFindByPersonAndDate($id, $from, $until){
        $events = $this->repository->FindByPersonAndDate($id, $from, $until);
        $this -> view -> ShowAll($events);


    }

    public function handleFindEventById($id){
        $event = $this->repository->getById($id);
        $this->view->ShowEvent($event);
    }

    public function handleFindEventByPersonId($id){
        $event = $this->repository->getByPersonId($id);
        $this->view->ShowEvent($event);

    }

    public function handleFindAllEventsByPersonId($id){
        $events = $this->repository->getAllEventsByPersonId($id);
        $this -> view -> ShowAll($events);

    }

    public function handlePostEvents($id){
        $this->repository->postEvents($id);
    }

    public function handleDeleteEvents($id){
        $this->repository->deleteEvents($id);
    }

    public function handlePutEvents($id){
        $this->repository->putEvents($id);
    }

}