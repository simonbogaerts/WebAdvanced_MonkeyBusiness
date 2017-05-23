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
use PDOException;

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
            $statement->bindParam(':startdate', $from, PDO::PARAM_STR);
            $statement->bindParam(':enddate', $until, PDO::PARAM_STR);
            $statement->execute();
            $row = $statement->fetchAll(PDO::FETCH_ASSOC);

            if(count($row) > 0) {
                $data = array();
                for($index = 0; $index < count($row); $index++ ) {
                    $data[] = new Event($row[$index]['event_id'], $row[$index]['person_id'], $row[$index]['start_date'], $row[$index]['end_date']);
                }
                return $data;
            }else{
                return null;
            }
        } catch (PDOException $e) {
            return null;
        }finally{
            $pdo = null;
        }
    }

    public function getByPersonAndDate($id, $from, $until){
        try{
            $statement = $this->connection->prepare('SELECT * FROM events WHERE (start_date >= :startdate and end_date <= :enddate) and person_id = :id');
            $statement->bindParam(':startdate', $from, PDO::PARAM_STR);
            $statement->bindParam(':enddate', $until, PDO::PARAM_STR);
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            $statement->execute();
            $row = $statement->fetchAll(PDO::FETCH_ASSOC);

            if(count($row) > 0) {
                $data = array();
                for($index = 0; $index < count($row); $index++ ) {
                    $data[] = new Event($row[$index]['event_id'], $row[$index]['person_id'], $row[$index]['start_date'], $row[$index]['end_date']);
                }
                return $data;
            }else{
                return null;
            }
        } catch (PDOException $e) {
            return null;
        }finally{
            $pdo = null;
        }
    }

    public function getAll()
    {
        try{

            $statement = $this->connection->prepare('SELECT * from events');
            $statement->execute();
            $row = $statement->fetchAll(PDO::FETCH_ASSOC);

            if(count($row) > 0) {
                $data = array();
                for($index = 0; $index < count($row); $index++ ) {
                    $data[] = new Event($row[$index]['event_id'], $row[$index]['person_id'], $row[$index]['start_date'], $row[$index]['end_date']);
                }
                return $data;
            }else{
                return null;
            }
        } catch (PDOException $e) {
            return null;
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
            $row = $statement->fetchAll(PDO::FETCH_ASSOC);

            if(count($row) > 0) {
                $event = new Event($row[0]['event_id'], $row[0]['person_id'], $row[0]['start_date'], $row[0]['end_date']);
                return $event;
            } else {
                return null;
            }
        } catch (PDOException $e) {
            return null;
        }finally{
            $pdo = null;

        }
    }

    public function getAllEventsByPersonId($id)
    {
        try{
            $statement = $this->connection->prepare('SELECT * FROM events WHERE person_id = :id');
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            $statement->execute();
            $row = $statement->fetchAll(PDO::FETCH_ASSOC);

            if(count($row) > 0) {
                $data = array();
                for($index = 0; $index < count($row); $index++ ) {
                    $data[] = new Event($row[$index]['event_id'], $row[$index]['person_id'], $row[$index]['start_date'], $row[$index]['end_date']);
                }
                return $data;
            }else{
                return null;
            }
        } catch (PDOException $e) {
            return null;
        }finally{
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
            return null;
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
            return null;
        }finally{
            $pdo = null;
        }
    }

    public function putEvents($id){
        try{
            $statement = $this->connection->prepare('INSERT INTO events (event_id, person_id, start_date, end_date) VALUES (:id, :personid, :startdate, :enddate)');
            $statement->setFetchMode(PDO::FETCH_ASSOC);
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            $statement->bindParam(':personid', $_POST['person_id'], PDO::PARAM_INT);
            $statement->bindParam(':startdate', $_POST['start_date'], PDO::PARAM_STR);
            $statement->bindParam(':enddate', $_POST['end_date'], PDO::PARAM_STR);
            $statement->execute();
        }
        catch (PDOException $e) {
            return null;
        }finally{
            $pdo = null;

        }
    }
}