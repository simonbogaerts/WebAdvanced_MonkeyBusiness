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
        $this->repository->getAllPersons();
    }
    public function handleFindPersonById($id){
        $this->repository->getPersonById($id);
    }

    public function handlePutPerson($id){
        $this->repository->putPerson($id);
    }

}