<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 23/05/2017
 * Time: 14:47
 */

namespace test\controllerTest;


use controller\PersonController;
use model\Person;


class PersonControllerTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->mockPersonRepository = $this->getMockBuilder('model\PDOPersonRepository')
            ->disableOriginalConstructor()
            ->getMock();
        $this->mockView = $this->getMockBuilder('view\PersonJsonView')
            ->getMock();
    }

    public function tearDown()
    {
        $this->mockPersonRepository = null;
        $this->mockView = null;
    }

    //Tests getAllPersons

    function test_getAllPersons_idExists_2EventObject()
    {

        $person = new Person(1, 'John', 'Johnson', 'Groovestreet', '11', '33556', 'Los Santos');
        $person2 = new Person(2, 'Torb', 'Katu', 'Dovestreet', '1', '5589', 'Vice City');

        $persons = array($person, $person2);

        $this->mockPersonRepository->expects($this->atLeastOnce())
            ->method('getAllPersons')->will($this->returnValue($persons));
        $personController = new PersonController($this->mockPersonRepository, $this->mockView);
        $personController->handleFindAllPersons();
    }
    //End Tests getAllPersons



    //Tests handleFindPersonById
    public function test_handleFindPersonById_EventObject()
    {

        $person = new Person(1, 'John', 'Johnson', 'Groovestreet', '11', '33556', 'Los Santos');

        $this->mockPersonRepository->expects($this->atLeastOnce())
            ->method('getPersonById')->will($this->returnValue($person));
        $personController = new PersonController($this->mockPersonRepository, $this->mockView);
        $personController->handleFindPersonById($person->getId());
    }
    //End Tests handleFindPersonById

    //Tests handlePutPerson

    public function test_handlePutPerson_noReturn()
    {
        $this->mockPersonRepository->expects($this->atLeastOnce())->method('putPerson');
        $personController = new PersonController($this->mockPersonRepository, $this->mockView);
        $personController->handlePutPerson(1);
    }

    //End Tests handlePutPerson

}
