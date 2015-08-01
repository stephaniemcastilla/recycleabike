<?php

class ProgramsModel
{
  
    public static function getAllPrograms()
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT * FROM programs";
        $query = $database->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public static function getProgramByID($id)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT * FROM programs WHERE id = :id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':id' => $id));

        return $query->fetch();
    }
    
    public static function getProgramByEventID($id)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT * FROM programs INNER JOIN events ON events.program_id = programs.id WHERE events.id = :id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':id' => $id));

        return $query->fetch();
    }
    
    public static function createProgram($id, $name)
    {     
        if (!$name || strlen($name) == 0) {
            Session::add('feedback_negative', Text::get('FEEDBACK_PROGRAM_CREATION_FAILED'));
            return false;
        }
        
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "INSERT INTO programs (id, name) VALUES (:id, :name)";
        $query = $database->prepare($sql);
        $query->execute(array(':id' => $id,':name' => $name));

        if ($query->rowCount() == 1) {
            return true;
        }

        Session::add('feedback_negative', Text::get('FEEDBACK_PROGRAM_CREATION_FAILED'));
        return false;
    }

    public static function updateProgram($id, $id, $name)
    {
        if (!$name) {
          Session::add('feedback_negative', Text::get('FEEDBACK_PROGRAM_EDITING_FAILED'));
          return false;
        }
        
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "UPDATE programs SET id = :id, name = :name WHERE id = :id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':id' => $id, ':name' => $name, ':id' => $id));

        if ($query->rowCount() == 1) {
            return true;
        }

        Session::add('feedback_negative', Text::get('FEEDBACK_PROGRAM_EDITING_FAILED'));
        return false;
    }

    public static function deleteProgram($id)
    {
        if (!$id) {
            return false;
        }

        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "DELETE FROM programs WHERE id = :id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':id' => $id));

        if ($query->rowCount() == 1) {
            return true;
        }

        Session::add('feedback_negative', Text::get('FEEDBACK_PROGRAM_DELETION_FAILED'));
        return false;
    }
}
