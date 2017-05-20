<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 17/05/2017
 * Time: 11:24
 */

namespace model;

use controller\PersonController;
use \PDO;
use model\Person;

class PDOPersonRepository
{
    private $connection = null;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function getAllPersons(){
        try{
            $statement = $this->connection->query('SELECT * from person');
            $statement->setFetchMode(PDO::FETCH_ASSOC);

            $data = array();
            while ($row = $statement->fetch()) {
                $data[] = new Person($row['person_id'], $row['first_name'], $row['last_name'],$row['street'],$row['number'],$row['zip'],$row['town']);
            }
            return $data;

        } catch (PDOException $e) {
            return 'Exception!: ' . $e->getMessage();
        }finally{
            $pdo = null;
        }
    }

    public function getPersonById($id){
        try{
            $statement = $this->connection->prepare('SELECT *  FROM person WHERE person_id = :id ');
            $statement->setFetchMode(PDO::FETCH_ASSOC);
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            $statement->execute();

            $row = $statement->fetch();
            $person = new Person($row['person_id'], $row['first_name'], $row['last_name'],$row['street'],$row['number'],$row['zip'],$row['town']);
            return $person;
        } catch (PDOException $e) {
            return 'Exception!: ' . $e->getMessage();
        }finally{
            $pdo = null;
        }
    }

    public function putPerson($id){
        try{
            $statement = $this->connection->prepare('INSERT INTO person (person_id, first_name, last_name, street, number, zip, town) VALUES (?, ?, ?, ?, ?, ?, ?)');
            $statement->setFetchMode(PDO::FETCH_ASSOC);
            $statement->execute(array($id, $_POST['first_name'],$_POST['last_name'],$_POST['street'], $_POST['number'], $_POST['number'], $_POST['zip'],$_POST['town']));
        }
        catch (PDOException $e) {
            echo 'Exception!: ' . $e->getMessage();
        }
        $pdo = null;
    }
}