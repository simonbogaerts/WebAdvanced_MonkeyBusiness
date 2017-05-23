<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 22/05/2017
 * Time: 16:29
 */

namespace test\modelTest;


use model\PDOPersonRepository;
use model\Person;
use PDOException;


class PDOPersonRepositoryTest extends \PHPUnit_Framework_TestCase
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

    // Tests getAllPersons

    public function test_getAllPersons_idExists_2PersonObject()
    {
        $person = new Person(1, 'John', 'Johnson', 'Groovestreet', '11', '33556', 'Los Santos');
        $person2 = new Person(2, 'Rick', 'Sanchez', 'Dimension', '6', 'C-137', 'Los Santos');

        $persons = array($person, $person2);
        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('execute');
        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('fetchAll')
            ->will($this->returnValue(
                [
                    [ 'person_id' => $person->getId(),
                        'first_name' => $person->getFirstName(),
                        'last_name' => $person->getLastName(),
                        'street' => $person->getStreet(),
                        'number' => $person->getNumber(),
                        'zip' => $person->getZip(),
                        'town' => $person->getTown()
                    ],
                    [ 'person_id' => $person2->getId(),
                        'first_name' => $person2->getFirstName(),
                        'last_name' => $person2->getLastName(),
                        'street' => $person2->getStreet(),
                        'number' => $person2->getNumber(),
                        'zip' => $person2->getZip(),
                        'town' => $person2->getTown()
                    ]
                ]));
        $this->mockPDO->expects($this->atLeastOnce())
            ->method('prepare')
            ->will($this->returnValue($this->mockPDOStatement));
        $pdoRepository = new PDOPersonRepository($this->mockPDO);
        $actualPerson =
            $pdoRepository->getAllPersons();
        $this->assertEquals($persons, $actualPerson);
    }

    public function test_getAllPersons_idDoesNotExist_Null()
    {
        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('execute');
        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('fetchAll')
            ->will($this->returnValue([]));
        $this->mockPDO->expects($this->atLeastOnce())
            ->method('prepare')
            ->will($this->returnValue($this->mockPDOStatement));
        $pdoRepository = new PDOPersonRepository($this->mockPDO);
        $actualPerson = $pdoRepository->getAllPersons();
        $this->assertNull($actualPerson);
    }

    public function test_getAllPersons_exeptionThrownFromPDO_Null()
    {
        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('execute')->will(
                $this->throwException(new PDOException()));
        $this->mockPDO->expects($this->atLeastOnce())
            ->method('prepare')
            ->will($this->returnValue($this->mockPDOStatement));
        $pdoRepository = new PDOPersonRepository($this->mockPDO);
        $actualPerson = $pdoRepository->getAllPersons();
        $this->assertNull($actualPerson);
    }

    //End Tests getAllPersons

    //Tests getPersonById

    public function test_getPersonById_idExists_PersonObject()
    {
        $person = new Person(1, 'John', 'Johnson', 'Groovestreet', '11', '33556', 'Los Santos');

        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('bindParam');
        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('execute');
        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('fetch')
            ->will($this->returnValue(
                [
                    [ 'person_id' => $person->getId(),
                        'first_name' => $person->getFirstName(),
                        'last_name' => $person->getLastName(),
                        'street' => $person->getStreet(),
                        'number' => $person->getNumber(),
                        'zip' => $person->getZip(),
                        'town' => $person->getTown()
                    ]
                ]));
        $this->mockPDO->expects($this->atLeastOnce())
            ->method('prepare')
            ->will($this->returnValue($this->mockPDOStatement));
        $pdoRepository = new PDOPersonRepository($this->mockPDO);
        $actualPerson =
            $pdoRepository->getPersonById($person->getId());
        $this->assertEquals($person, $actualPerson);
    }

    public function test_getPersonById_idDoesNotExist_Null()
    {
        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('bindParam');
        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('execute');
        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('fetch')
            ->will($this->returnValue([]));
        $this->mockPDO->expects($this->atLeastOnce())
            ->method('prepare')
            ->will($this->returnValue($this->mockPDOStatement));
        $pdoRepository = new PDOPersonRepository($this->mockPDO);
        $actualPerson = $pdoRepository->getPersonById(989);
        $this->assertNull($actualPerson);
    }
    public function test_getPersonById_exeptionThrownFromPDO_Null()
    {
        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('bindParam')->will(
                $this->throwException(new PDOException()));
        $this->mockPDO->expects($this->atLeastOnce())
            ->method('prepare')
            ->will($this->returnValue($this->mockPDOStatement));
        $pdoRepository = new PDOPersonRepository($this->mockPDO);
        $actualPerson = $pdoRepository->getPersonById(1);
        $this->assertNull($actualPerson);
    }

    //End Tests getPersonById

    //Tests putPerson

    public function test_putEvents_idExists_noReturn()
    {

        $person = new Person(1, 'John', 'Johnson', 'Groovestreet', '11', '33556', 'Los Santos');

        $this->mockPDOStatement->expects($this->atLeastOnce())->method('execute');
        $this->mockPDOStatement->expects($this->exactly(7))
            ->method('bindParam');
        $this->mockPDO->expects($this->atLeastOnce())
            ->method('prepare')
            ->will($this->returnValue($this->mockPDOStatement));
        $pdoRepository = new PDOPersonRepository($this->mockPDO);
        $pdoRepository->putPerson($person);
    }

    //End Tests putPerson
}
