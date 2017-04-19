<?php
/**
 * Created by PhpStorm.
 * User: 11500668
 * Date: 22/03/2017
 * Time: 10:35
 */

namespace model;

use \PDO;

class PDOEventRepository
{
    private $connection = null;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function getAll()
    {
        try{
            $statement = $this->connection->query('SELECT * from events');
            $statement->setFetchMode(PDO::FETCH_ASSOC);

            $data = [];
            while ($row = $statement->fetch()) {
                $data[] = [
                    "event_id" => $row['event_id'],
                    "person_id" => $row['person_id'],
                    "start_date" => $row['start_date'],
                    "end_date" => $row['end_date']
                ];
            }
            echo json_encode($data);

        } catch (PDOException $e) {
            echo 'Exception!: ' . $e->getMessage();
        }
        $pdo = null;
    }

    public function getAllPersons()
    {
        try{
            $statement = $this->connection->query('SELECT * from person');
            $statement->setFetchMode(PDO::FETCH_ASSOC);

            $data = [];
            while ($row = $statement->fetch()) {
                $data[] = [
                    "person_id" => $row['person_id'],
                    "first_name" => $row['first_name'],
                    "last_name" => $row['last_name'],
                    "street" => $row['street'],
                    "number" => $row['number'],
                    "zip" => $row['zip'],
                    "town" => $row['town']
                ];
            }
            echo json_encode($data);

        } catch (PDOException $e) {
            echo 'Exception!: ' . $e->getMessage();
        }
        $pdo = null;
    }

    public function getById($id)
    {
        try{
            $statement = $this->connection->prepare('SELECT * FROM events WHERE event_id = :id');
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

    public function getByPersonId($id){
        try{
            $statement = $this->connection->prepare('SELECT * FROM person WHERE person_id = :id');
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
}