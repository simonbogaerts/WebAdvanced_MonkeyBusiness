<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 22/05/2017
 * Time: 17:06
 */

namespace test\modelTest;


use model\PDOEventRepository;
use model\Event;


class PDOEventRepositoryTest extends \PHPUnit_Framework_TestCase
{

    public function setUp()
    {
        $this->mockPDO = $this->getMockBuilder('PDO')
            ->disableOriginalConstructor()
            ->getMock();
        $this->mockPDOStatement =
            $this->getMockBuilder('PDOStatement')
                ->disableOriginalConstructor()
                ->getMock();
    }
    public function tearDown()
    {
        $this->mockPDO = null;
        $this->mockPDOStatement = null;
    }


    //Tests getById
    public function test_getById_idExists_EventObject()
    {
        $event = new Event(1, 2, '2017-05-02', '2017-06-03');
        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('bindParam');
        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('execute');
        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('fetchAll')
            ->will($this->returnValue(
                [
                    [ 'event_id' => $event->getId(),
                        'person_id' => $event->getPersonId(),
                        'start_date' => $event->getStartDate(),
                        'end_date' => $event->getEndDate()
                    ]
                ]));
        $this->mockPDO->expects($this->atLeastOnce())
            ->method('prepare')
            ->will($this->returnValue($this->mockPDOStatement));
        $pdoRepository = new PDOEventRepository($this->mockPDO);
        $actualEvent =
            $pdoRepository->getById($event->getId());
        $this->assertEquals($event, $actualEvent);
    }


    public function test_getById_idDoesNotExist_Null()
    {
        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('bindParam');
        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('execute');
        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('fetchAll')
            ->will($this->returnValue([]));
        $this->mockPDO->expects($this->atLeastOnce())
            ->method('prepare')
            ->will($this->returnValue($this->mockPDOStatement));
        $pdoRepository = new PDOEventRepository($this->mockPDO);
        $actualEvent = $pdoRepository->getById(222);
        $this->assertNull($actualEvent);
    }

    public function test_getById_exeptionThrownFromPDO_Null()
    {
        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('bindParam')->will(
                $this->throwException(new \PDOException()));
        $this->mockPDO->expects($this->atLeastOnce())
            ->method('prepare')
            ->will($this->returnValue($this->mockPDOStatement));
        $pdoRepository = new PDOEventRepository($this->mockPDO);
        $actualEvent = $pdoRepository->getById(12);
        $this->assertNull($actualEvent);
    }

    //End Tests getById

    //Tests getAll
    public function test_getAll_idExists_EventObjects()
    {
        $event = new Event(1, 2, '2017-05-02', '2017-06-03');
        $event2 = new Event(2, 3, '2018-03-21', '2018-04-01');
        $event3 = new Event(3, 5, '2018-02-19', '2018-05-01');

        $events = array($event, $event2, $event3);
        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('execute');
        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('fetchAll')
            ->will($this->returnValue(
                [
                    [ 'event_id' => $event->getId(),
                        'person_id' => $event->getPersonId(),
                        'start_date' => $event->getStartDate(),
                        'end_date' => $event->getEndDate()
                    ],
                    ['event_id' => $event2->getId(),
                    'person_id' => $event2->getPersonId(),
                    'start_date' => $event2->getStartDate(),
                    'end_date' => $event2->getEndDate()
                ],
                    ['event_id' => $event3->getId(),
                    'person_id' => $event3->getPersonId(),
                    'start_date' => $event3->getStartDate(),
                    'end_date' => $event3->getEndDate()
                ]
                ]));
        $this->mockPDO->expects($this->atLeastOnce())
            ->method('prepare')
            ->will($this->returnValue($this->mockPDOStatement));
        $pdoRepository = new PDOEventRepository($this->mockPDO);
        $actualEvents =
            $pdoRepository->getAll();
        $this->assertEquals($events, $actualEvents);
    }


    public function test_getAll_idDoesNotExist_Null()
{

    $this->mockPDOStatement->expects($this->atLeastOnce())
        ->method('execute');
    $this->mockPDOStatement->expects($this->atLeastOnce())
        ->method('fetchAll')
        ->will($this->returnValue([]));
    $this->mockPDO->expects($this->atLeastOnce())
        ->method('prepare')
        ->will($this->returnValue($this->mockPDOStatement));
    $pdoRepository = new PDOEventRepository($this->mockPDO);
    $actualEvent = $pdoRepository->getAll();
    $this->assertNull($actualEvent);
}

    public function test_getAll_exeptionThrownFromPDO_Null()
    {
        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('fetchAll')->will(
                $this->throwException(new \PDOException()));
        $this->mockPDO->expects($this->atLeastOnce())
            ->method('prepare')
            ->will($this->returnValue($this->mockPDOStatement));
        $pdoRepository = new PDOEventRepository($this->mockPDO);
        $actualEvent = $pdoRepository->getAll();
        $this->assertNull($actualEvent);
    }

