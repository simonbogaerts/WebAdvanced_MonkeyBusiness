<?php
/**
 * Created by PhpStorm.
 * User: 11500668
 * Date: 22/03/2017
 * Time: 10:35
 */

namespace model;

use \PDO;
use model\Event;

class PDOEventRepository
{
    private $connection = null;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function getEventsFromDate($from, $until){
        try{
            $statement = $this->connection->prepare('SELECT * FROM events WHERE start_date >= :startdate and end_date <= :enddate');
            $statement->setFetchMode(PDO::FETCH_ASSOC);
            $statement->bindParam(':startdate', $from, PDO::PARAM_STR);
            $statement->bindParam(':enddate', $until, PDO::PARAM_STR);
            $statement->execute();

            $data = array();
            while ($row = $statement->fetch()) {
                $data[] = new Event($row['event_id'], $row['person_id'], $row['start_date'],$row['end_date']);
            }
            return json_encode($data);

        } catch (PDOException $e) {
            return 'Exception!: ' . $e->getMessage();
        }finally{
            $pdo = null;
        }
    }
/*
    public function FindByPersonAndDate($id, $from, $until){
        try{
            $statement = $this->connection->prepare('SELECT * FROM events WHERE start_date >= :startdate and end_date <= :enddate and person_id == :id');
            $statement->setFetchMode(PDO::FETCH_ASSOC);
            $statement->bindParam(':startdate', $from, PDO::PARAM_STR);
            $statement->bindParam(':enddate', $until, PDO::PARAM_STR);
            $statement->bindParam(':id', $id, PDO::PARAM_INT);

            $statement->execute();

            $data = [];
            while ($row = $statement->fetch()) {
                $data[] = array(
                    "event_id" => $row['event_id'],
                    "person_id" => $row['person_id'],
                    "start_date" => $row['start_date'],
                    "end_date" => $row['end_date']
                );
            }
            echo json_encode($data);

        } catch (PDOException $e) {
            echo 'Exception!: ' . $e->getMessage();
        }
        $pdo = null;
    }
*/
    public function getAll()
    {
        try{

            $statement = $this->connection->query('SELECT * from events');
            $statement->setFetchMode(PDO::FETCH_ASSOC);

            $data = array();
            while ($row = $statement->fetch()) {
                $data[] = new Event($row['event_id'], $row['person_id'], $row['start_date'],$row['end_date']);
            }
            return $data;

        } catch (PDOException $e) {
            return 'Exception!: ' . $e->getMessage();
        }finally{
            $pdo = null;

        }
    }


    public function getById($id)
    {
        try{
            $statement = $this->connection->prepare('SELECT * FROM events WHERE event_id = :id');
            $statement->setFetchMode(PDO::FETCH_ASSOC);
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            $statement->execute();

            $row = $statement->fetch();
            $event = new Event($row['event_id'], $row['person_id'], $row['start_date'],$row['end_date']);
            return $event;

        } catch (PDOException $e) {
            return 'Exception!: ' . $e->getMessage();
        }finally{
            $pdo = null;

        }
    }

    public function getAllEventsByPersonId($id)
    {
        try{
            $statement = $this->connection->prepare('SELECT * FROM events WHERE person_id = :id');
            $statement->setFetchMode(PDO::FETCH_ASSOC);
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            $statement->execute();

            $data = array();
            while ($row = $statement->fetch()) {
                $data[] = new Event($row['event_id'], $row['person_id'], $row['start_date'],$row['end_date']);
            }
            return $data;

        } catch (PDOException $e) {
            return 'Exception!: ' . $e->getMessage();
        }finally{
            $pdo = null;
        }
    }

    public function getByPersonId($id){
        try{
            $statement = $this->connection->prepare('SELECT * FROM person WHERE person_id = :id');
            $statement->setFetchMode(PDO::FETCH_ASSOC);
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            $statement->execute();

            $row = $statement->fetch();
            $event = new Event($row['event_id'], $row['person_id'], $row['start_date'],$row['end_date']);
            return $event;

        } catch (PDOException $e) {
            return 'Exception!: ' . $e->getMessage();
        }
        finally{
            $pdo = null;
        }
    }

    public function deleteEvents($id){
        try{
        $statement = $this->connection->prepare('DELETE FROM events where event_id = :id ');
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();
        }
        catch (PDOException $e) {
            echo 'Exception!: ' . $e->getMessage();
        }finally{
            $pdo = null;
        }
    }

    public function postEvents($id){
        try{
            $statement = $this->connection->prepare('UPDATE events SET person_id = :personid, start_date = :startdate, end_date = :enddate WHERE event_id = :id');
            $statement->setFetchMode(PDO::FETCH_ASSOC);
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            $statement->bindParam(':personid', $_POST['person_id'], PDO::PARAM_INT);
            $statement->bindParam(':startdate', $_POST['start_date'], PDO::PARAM_STR);
            $statement->bindParam(':enddate', $_POST['end_date'], PDO::PARAM_STR);
            $statement->execute();
        }
        catch (PDOException $e) {
        echo 'Exception!: ' . $e->getMessage();
        }finally{
            $pdo = null;
        }
    }

    public function putEvents($id){
        try{
            $statement = $this->connection->prepare('INSERT INTO events (event_id, person_id, start_date, end_date) VALUES (?, ?, ?, ?)');
            $statement->setFetchMode(PDO::FETCH_ASSOC);
            $statement->execute(array($id, $_POST['person_id'], $_POST['start_date'],$_POST['end_date']));
        }
        catch (PDOException $e) {
            echo 'Exception!: ' . $e->getMessage();
        }finally{
            $pdo = null;

        }
    }
}