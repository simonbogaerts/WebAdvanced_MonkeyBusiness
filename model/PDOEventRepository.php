<?php
/**
 * Created by PhpStorm.
 * User: 11500668
 * Date: 22/03/2017
 * Time: 10:35
 */

namespace model;


class PDOEventRepository
{
    private $pdo = null;

    public function __construct( $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAll()
    {
        try{
            $statement = $this->pdo->query('SELECT * from evenementen');
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
            print 'Exception!: ' . $e->getMessage();
        }
        $pdo = null;
    }

    public function get($id)
    {
        echo 'check!';
    }
}