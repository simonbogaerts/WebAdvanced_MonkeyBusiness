<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 17/05/2017
 * Time: 11:28
 */

namespace view;
use model\Person;

class PersonJsonView
{
    public function ShowAll(array $allPersons)
    {
        header('Content-Type: application/json');
        echo '[';
        for ($index = 0; $index < sizeof($allPersons); $index++) {
            $person = $allPersons[$index];
            echo json_encode(['id' => $person->getId(), 'first_name' => $person->getFirstName(), 'last_name' => $person->getLastName(), 'street' => $person->getStreet(), 'number' => $person->getNumber(), 'zip' => $person->getZip(), 'town' => $person->getTown()]);
            if ($index != sizeof($allPersons) - 1) {
                echo ',';
            }
        }
        echo ']';
    }


    public function ShowPerson(Person $person){
        header('Content-Type: application/json');
        echo json_encode(['id' => $person->getId(), 'first_name' => $person->getFirstName(), 'last_name' => $person->getLastName(), 'street' => $person->getStreet(), 'number' => $person->getNumber(), 'zip' => $person->getZip(), 'town' => $person->getTown()]);
    }
}