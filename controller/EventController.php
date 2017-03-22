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

    public function handleFindAllEvents(){
        echo 'ok';
        $this->repository->getAll();
    }

    public function handleFindEventById($id){
        $this->repository->get($id);
    }
}