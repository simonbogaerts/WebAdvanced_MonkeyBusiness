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
            $statement = $this->connection->query('SELECT * from evenementen');
            $statement->setFetchMode(PDO::FETCH_ASSOC);

            $data = [];
            while ($row = $statement->fetch()) {
                $data[] = [
                    "event_id" => $row['evenement_id'],
                    "person_id" => $row['persoon_id'],
                    "start_date" => $row['start_datum'],
                    "end_date" => $row['eind_datum']
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
            $statement = $this->connection->prepare('SELECT * FROM evenementen WHERE evenement_id = :id');
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
            $statement = $this->connection->prepare('SELECT * FROM evenementen WHERE persoon_id = :id');
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