    //End Tests getAll

    //Tests getEventsFromDate

    public function test_getEventsFromDate_idExists_2EventObjects()
    {
        $event1 = new Event(3, 6, '2018-02-19', '2018-05-01');
        $event2 = new Event(2, 3, '2018-03-21', '2018-04-01');

        $events = array($event2, $event1);
        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('execute');
        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('fetchAll')
            ->will($this->returnValue(
                [
                    ['event_id' => $event2->getId(),
                        'person_id' => $event2->getPersonId(),
                        'start_date' => $event2->getStartDate(),
                        'end_date' => $event2->getEndDate()
                    ],
                    ['event_id' => $event1->getId(),
                    'person_id' => $event1->getPersonId(),
                    'start_date' => $event1->getStartDate(),
                    'end_date' => $event1->getEndDate()
                ]
                ]));
        $this->mockPDO->expects($this->atLeastOnce())
            ->method('prepare')
            ->will($this->returnValue($this->mockPDOStatement));
        $pdoRepository = new PDOEventRepository($this->mockPDO);
        $actualEvents =
            $pdoRepository->getEventsFromDate($event1->getStartDate(), $event1->getEndDate());
        $this->assertEquals($events, $actualEvents);
    }


    public function test_getEventsFromDate_idDoesNotExist_Null()
    {
        $event1 = new Event(3, 6, '2017-02-19', '2017-05-01');

        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('execute');
        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('fetchAll')
            ->will($this->returnValue([]));
        $this->mockPDO->expects($this->atLeastOnce())
            ->method('prepare')
            ->will($this->returnValue($this->mockPDOStatement));
        $pdoRepository = new PDOEventRepository($this->mockPDO);
        $actualEvent = $pdoRepository->getEventsFromDate($event1->getStartDate(), $event1->getEndDate());
        $this->assertNull($actualEvent);
    }

    public function test_getEventsFromDate_exeptionThrownFromPDO_Null()
    {
        $event1 = new Event(3, 6, '2017-02-19', '2017-05-01');


        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('fetchAll')->will(
                $this->throwException(new \PDOException()));
        $this->mockPDO->expects($this->atLeastOnce())
            ->method('prepare')
            ->will($this->returnValue($this->mockPDOStatement));
        $pdoRepository = new PDOEventRepository($this->mockPDO);
        $actualEvent = $pdoRepository->getEventsFromDate($event1->getStartDate(), $event1->getEndDate());
        $this->assertNull($actualEvent);
    }

    //End Tests getEventsFromDate

    //Tests getByPersonAndDate

    public function test_getByPersonAndDate_idExists_3EventObjects()
    {
        $event1 = new Event(1, 3, '2017-04-01', '2017-04-10');
        $event2 = new Event(2, 3, '2017-03-21', '2017-04-01');
        $event3 = new Event(3, 3, '2017-01-21', '2017-04-01');

        $events = array($event1, $event2, $event3);
        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('execute');
        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('fetchAll')
            ->will($this->returnValue(
                [
                    ['event_id' => $event1->getId(),
                    'person_id' => $event1->getPersonId(),
                    'start_date' => $event1->getStartDate(),
                    'end_date' => $event1->getEndDate()
                    ],
                    ['event_id' => $event2->getId(),
                        'person_id' => $event2->getPersonId(),
                        'start_date' => $event2->getStartDate(),
                        'end_date' => $event2->getEndDate()
                    ],
                    ['event_id' => $event3->getId(),
                        'person_id' => $event3->getPersonId(),
                        'start_date' => $event3->getStartDate(),
                        'end_date' => $event3->getEndDate()
                    ]
                ]));
        $this->mockPDO->expects($this->atLeastOnce())
            ->method('prepare')
            ->will($this->returnValue($this->mockPDOStatement));
        $pdoRepository = new PDOEventRepository($this->mockPDO);
        $actualEvents =
            $pdoRepository->getByPersonAndDate($event3->getId(),'2017-01-21', '2017-04-12');
        $this->assertEquals($events, $actualEvents);
    }


    public function test_getByPersonAndDate_idDoesNotExist_Null()
    {
        $event1 = new Event(3, 6, '2018-02-19', '2017-05-01');

        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('execute');
        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('fetchAll')
            ->will($this->returnValue([]));
        $this->mockPDO->expects($this->atLeastOnce())
            ->method('prepare')
            ->will($this->returnValue($this->mockPDOStatement));
        $pdoRepository = new PDOEventRepository($this->mockPDO);
        $actualEvent = $pdoRepository->getByPersonAndDate($event1->getId(),$event1->getStartDate(), $event1->getEndDate());
        $this->assertNull($actualEvent);
    }

