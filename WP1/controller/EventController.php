<?php
/**
 * Created by PhpStorm.
 * User: 11500668
 * Date: 22/03/2017
 * Time: 10:35
 */

namespace controller;

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
        $this->repository->getEventsFromDate($from, $until);

    }

    public function handleFindAllEvents(){
            $this->repository->getAll();

    }

    public function handleFindByPersonAndDate($id, $from, $until){
        $this->repository->FindByPersonAndDate($id, $from, $until);
    }

    public function handleFindEventById($id){
        $this->repository->getById($id);
    }

    public function handleFindEventByPersonId($id){
        $this->repository->getByPersonId($id);
    }


    public function handleFindAllEventsByPersonId($id){
        $this->repository->getAllEventsByPersonId($id);
    }

    public function handleActionEvents($id, $action){
        $this->repository->actionEvents($id,$action);
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