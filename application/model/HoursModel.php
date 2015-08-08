<?php

class HoursModel
{

    public static function getAllHours()
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT * FROM hours ORDER BY start DESC";
        $query = $database->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public static function getHourByID($id){
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT * FROM hours WHERE id = :id";
        $query = $database->prepare($sql);
        $query->execute(array(':id' => $id));

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
    
    public static function getHoursCountByEvent($event_id)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT count(*) FROM hours WHERE event_id = :event_id";
        $query = $database->prepare($sql);
        $query->execute(array(':event_id' => $event_id));

        return $query->fetchColumn();
    }
    
    public static function signIn($person_id, $event_id, $start, $mode, $status, $total_time, $total_points, $total_revenue)
    {          
  
        $database = DatabaseFactory::getFactory()->getConnection();
        
        $sql = "INSERT INTO hours (person_id, event_id, start, mode, status, total_time, total_points, total_revenue) VALUES (:person_id, :event_id, :start, :mode, :status, :total_time, :total_points, :total_revenue)";
        $query = $database->prepare($sql);
        $query->execute(array(':person_id' => $person_id, ':event_id' => $event_id, ':start' => $start, ':mode' => $mode, ':status' => $status, ':total_time' => $total_time, ':total_points' => $total_points, ':total_revenue' => $total_revenue));
        

        if ($query->rowCount() == 1) {
            return true;
        }

        Session::add('feedback_negative', Text::get('FEEDBACK_TIMESHEET_CREATION_FAILED'));
        return false;
    }
    

    public static function createHour($person_id, $event_id, $start, $end, $mode, $status, $total_time, $total_points, $total_revenue)
    {          
  
        $database = DatabaseFactory::getFactory()->getConnection();
        
        $sql = "INSERT INTO hours (person_id, event_id, start, end, mode, status, total_time, total_points, total_revenue) VALUES (:person_id, :event_id, :start, :end, :mode, :status, :total_time, :total_points, :total_revenue)";
        $query = $database->prepare($sql);
        $query->execute(array(':person_id' => $person_id, ':event_id' => $event_id, ':start' => $start, ':end' => $end, ':mode' => $mode, ':status' => $status, ':total_time' => $total_time, ':total_points' => $total_points, ':total_revenue' => $total_revenue));
        

        if ($query->rowCount() == 1) {
            return true;
        }

        Session::add('feedback_negative', Text::get('FEEDBACK_TIMESHEET_CREATION_FAILED'));
        return false;
    }
    
    public static function updateHour($id, $date, $person_id, $start, $end, $status, $total_time, $total_points, $total_revenue, $event_id)
    {
        
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "UPDATE hours SET date = :date, person_id = :person_id, start = :start, end = :end, status = :status, total_time = :total_time, total_points = :total_points, total_revenue = :total_revenue, event_id = :event_id, WHERE id = :id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':id' => $id, 'date' =>$date, ':person_id' => $person_id, ':start' => $start, ':end' => $end, ':status' => $status));

        if ($query->rowCount() == 1) {
            return true;
        }

        Session::add('feedback_negative', Text::get('FEEDBACK_TIMESHEET_EDITING_FAILED'));
        return false;
    }
    
    public static function signOutHour($id, $end, $status, $total_time, $total_points, $total_revenue)
    {
        
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "UPDATE hours SET end = :end, status = :status, total_time = :total_time, total_points = :total_points, total_revenue = :total_revenue WHERE id = :id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':id' => $id, ':end' => $end, ':status' => $status, ':total_time' => $total_time, ':total_points' => $total_points, ':total_revenue' => $total_revenue));

        if ($query->rowCount() == 1) {
            return true;
        }

        Session::add('feedback_negative', Text::get('FEEDBACK_TIMESHEET_EDITING_FAILED'));
        return false;
    }

    public static function deleteHour($id)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "DELETE FROM hours WHERE id = :id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':id' => $id));

        if ($query->rowCount() == 1) {
            return true;
        }

        Session::add('feedback_negative', Text::get('FEEDBACK_TIMESHEET_DELETION_FAILED'));
        return false;
    }

    public static function deleteHoursByPerson($person_id)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "DELETE FROM hours WHERE person_id = :person_id";
        $query = $database->prepare($sql);
        $query->execute(array(':person_id' => $person_id));

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

    public static function getTimeByEvent($id)
    {
        $database = Databaidctory::getFactory()->getConnection();

        $sql = "SELECT * FROM hours WHERE is_hourged_time = 1 AND parent_id = :parent_id";
        $query = $database->prepare($sql);
        $query->execute(array(':parent_id' => $id));

        return $query->fetchAll();
    } 

    public static function getAllEvents()
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT * FROM hours WHERE is_scheduled_event = 1";
        $query = $database->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

}
