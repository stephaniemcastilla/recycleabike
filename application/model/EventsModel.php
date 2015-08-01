<?php

class EventsModel
{
  
    public static function getAllEvents()
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT * FROM events ORDER BY date DESC";
        $query = $database->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
    
    public static function getTodaysEvents()
    {
        $database = DatabaseFactory::getFactory()->getConnection();
        
        $today = date("Y-m-d");

        $sql = "SELECT * FROM events WHERE date = :today";
        $query = $database->prepare($sql);
        $query->execute(array(':today' => $today));

        return $query->fetchAll();
    }

    public static function getEventByID($id)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT * FROM events WHERE id = :id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':id' => $id));

        return $query->fetch();
    }

    public static function getEventsByPerson($person_id)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT * FROM events INNER JOIN logs on logs.event_id = events.id WHERE logs.person_id = :person_id";
        $query = $database->prepare($sql);
        $query->execute(array(':person_id' => $person_id));

        return $query->fetchAll();
    }
    
    public static function getEventsByProgram($program_id)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT * FROM events WHERE program_id = :program_id";
        $query = $database->prepare($sql);
        $query->execute(array(':program_id' => $program_id));

        return $query->fetchAll();
    }
    
    public static function createEvent($date, $start, $end, $program_id)
    {     
        // if (!$name || strlen($name) == 0) {
        //     Session::add('feedback_negative', Text::get('FEEDBACK_EVENT_CREATION_FAILED'));
        //     return false;
        // }
        
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "INSERT INTO events (date, start, end,  program_id) VALUES (:date, :start, :end, :program_id)";
        $query = $database->prepare($sql);
        $query->execute(array(':date' => $date, ':start' => $start, ':end' => $end,':program_id' => $program_id));

        if ($query->rowCount() == 1) {
            return true;
        }

        // default return
        Session::add('feedback_negative', Text::get('FEEDBACK_EVENT_CREATION_FAILED'));
        return false;
    }

    public static function updateEvent($id, $date, $start, $end, $program_id)
    {
        
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "UPDATE events SET id = :id, date = :date, start = :start, end = :end, program_id = :program_id WHERE id = :id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':id' => $id, ':date' => $date, ':start' => $start, ':end' => $end, ':program_id' => $program_id, ':id' => $id));

        if ($query->rowCount() == 1) {
            return true;
        }

        Session::add('feedback_negative', Text::get('FEEDBACK_EVENT_EDITING_FAILED'));
        return false;
    }

    public static function deleteEvent($id)
    {
        if (!$id) {
            return false;
        }

        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "DELETE FROM events WHERE id = :id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':id' => $id));

        if ($query->rowCount() == 1) {
            return true;
        }

        Session::add('feedback_negative', Text::get('FEEDBACK_EVENT_DELETION_FAILED'));
        return false;
    }
}
