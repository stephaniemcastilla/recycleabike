<?php

class BikesModel
{
  
    public static function getAllBikes()
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT * FROM bikes";
        $query = $database->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public static function getBikesByType($type)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT * FROM bikes WHERE type_".$type." = 1";
        $query = $database->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
    
    public static function getBikeByID($id)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT * FROM bikes WHERE uuid = :uuid LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':uuid' => $id));

        return $query->fetch();
    }

    public static function createBike($id, $make, $model, $color, $price, $serial, $photo, $source, $status, $mechanic, $date_in, $date_out)
    {     
        if (!$make || strlen($make) == 0) {
            Session::add('feedback_negative', Text::get('FEEDBACK_BIKE_CREATION_FAILED'));
            return false;
        }
        
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "INSERT INTO bikes (id, make, model, color, price, serial, photo, source, status, date_in, date_out, user_id) VALUES (:id, :make, :model, :color, :price, :serial, :photo, :source, :status, :date_in, :date_out, :user_id)";
        $query = $database->prepare($sql);
        $query->execute(array(':id' => $id,':make' => $make, ':model' => $model, ':color' => $color, ':price' => $price, ':serial' => $serial, ':photo' => $photo, ':source' => $source, ':date_in' => $date_in, ':status' => $status, ':date_out' => $date_out, ':user_id' => Session::get('user_id')));

        if ($query->rowCount() == 1) {
            return true;
        }

        Session::add('feedback_negative', Text::get('FEEDBACK_BIKE_CREATION_FAILED'));
        return false;
    }

    public static function updateBike($uuid, $id, $make, $model, $color, $price, $serial, $photo, $source, $status, $mechanic, $date_in, $date_out)
    {
        // if (!$make) {
        //   Session::add('feedback_negative', Text::get('FEEDBACK_BIKE_EDITING_FAILED'));
        //   return false;
        // }
        
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "UPDATE bikes SET make = :make, model = :model, color = :color,  price = :price, serial = :serial, photo = :photo, source = :source, status = :status, mechanic = :mechanic, date_in = :date_in, date_out = :date_out WHERE uuid = :uuid AND user_id = :user_id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':uuid' => $uuid, ':make' => $make, ':model' => $model, ':color' => $color, ':price' => $price, ':serial' => $serial, ':photo' => $photo, ':source' => $source, ':status' => $status, ':mechanic' => $mechanic, ':date_in' => $date_in, ':date_out' => $date_out, ':user_id' => Session::get('user_id')));

        if ($query->rowCount() == 1) {
            return true;
        }

        Session::add('feedback_negative', Text::get('FEEDBACK_BIKE_EDITING_FAILED'));
        return false;
    }

    public static function deleteBike($uuid)
    {
        if (!$uuid) {
            return false;
        }

        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "DELETE FROM bikes WHERE uuid = :uuid LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':uuid' => $uuid));

        if ($query->rowCount() == 1) {
            return true;
        }

        Session::add('feedback_negative', Text::get('FEEDBACK_BIKE_DELETION_FAILED'));
        return false;
    }
}
