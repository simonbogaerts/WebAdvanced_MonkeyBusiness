<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 17/05/2017
 * Time: 11:23
 */

namespace controller;

use view\PersonJsonView;
use model\PDOPersonRepository;

class PersonController
{
    private $repository;
    private $view;

    public function __construct(PDOPersonRepository $repository, PersonJsonView $view)
    {
        $this->repository = $repository;
        $this->view = $view;
    }

    public function handleFindAllPersons(){
        $persons = $this->repository->getAllPersons();
        $this->view->ShowAll($persons);
    }
    public function handleFindPersonById($id){
        $person = $this->repository->getPersonById($id);
        $this->view->ShowPerson($person);
    }

    public function handlePutPerson($id){
        $this->repository->putPerson($id);
    }

}