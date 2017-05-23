<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 23/05/2017
 * Time: 21:22
 */

namespace test\modelTest;


use model\Event;


class EventTest extends \PHPUnit_Framework_TestCase
{

    public function test_setId_sameId(){
        $event = new Event(1,2,'2017-02-01','2017-03-02');
        $event->setId(2);
        $this->assertEquals($event->getId(), 2 );
    }

    public function test_setPersonId_samePersonId(){
        $event = new Event(1,2,'2017-02-01','2017-03-02');
        $event->setPersonId(4);
        $this->assertEquals($event->getPersonId(), 4 );
    }

    public function test_setStartDate_sameStartDate(){
        $event = new Event(1,2,'2017-02-01','2017-03-02');
        $event->setStartDate('2018-05-04');
        $this->assertEquals($event->getStartDate(), '2018-05-04');
    }

    public function test_setEndDate_sameEndDate(){
        $event = new Event(1,2,'2017-02-01','2017-03-02');
        $event->setEndDate('2019-05-04');
        $this->assertEquals($event->getEndDate(), '2019-05-04');
    }

}