    public function test_getByPersonAndDate_exeptionThrownFromPDO_Null()
    {
        $event1 = new Event(3, 6, '2018-02-19', '2017-05-01');


        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('fetchAll')->will(
                $this->throwException(new \PDOException()));
        $this->mockPDO->expects($this->atLeastOnce())
            ->method('prepare')
            ->will($this->returnValue($this->mockPDOStatement));
        $pdoRepository = new PDOEventRepository($this->mockPDO);
        $actualEvent = $pdoRepository->getByPersonAndDate($event1->getId() ,$event1->getStartDate(), $event1->getEndDate());
        $this->assertNull($actualEvent);
    }

    //End Tests getByPersonAndDate

    //Tests getAllEventsByPersonId

    public function test_getAllEventsByPersonId_idExists_3EventObjects()
    {
        $event1 = new Event(1, 3, '2017-04-01', '2017-04-10');
        $event2 = new Event(2, 3, '2017-03-21', '2017-04-01');
        $event3 = new Event(3, 3, '2017-01-21', '2017-04-01');

        $events = array($event1, $event2, $event3);
        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('execute');
        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('fetchAll')
            ->will($this->returnValue(
                [
                    ['event_id' => $event1->getId(),
                        'person_id' => $event1->getPersonId(),
                        'start_date' => $event1->getStartDate(),
                        'end_date' => $event1->getEndDate()
                    ],
                    ['event_id' => $event2->getId(),
                        'person_id' => $event2->getPersonId(),
                        'start_date' => $event2->getStartDate(),
                        'end_date' => $event2->getEndDate()
                    ],
                    ['event_id' => $event3->getId(),
                        'person_id' => $event3->getPersonId(),
                        'start_date' => $event3->getStartDate(),
                        'end_date' => $event3->getEndDate()
                    ]
                ]));
        $this->mockPDO->expects($this->atLeastOnce())
            ->method('prepare')
            ->will($this->returnValue($this->mockPDOStatement));
        $pdoRepository = new PDOEventRepository($this->mockPDO);
        $actualEvents =
            $pdoRepository->getAllEventsByPersonId($event3->getId());
        $this->assertEquals($events, $actualEvents);
    }


    public function test_getAllEventsByPersonId_idDoesNotExist_Null()
    {
        $event1 = new Event(3, 6, '2018-02-19', '2017-05-01');

        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('execute');
        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('fetchAll')
            ->will($this->returnValue([]));
        $this->mockPDO->expects($this->atLeastOnce())
            ->method('prepare')
            ->will($this->returnValue($this->mockPDOStatement));
        $pdoRepository = new PDOEventRepository($this->mockPDO);
        $actualEvent = $pdoRepository->getAllEventsByPersonId($event1->getId());
        $this->assertNull($actualEvent);
    }

    public function test_getAllEventsByPersonId_exeptionThrownFromPDO_Null()
    {
        $event1 = new Event(3, 6, '2018-02-19', '2017-05-01');


        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('fetchAll')->will(
                $this->throwException(new \PDOException()));
        $this->mockPDO->expects($this->atLeastOnce())
            ->method('prepare')
            ->will($this->returnValue($this->mockPDOStatement));
        $pdoRepository = new PDOEventRepository($this->mockPDO);
        $actualEvent = $pdoRepository->getAllEventsByPersonId($event1->getId());
        $this->assertNull($actualEvent);
    }

    //End Tests getAllEventsByPersonId

    //Tests getByPersonId

    public function test_getByPersonId_idExists_3EventObjects()
    {
        $event1 = new Event(1, 3, '2017-04-01', '2017-04-10');
        $event2 = new Event(2, 3, '2017-03-21', '2017-04-01');
        $event3 = new Event(3, 3, '2017-01-21', '2017-04-01');

        $events = array($event1, $event2, $event3);
        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('execute');
        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('fetchAll')
            ->will($this->returnValue(
                [
                    ['event_id' => $event1->getId(),
                        'person_id' => $event1->getPersonId(),
                        'start_date' => $event1->getStartDate(),
                        'end_date' => $event1->getEndDate()
                    ],
                    ['event_id' => $event2->getId(),
                        'person_id' => $event2->getPersonId(),
                        'start_date' => $event2->getStartDate(),
                        'end_date' => $event2->getEndDate()
                    ],
                    ['event_id' => $event3->getId(),
                        'person_id' => $event3->getPersonId(),
                        'start_date' => $event3->getStartDate(),
                        'end_date' => $event3->getEndDate()
                    ]
                ]));
        $this->mockPDO->expects($this->atLeastOnce())
            ->method('prepare')
            ->will($this->returnValue($this->mockPDOStatement));
        $pdoRepository = new PDOEventRepository($this->mockPDO);
        $actualEvents =
            $pdoRepository->getAllEventsByPersonId($event3->getId());
        $this->assertEquals($events, $actualEvents);
    }


