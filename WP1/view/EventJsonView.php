<?php
/**
 * Created by PhpStorm.
 * User: 11500668
 * Date: 22/03/2017
 * Time: 10:44
 */

namespace view;

use model\Event;


class EventJsonView
{



    public function ShowAll(array $allEvents){
        header('Content-Type: application/json');
        echo '[';
        for($index = 0; $index < sizeof($allEvents); $index++) {
            $event = $allEvents[$index];

                echo json_encode(['id' => $event->getId(), 'person_id' => $event->getPersonId(), 'start_date' => $event->getStartDate(), 'end_date' => $event->getEndDate()]);
                if($index != sizeof($allEvents) - 1){
                    echo ',';
                }
        }
        echo ']';
    }

    public function showEvent(Event $event){
        header('Content-Type: application/json');
        echo json_encode(['id' => $event->getId(), 'person_id' => $event->getPersonId(), 'start_date' => $event->getStartDate(), 'end_date' => $event->getEndDate()]);
    }

}


