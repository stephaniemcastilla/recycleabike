<?php

class PeopleModel
{

    public static function getAllPeople()
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT * FROM people ORDER BY first ASC";
        $query = $database->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public static function getPeopleByType($type)
    {
        $database = DatabaseFactory::getFactory()->getConnection();
        $type = rtrim($type, "s");

        $sql = "SELECT * FROM people WHERE is_".$type." = 1 ORDER BY first ASC ";
        $query = $database->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
    
    public static function getPeopleByEventSignedIn($event_id)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT * FROM people WHERE people.id IN (SELECT hours.person_id FROM hours WHERE hours.event_id = 86 AND hours.status = 'in')";
        $query = $database->prepare($sql);
        $query->execute(array(':event_id' => $event_id));

        return $query->fetchAll();
    }
    
    public static function getPeopleByEventNotSignedIn($event_id)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT * FROM people WHERE people.id NOT IN (SELECT hours.id FROM hours WHERE hours.event_id = :event_id) OR people.id IN (SELECT hours.id FROM hours WHERE hours.event_id = :event_id AND hours.status = 'out')";
        $query = $database->prepare($sql);
        $query->execute(array(':event_id' => $event_id));

        return $query->fetchAll();
    }
    
    public static function getVolunteersExcludedByEvent($event_id)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT * FROM people WHERE is_volunteer = 1 AND people.id NOT IN (SELECT hours.id FROM hours WHERE hours.event_id = :event_id)";
        $query = $database->prepare($sql);
        $query->execute(array(':event_id' => $event_id));

        return $query->fetchAll();
    }
    
    public static function getCustomersExcludedByEvent($event_id)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT * FROM people WHERE is_customer = 1 AND people.id NOT IN (SELECT hours.id FROM hours WHERE hours.event_id = :event_id)";
        $query = $database->prepare($sql);
        $query->execute(array(':event_id' => $event_id));

        return $query->fetchAll();
    }
    
    public static function getPeopleByLast($last)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT * FROM people WHERE last LIKE :last";
        $query = $database->prepare($sql);
        $query->execute(array(':last' => $last));

        return $query->fetchAll();
    }

    public static function getAllCustomers()
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT * FROM people WHERE is_customer = 1";
        $query = $database->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public static function getPersonByID($id)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT * FROM people WHERE id = :id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':id' => $id));

        return $query->fetch();
    }

    public static function createPerson($first, $last, $email)
    {
        // if (!$first || strlen($first) == 0 || !$last || strlen($last) == 0) {
        //     Session::add('feedback_negative', Text::get('FEEDBACK_PERSON_CREATION_FAILED'));
        //     return false;
        // }
        
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "INSERT INTO people (first, last, email) VALUES (:first, :last, :email)";
        $query = $database->prepare($sql);
        $query->execute(array(':first' => $first, ':last' => $last, ':email' => $email));

        if ($query->rowCount() == 1) {
            return true;
        }

        Session::add('feedback_negative', Text::get('FEEDBACK_PERSON_CREATION_FAILED'));
        return false;
    }

    public static function updatePerson($id, $first, $last, $email)
    {
        // if (!$id || !$first || !$last || $email) {
        //     return false;
        // }
        
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "UPDATE people SET first = :first, last = :last, email = :email WHERE id = :id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':id' => $id, ':first' => $first, ':last' => $last, ':email' => $email));

        if ($query->rowCount() == 1) {
            return true;
        }

        Session::add('feedback_negative', Text::get('FEEDBACK_PERSON_EDITING_FAILED'));
        return false;
    }

    public static function deletePerson($id)
    {
        if (!$id) {
            return false;
        }

        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "DELETE FROM people WHERE id = :id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':id' => $id));

        if ($query->rowCount() == 1) {
            return true;
        }

        Session::add('feedback_negative', Text::get('FEEDBACK_PERSON_DELETION_FAILED'));
        return false;
    }


    public static function getAllTotalTime()
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT people.id as person_id, sum(hours.total_time) as time FROM people INNER JOIN hours ON hours.person_id = people.id GROUP BY people.id";
        $query = $database->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
    
    public static function getAllTotalPoints()
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT people.id as person_id, sum(hours.total_points) as points FROM people INNER JOIN hours ON hours.person_id = people.id GROUP BY people.id";
        $query = $database->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
    
    public static function getPersonTime($id)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT total_time FROM people WHERE id = :id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':id' => $id));

        return $query->fetchColumn();
    }
    
    public static function getPersonTotalPoints($id)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT sum(total_points) FROM hours WHERE person_id = :id;";
        $query = $database->prepare($sql);
        $query->execute(array(':id' => $id));

        return $query->fetchColumn();
    }
    
    public static function getPersonAvailablePoints($id)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT available_points FROM people WHERE id = :id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':id' => $id));

        return $query->fetchColumn();
    }

    public static function getPersonRevenue($id)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT total_revenue FROM people WHERE id = :id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':id' => $id));

        return $query->fetchColumn();
    }

    public static function updatePersonTime($id, $total_time)
    {
        if (!$id || !$total_time) {
            //return false;
        }
        
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "UPDATE people SET total_time = :total_time WHERE id = :id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':id' => $id, ':total_time' => $total_time));

        if ($query->rowCount() == 1) {
            return true;
        }

        Session::add('feedback_negative', Text::get('FEEDBACK_PERSON_TIME_EDITING_FAILED'));
        return false;
    }

    public static function updatePersonTotalPoints($id, $total_points)
    {
        if (!$id || !$total_points) {
            return false;
        }
        
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "UPDATE people SET total_points = :total_points WHERE id = :id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':id' => $id, ':total_points' => $total_points));

        if ($query->rowCount() == 1) {
            return true;
        }

        Session::add('feedback_negative', Text::get('FEEDBACK_PERSON_POINTS_EDITING_FAILED'));
        return false;
    }
    
    public static function updatePersonAvailablePoints($id, $available_points)
    {
        if (!$id || !$available_points) {
            return false;
        }
        
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "UPDATE people SET available_points = :available_points WHERE id = :id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':id' => $id, ':available_points' => $available_points));

        if ($query->rowCount() == 1) {
            return true;
        }

        Session::add('feedback_negative', Text::get('FEEDBACK_PERSON_POINTS_EDITING_FAILED'));
        return false;
    }

    public static function updatePersonRevenue($id, $total_revenue)
    {
        if (!$id || !$total_revenue) {
            return false;
        }
        
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "UPDATE people SET total_revenue = :total_revenue WHERE id = :id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':id' => $id, ':total_revenue' => $total_revenue));

        if ($query->rowCount() == 1) {
            return true;
        }

        Session::add('feedback_negative', Text::get('FEEDBACK_PERSON_REVENUE_EDITING_FAILED'));
        return false;
    }
}
