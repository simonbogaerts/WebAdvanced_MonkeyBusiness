<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 20/05/2017
 * Time: 13:29
 */

namespace model;


class Event
{
    private $id;
    private $person_id;
    private $start_date;
    private $end_date;

    /**
     * Event constructor.
     * @param $id
     * @param $person_id
     * @param $start_date
     * @param $end_date
     */

    public function __construct($id, $person_id, $start_date, $end_date)
    {
        $this->id = $id;
        $this->person_id = $person_id;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getPersonId()
    {
        return $this->person_id;
    }

    /**
     * @param mixed $person_id
     */
    public function setPersonId($person_id)
    {
        $this->person_id = $person_id;
    }

    /**
     * @return mixed
     */
    public function getStartDate()
    {
        return $this->start_date;
    }

    /**
     * @param mixed $start_date
     */
    public function setStartDate($start_date)
    {
        $this->start_date = $start_date;
    }

    /**
     * @return mixed
     */
    public function getEndDate()
    {
        return $this->end_date;
    }

    /**
     * @param mixed $end_date
     */
    public function setEndDate($end_date)
    {
        $this->end_date = $end_date;
    }



}