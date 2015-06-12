<?php

class RepairsModel
{
  
    public static function getAllRepairs()
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT * FROM repairs";
        $query = $database->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public static function getRepairByID($id)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT * FROM repairs WHERE uuid = :uuid LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':uuid' => $id));

        return $query->fetch();
    }
    
    public static function getRepairsByBike($bike_id)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT * FROM repairs WHERE bike_id = :bike_id";
        $query = $database->prepare($sql);
        $query->execute(array(':bike_id' => $bike_id));

        return $query->fetchAll();
    }

    public static function createRepair($id, $name)
    {     
        if (!$name || strlen($name) == 0) {
            Session::add('feedback_negative', Text::get('FEEDBACK_PROGRAM_CREATION_FAILED'));
            return false;
        }
        
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "INSERT INTO repairs (id, name) VALUES (:id, :name)";
        $query = $database->prepare($sql);
        $query->execute(array(':id' => $id,':name' => $name));

        if ($query->rowCount() == 1) {
            return true;
        }

        Session::add('feedback_negative', Text::get('FEEDBACK_PROGRAM_CREATION_FAILED'));
        return false;
    }

    public static function updateRepair($uuid, $id, $name)
    {
        if (!$name) {
          Session::add('feedback_negative', Text::get('FEEDBACK_PROGRAM_EDITING_FAILED'));
          return false;
        }
        
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "UPDATE repairs SET id = :id, name = :name WHERE uuid = :uuid LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':id' => $id, ':name' => $name, ':uuid' => $uuid));

        if ($query->rowCount() == 1) {
            return true;
        }

        Session::add('feedback_negative', Text::get('FEEDBACK_PROGRAM_EDITING_FAILED'));
        return false;
    }

    public static function deleteRepair($id)
    {
        if (!$id) {
            return false;
        }

        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "DELETE FROM repairs WHERE uuid = :uuid LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':uuid' => $id));

        if ($query->rowCount() == 1) {
            return true;
        }

        Session::add('feedback_negative', Text::get('FEEDBACK_PROGRAM_DELETION_FAILED'));
        return false;
    }
}
