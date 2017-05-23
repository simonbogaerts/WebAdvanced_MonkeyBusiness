<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 23/05/2017
 * Time: 13:21
 */

namespace test\controllerTest;


use controller\EventController;
use model\Event;


class EventControllerTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->mockEventRepository = $this->getMockBuilder('model\PDOEventRepository')
            ->disableOriginalConstructor()
            ->getMock();
        $this->mockView = $this->getMockBuilder('view\EventJsonView')
            ->getMock();
    }

    public function tearDown()
    {
        $this->mockEventRepository = null;
        $this->mockView = null;
    }

    //Tests handleFindAllEvents

    function test_handleFindAllEvents_idExists_2EventObject()
    {

        $event = new Event(1, 2, '2017-05-02', '2017-06-03');
        $event2 = new Event(2, 3, '2017-02-11', '2017-04-07');

        $events = array($event, $event2);

        $this->mockEventRepository->expects($this->atLeastOnce())
            ->method('getAll')->will($this->returnValue($events));
        $eventController = new EventController($this->mockEventRepository, $this->mockView);
        $eventController->handleFindAllEvents();
    }
    //End Tests handleFindAllEvents

    //Tests handleFindAllFromDate

    function test_handleFindAllFromDate_idExists_2EventObject()
    {

        $event = new Event(1, 2, '2017-05-02', '2017-06-03');
        $event2 = new Event(2, 3, '2017-02-11', '2017-04-07');

        $events = array($event, $event2);

        $this->mockEventRepository->expects($this->atLeastOnce())
            ->method('getEventsFromDate')->will($this->returnValue($events));
        $eventController = new EventController($this->mockEventRepository, $this->mockView);
        $eventController->handleFindAllFromDate($event2->getStartDate(), $event->getEndDate());
    }
    //End Tests handleFindAllFromDate

    //Tests handleFindByPersonAndDate

    public function test_handleFindByPersonAndDate_idExists_2EventObject()
    {

        $event = new Event(1, 2, '2017-05-02', '2017-06-03');
        $event2 = new Event(1, 3, '2017-02-11', '2017-04-07');

        $events = array($event, $event2);

        $this->mockEventRepository->expects($this->atLeastOnce())
            ->method('getByPersonAndDate')->will($this->returnValue($events));
        $eventController = new EventController($this->mockEventRepository, $this->mockView);
        $eventController->handleFindByPersonAndDate($event->getId(), $event2->getStartDate(), $event->getEndDate());
    }

    //End Tests handleFindByPersonAndDate

    //Tests handleFindEventById
    public function test_handleFindEventById_idExists_EventObject()
    {

        $event = new Event(1, 2, '2017-05-02', '2017-06-03');

        $this->mockEventRepository->expects($this->atLeastOnce())
            ->method('getById')->will($this->returnValue($event));
        $eventController = new EventController($this->mockEventRepository, $this->mockView);
        $eventController->handleFindEventById($event->getId());
    }
    //End Tests handleFindEventById


    //test handleFindAllEventsByPersonId

    public function test_handleFindAllEventsByPersonId__idExists_2EventObject()
    {


        $event = new Event(1, 2, '2017-05-02', '2017-06-03');
        $event2 = new Event(1, 3, '2017-02-11', '2017-04-07');

        $events = array($event, $event2);

        $this->mockEventRepository->expects($this->atLeastOnce())
            ->method('getAllEventsByPersonId')->will($this->returnValue($events));
        $eventController = new EventController($this->mockEventRepository, $this->mockView);
        $eventController->handleFindAllEventsByPersonId(1);
    }
    //End tests handleFindAllEventsByPersonId

    //Tests handlePostEvents

    public function test_handlePostEvents_noReturn()
    {
        $this->mockEventRepository->expects($this->atLeastOnce())->method('postEvents');
        $eventController = new EventController($this->mockEventRepository, $this->mockView);
        $eventController->handlePostEvents(1);
    }

    //End Tests handlePostEvents

    //Tests handleDeleteEvents

    public function test_handleDeleteEvents_idExists_noReturn()
    {
        $this->mockEventRepository->expects($this->atLeastOnce())->method('deleteEvents');
        $eventController = new EventController($this->mockEventRepository, $this->mockView);
        $eventController->handleDeleteEvents(1);
    }

    //End Tests handleDeleteEvents

    //Tests handlePutEvents

    public function test_handlePutEvents_noReturn()
    {
        $this->mockEventRepository->expects($this->atLeastOnce())->method('putEvents');
        $eventController = new EventController($this->mockEventRepository, $this->mockView);
        $eventController->handlePutEvents(1);
    }

    //End Tests handlePutEvents

}