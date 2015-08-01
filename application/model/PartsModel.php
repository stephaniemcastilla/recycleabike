<?php

class PartsModel
{
  
    public static function getAllParts()
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT * FROM parts";
        $query = $database->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public static function getPartByID($id)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT * FROM parts WHERE id = :id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':id' => $id));

        return $query->fetch();
    }

    public static function createPart($id, $name, $model, $cost, $price, $points)
    {     
        if (!$name || strlen($name) == 0) {
            Session::add('feedback_negative', Text::get('FEEDBACK_PROGRAM_CREATION_FAILED'));
            return false;
        }
        
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "INSERT INTO parts (id, name, model, cost, price, points) VALUES (:id, :name, :model, :cost, :price, :points)";
        $query = $database->prepare($sql);
        $query->execute(array(':id' => $id, ':name' => $name, ':model' => $model, ':cost' => $cost, ':price' => $price, ':points' => $points));

        if ($query->rowCount() == 1) {
            return true;
        }

        Session::add('feedback_negative', Text::get('FEEDBACK_PROGRAM_CREATION_FAILED'));
        return false;
    }

    public static function updatePart($id, $id, $name)
    {
        if (!$name) {
          Session::add('feedback_negative', Text::get('FEEDBACK_PROGRAM_EDITING_FAILED'));
          return false;
        }
        
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "UPDATE parts SET id = :id, name = :name WHERE id = :id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':id' => $id, ':name' => $name, ':id' => $id));

        if ($query->rowCount() == 1) {
            return true;
        }

        Session::add('feedback_negative', Text::get('FEEDBACK_PROGRAM_EDITING_FAILED'));
        return false;
    }

    public static function deletePart($id)
    {
        if (!$id) {
            return false;
        }

        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "DELETE FROM parts WHERE id = :id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':id' => $id));

        if ($query->rowCount() == 1) {
            return true;
        }

        Session::add('feedback_negative', Text::get('FEEDBACK_PROGRAM_DELETION_FAILED'));
        return false;
    }
}