    public function test_getByPersonId_idDoesNotExist_Null()
    {
        $event1 = new Event(3, 6, '2018-02-19', '2017-05-01');

        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('execute');
        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('fetchAll')
            ->will($this->returnValue([]));
        $this->mockPDO->expects($this->atLeastOnce())
            ->method('prepare')
            ->will($this->returnValue($this->mockPDOStatement));
        $pdoRepository = new PDOEventRepository($this->mockPDO);
        $actualEvent = $pdoRepository->getAllEventsByPersonId($event1->getId());
        $this->assertNull($actualEvent);
    }

    public function test_getByPersonId_exeptionThrownFromPDO_Null()
    {
        $event1 = new Event(3, 6, '2018-02-19', '2017-05-01');


        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('fetchAll')->will(
                $this->throwException(new \PDOException()));
        $this->mockPDO->expects($this->atLeastOnce())
            ->method('prepare')
            ->will($this->returnValue($this->mockPDOStatement));
        $pdoRepository = new PDOEventRepository($this->mockPDO);
        $actualEvent = $pdoRepository->getAllEventsByPersonId($event1->getId());
        $this->assertNull($actualEvent);
    }

    //End Tests getByPersonId

    //Tests putEvents  CREATE

    public function test_putEvents_idExists_noReturn()
    {

        $event = new Event(3, 6, '2015-09-20', '2015-10-01');

        $this->mockPDOStatement->expects($this->atLeastOnce())->method('execute');
        $this->mockPDOStatement->expects($this->exactly(4))
            ->method('bindParam');
        $this->mockPDO->expects($this->atLeastOnce())
            ->method('prepare')
            ->will($this->returnValue($this->mockPDOStatement));
        $pdoRepository = new PDOEventRepository($this->mockPDO);
        $pdoRepository->putEvents($event);
    }
    public function test_putEvents_badValues_Null()
    {
        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('bindParam')
            ->will($this->throwException(new \PDOException()));
        $this->mockPDO->expects($this->atLeastOnce())
            ->method('prepare')
            ->will($this->returnValue($this->mockPDOStatement));
        $pdoRepository = new PDOEventRepository($this->mockPDO);
        $returnValue = $pdoRepository->putEvents(new Event(1,2,3,3));
        $this->assertNull($returnValue);
    }
    //End Tests putEvents CREATE

    //Tests postEvents  UPDATE

    public function test_postEvents_idExists_noReturn()
    {

        $event = new Event(3, 6, '2015-09-20', '2015-10-01');

        $this->mockPDOStatement->expects($this->atLeastOnce())->method('execute');
        $this->mockPDOStatement->expects($this->exactly(4))
            ->method('bindParam');
        $this->mockPDO->expects($this->atLeastOnce())
            ->method('prepare')
            ->will($this->returnValue($this->mockPDOStatement));
        $pdoRepository = new PDOEventRepository($this->mockPDO);
        $pdoRepository->postEvents($event);
    }

    public function test_postEvents_badValues_Null()
    {
        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('bindParam')
            ->will($this->throwException(new \PDOException()));
        $this->mockPDO->expects($this->atLeastOnce())
            ->method('prepare')
            ->will($this->returnValue($this->mockPDOStatement));
        $pdoRepository = new PDOEventRepository($this->mockPDO);
        $returnValue = $pdoRepository->postEvents(new Event(1,2,3,3));
        $this->assertNull($returnValue);
    }
    //End Tests postEvents UPDATE

    //Tests deleteEvents

    public function test_deleteEvents_idExists_noReturn()
    {
        $this->mockPDOStatement->expects($this->atLeastOnce())->method('execute');
        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('bindParam');
        $this->mockPDO->expects($this->atLeastOnce())
            ->method('prepare')
           ->will($this->returnValue($this->mockPDOStatement));
        $pdoRepository = new PDOEventRepository($this->mockPDO);
        $pdoRepository->deleteEvents(1);
    }

    public function test_deleteEvents_idDoesNotExist_Null()
    {
        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('bindParam')
            ->will($this->throwException(new \PDOException()));
        $this->mockPDO->expects($this->atLeastOnce())
            ->method('prepare')
            ->will($this->returnValue($this->mockPDOStatement));
        $pdoRepository = new PDOEventRepository($this->mockPDO);
        $returnValue = $pdoRepository->deleteEvents(new Event(1, 2, 3, 3));
        $this->assertNull($returnValue);

    }
    //End Tests deleteEvents

}

