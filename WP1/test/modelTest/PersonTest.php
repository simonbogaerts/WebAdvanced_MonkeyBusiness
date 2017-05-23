<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 23/05/2017
 * Time: 21:27
 */

namespace test\modelTest;


use model\Person;


class PersonTest extends \PHPUnit_Framework_TestCase
{
    public function test_setId_sameId(){
        $person = new Person(1, 'John', 'Johnson', 'Groovestreet', 11, 33556, 'Los Santos');
        $person->setId(2);
        $this->assertEquals($person->getId(), 2 );
    }

    public function test_setFirst_name_sameFirst_name(){
        $person = new Person(1, 'John', 'Johnson', 'Groovestreet', 11, 33556, 'Los Santos');
        $person->setfirstName('Rick');
        $this->assertEquals($person->getFirstName(), 'Rick' );
    }

    public function test_setLastName_sameLastName(){
        $person = new Person(1, 'John', 'Johnson', 'Groovestreet', 11, 33556, 'Los Santos');
        $person->setLastName('Obama');
        $this->assertEquals($person->getLastName(), 'Obama' );
    }

    public function test_setStreet_sameStreet(){
        $person = new Person(1, 'John', 'Johnson', 'Groovestreet', 11, 33556, 'Los Santos');
        $person->setStreet('Ringstraat');
        $this->assertEquals($person->getStreet(), 'Ringstraat' );
    }

    public function test_setNumber_sameNumber(){
        $person = new Person(1, 'John', 'Johnson', 'Groovestreet', 11, 33556, 'Los Santos');
        $person->setNumber(55);
        $this->assertEquals($person->getNumber(), 55);
    }

    public function test_setZip_sameZip(){
        $person = new Person(1, 'John', 'Johnson', 'Groovestreet', 11, 33556, 'Los Santos');
        $person->setZip(115);
        $this->assertEquals($person->getZip(), 115 );
    }

    public function test_setTown_sameTown(){
        $person = new Person(1, 'John', 'Johnson', 'Groovestreet', 11, 33556, 'Los Santos');
        $person->setTown('Hasselt');
        $this->assertEquals($person->getTown(), 'Hasselt');
    }

}
