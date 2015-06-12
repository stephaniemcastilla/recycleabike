<?php

class PeopleModel
{

    public static function getAllPeople()
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT * FROM people";
        $query = $database->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public static function getPeopleByType($type)
    {
        $database = DatabaseFactory::getFactory()->getConnection();
        $type = rtrim($type, "s");

        $sql = "SELECT * FROM people WHERE is_".$type." = 1";
        $query = $database->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
    
    public static function getPeopleByEventSignedIn($event_id)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT * FROM people WHERE people.person_uuid IN (SELECT hours.person_id FROM hours WHERE hours.event_id = :event_id AND hours.status = 'in')";
        $query = $database->prepare($sql);
        $query->execute(array(':event_id' => $event_id));

        return $query->fetchAll();
    }
    
    public static function getPeopleByEventNotSignedIn($event_id)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT * FROM people WHERE people.person_uuid NOT IN (SELECT hours.person_id FROM hours WHERE hours.event_id = :event_id) OR people.person_uuid IN (SELECT hours.person_id FROM hours WHERE hours.event_id = :event_id AND hours.status = 'out')";
        $query = $database->prepare($sql);
        $query->execute(array(':event_id' => $event_id));

        return $query->fetchAll();
    }
    
    public static function getVolunteersExcludedByEvent($event_id)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT * FROM people WHERE is_volunteer = 1 AND people.person_uuid NOT IN (SELECT hours.person_id FROM hours WHERE hours.event_id = :event_id)";
        $query = $database->prepare($sql);
        $query->execute(array(':event_id' => $event_id));

        return $query->fetchAll();
    }
    
    public static function getCustomersExcludedByEvent($event_id)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT * FROM people WHERE is_customer = 1 AND people.person_uuid NOT IN (SELECT hours.person_id FROM hours WHERE hours.event_id = :event_id)";
        $query = $database->prepare($sql);
        $query->execute(array(':event_id' => $event_id));

        return $query->fetchAll();
    }
    
    public static function getVolunteersByLastName($lastname)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT * FROM people WHERE is_volunteer = 1 AND user_id = :user_id";
        $query = $database->prepare($sql);
        $query->execute(array(':user_id' => Session::get('user_id')));

        return $query->fetchAll();
    }

    public static function getAllCustomers()
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT * FROM people WHERE is_customer = 1 AND user_id = :user_id";
        $query = $database->prepare($sql);
        $query->execute(array(':user_id' => Session::get('user_id')));

        return $query->fetchAll();
    }

    public static function getPersonByID($uuid)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT * FROM people WHERE user_id = :user_id AND person_uuid = :uuid LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':user_id' => Session::get('user_id'), ':uuid' => $uuid));

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

    public static function updatePerson($uuid, $first, $last, $email)
    {
        // if (!$uuid || !$first || !$last || $email) {
        //     return false;
        // }
        
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "UPDATE people SET first = :first, last = :last, email = :email WHERE person_uuid = :uuid AND user_id = :user_id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':uuid' => $uuid, ':first' => $first, ':last' => $last, ':email' => $email, ':user_id' => Session::get('user_id')));

        if ($query->rowCount() == 1) {
            return true;
        }

        Session::add('feedback_negative', Text::get('FEEDBACK_PERSON_EDITING_FAILED'));
        return false;
    }

    public static function deletePerson($uuid)
    {
        if (!$uuid) {
            return false;
        }

        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "DELETE FROM people WHERE person_uuid = :uuid AND user_id = :user_id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':uuid' => $uuid, ':user_id' => Session::get('user_id')));

        if ($query->rowCount() == 1) {
            return true;
        }

        Session::add('feedback_negative', Text::get('FEEDBACK_PERSON_DELETION_FAILED'));
        return false;
    }

    public static function getPersonTime($person_uuid)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT total_time FROM people WHERE person_uuid = :person_uuid LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':person_uuid' => $person_uuid));

        return $query->fetchColumn();
    }

    public static function getPersonPoints($person_uuid)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT total_points FROM people WHERE person_uuid = :person_uuid LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':person_uuid' => $person_uuid));

        return $query->fetchColumn();
    }

    public static function getPersonRevenue($uuid)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT total_revenue FROM people WHERE person_uuid = :uuid LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':uuid' => $uuid));

        return $query->fetchColumn();
    }

    public static function updatePersonTime($person_uuid, $total_time)
    {
        if (!$person_uuid || !$total_time) {
            //return false;
        }
        
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "UPDATE people SET total_time = :total_time WHERE person_uuid = :person_uuid LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':person_uuid' => $person_uuid, ':total_time' => $total_time));

        if ($query->rowCount() == 1) {
            return true;
        }

        Session::add('feedback_negative', Text::get('FEEDBACK_PERSON_TIME_EDITING_FAILED'));
        return false;
    }

    public static function updatePersonPoints($person_uuid, $total_points)
    {
        if (!$person_uuid || !$total_points) {
            return false;
        }
        
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "UPDATE people SET total_points = :total_points WHERE person_uuid = :person_uuid LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':person_uuid' => $person_uuid, ':total_points' => $total_points));

        if ($query->rowCount() == 1) {
            return true;
        }

        Session::add('feedback_negative', Text::get('FEEDBACK_PERSON_POINTS_EDITING_FAILED'));
        return false;
    }

    public static function updatePersonRevenue($uuid, $total_revenue)
    {
        if (!$uuid || !$total_revenue) {
            return false;
        }
        
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "UPDATE people SET total_revenue = :total_revenue WHERE person_uuid = :uuid AND user_id = :user_id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':uuid' => $uuid, ':total_revenue' => $total_revenue, ':user_id' => Session::get('user_id')));

        if ($query->rowCount() == 1) {
            return true;
        }

        Session::add('feedback_negative', Text::get('FEEDBACK_PERSON_REVENUE_EDITING_FAILED'));
        return false;
    }
}
