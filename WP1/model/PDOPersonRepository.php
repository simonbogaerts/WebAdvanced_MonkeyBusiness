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
use PDOException;

class PDOPersonRepository
{
    private $connection = null;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function getAllPersons(){
        try{
            $statement = $this->connection->prepare('SELECT * from person');
            $statement->execute();
            $row = $statement->fetchAll(PDO::FETCH_ASSOC);

            if(count($row) > 0) {
                $data = array();
                for($index = 0; $index < count($row); $index++ ) {
                    $data[] = new Person($row[$index]['person_id'], $row[$index]['first_name'], $row[$index]['last_name'],$row[$index]['street'],$row[$index]['number'],$row[$index]['zip'],$row[$index]['town']);
                }
                return $data;
            }else{
                return null;
            }
        } catch (PDOException $e) {
            return null;
                //'Exception!: ' . $e->getMessage();
        }finally{
            $pdo = null;
        }
    }

    public function getPersonById($id){
        try{
            $statement = $this->connection->prepare('SELECT * FROM person WHERE person_id = :id ');
            $statement->setFetchMode(PDO::FETCH_ASSOC);
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            $statement->execute();

            $row = $statement->fetch();
            if(count($row) > 0) {
                $person = new Person($row[0]['person_id'], $row[0]['first_name'], $row[0]['last_name'], $row[0]['street'], $row[0]['number'], $row[0]['zip'], $row[0]['town']);
                return $person;
            }else{
                return null;
            }
        } catch (PDOException $e) {
            return null;
        }finally{
            $pdo = null;
        }
    }

    public function putPerson($id){
        try{
            $statement = $this->connection->prepare('INSERT INTO person (person_id, first_name, last_name, street, number, zip, town) VALUES (:id, :first_name, :last_name, :street, :number, :zip, :town)');
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            $statement->bindParam(':first_name', $_POST['person_id'], PDO::PARAM_INT);
            $statement->bindParam(':last_name', $_POST['last_name'], PDO::PARAM_STR);
            $statement->bindParam(':street', $_POST['street'], PDO::PARAM_STR);
            $statement->bindParam(':number', $_POST['number'], PDO::PARAM_INT);
            $statement->bindParam(':zip', $_POST['zip'], PDO::PARAM_INT);
            $statement->bindParam(':town', $_POST['town'], PDO::PARAM_STR);
            $statement->execute();
        }
        catch (PDOException $e) {
            return null;
        }
        $pdo = null;
    }
}