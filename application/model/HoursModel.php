<?php

class HoursModel
{

    public static function getAllHours()
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT * FROM hours";
        $query = $database->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public static function getHourByID($hour_uuid)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT * FROM hours WHERE hour_uuid = :hour_uuid LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':hour_uuid' => $hour_uuid));

        return $query->fetch();
    }

    public static function getHoursByPerson($person_id)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT * FROM hours WHERE hours.person_id = :person_id";
        $query = $database->prepare($sql);
        $query->execute(array(':person_id' => $person_id));

        return $query->fetchAll();
    }
    
    public static function getHoursByEvent($event_id)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT * FROM hours WHERE event_id = :event_id";
        $query = $database->prepare($sql);
        $query->execute(array(':event_id' => $event_id));

        return $query->fetchAll();
    }

    public static function createHour($date, $person_id, $start, $end, $status, $total_time, $total_points, $total_revenue, $event_id)
    {          
  
        $database = DatabaseFactory::getFactory()->getConnection();
        
        $sql = "INSERT INTO hours (date, person_id, start, end, status, total_time, total_points, total_revenue, event_id) VALUES (:date, :person_id, :start, :end, :status, :total_time, :total_points, :total_revenue, :event_id)";
        $query = $database->prepare($sql);
        $query->execute(array(':date' => $date, ':person_id' => $person_id, ':start' => $start, ':end' => $end, ':status' => $status, ':total_time' => $total_time, ':total_points' => $total_points, ':total_revenue' => $total_revenue, ':event_id' => $event_id));
        

        if ($query->rowCount() == 1) {
            return true;
        }

        Session::add('feedback_negative', Text::get('FEEDBACK_TIMESHEET_CREATION_FAILED'));
        return false;
    }
    
    public static function updateHour($uuid, $date, $person_id, $start, $end, $status, $total_time, $total_points, $total_revenue, $event_id)
    {
        
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "UPDATE hours SET date = :date, person_id = :person_id, start = :start, end = :end, status = :status, total_time = :total_time, total_points = :total_points, total_revenue = :total_revenue, event_id = :event_id, WHERE id = :id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':uuid' => $uuid, ':date' => $date, ':person_id' => $person_id, ':start' => $start, ':end' => $end, ':status' => $status));

        if ($query->rowCount() == 1) {
            return true;
        }

        Session::add('feedback_negative', Text::get('FEEDBACK_TIMESHEET_EDITING_FAILED'));
        return false;
    }
    
    public static function signOutHour($uuid, $end, $status, $total_time, $total_points, $total_revenue)
    {
        
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "UPDATE hours SET end = :end, status = :status, total_time = :total_time, total_points = :total_points, total_revenue = :total_revenue WHERE hour_uuid = :uuid LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':uuid' => $uuid, ':end' => $end, ':status' => $status, ':total_time' => $total_time, ':total_points' => $total_points, ':total_revenue' => $total_revenue));

        if ($query->rowCount() == 1) {
            return true;
        }

        Session::add('feedback_negative', Text::get('FEEDBACK_TIMESHEET_EDITING_FAILED'));
        return false;
    }

    public static function deleteHour($uuid)
    {
        // if (!$uuid) {
        //     return false;
        // }

        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "DELETE FROM hours WHERE uuid = :uuid LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':uuid' => $uuid));

        if ($query->rowCount() == 1) {
            return true;
        }

        Session::add('feedback_negative', Text::get('FEEDBACK_TIMESHEET_DELETION_FAILED'));
        return false;
    }

    public static function deleteHoursByPerson($person_id)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "DELETE FROM hours WHERE person_id = :person_id AND user_id = :user_id";
        $query = $database->prepare($sql);
        $query->execute(array(':person_id' => $person_id, ':user_id' => Session::get('user_id')));

        if ($query->rowCount() > 0) {
            return true;
        }

        Session::add('feedback_negative', Text::get('FEEDBACK_TIMESHEET_DELETION_FAILED'));
        return false;
    }

    public static function getAllTime()
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT * FROM hours WHERE is_hourged_time = 1 AND user_id = :user_id";
        $query = $database->prepare($sql);
        $query->execute(array(':user_id' => Session::get('user_id')));

        return $query->fetchAll();
    }

    public static function getTimeByEvent($uuid)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT * FROM hours WHERE is_hourged_time = 1 AND parent_id = :parent_id AND user_id = :user_id";
        $query = $database->prepare($sql);
        $query->execute(array(':parent_id' => $uuid, ':user_id' => Session::get('user_id')));

        return $query->fetchAll();
    } 

    public static function getAllEvents()
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT * FROM hours WHERE is_scheduled_event = 1 AND user_id = :user_id";
        $query = $database->prepare($sql);
        $query->execute(array(':user_id' => Session::get('user_id')));

        return $query->fetchAll();
    }

}
