<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 17/05/2017
 * Time: 11:24
 */

namespace model;

use \PDO;

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

            $data = [];
            while ($row = $statement->fetch()) {
                $data[] = array(
                    "person_id" => $row['person_id'],
                    "first_name" => $row['first_name'],
                    "last_name" => $row['last_name'],
                    "street" => $row['street'],
                    "number" => $row['number'],
                    "zip" => $row['zip'],
                    "town" => $row['town']
                );
            }
            echo json_encode($data);

        } catch (PDOException $e) {
            echo 'Exception!: ' . $e->getMessage();
        }
        $pdo = null;
    }

    public function getPersonById($id){
        try{
                $statement = $this->connection->prepare('SELECT *  FROM person WHERE person_id = :id ');
            $statement->setFetchMode(PDO::FETCH_ASSOC);
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            $statement->execute();

            $row = $statement->fetch();
            echo json_encode($row);
        } catch (PDOException $e) {
            echo 'Exception!: ' . $e->getMessage();
        }
        $pdo = null;
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