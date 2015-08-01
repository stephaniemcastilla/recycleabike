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

        $sql = "SELECT * FROM bikes WHERE id = :id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':id' => $id));

        return $query->fetch();
    }

    public static function createBike($rab_id, $make, $model, $color, $price, $serial, $photo, $source, $status, $mechanic, $date_in, $date_out)
    {     
        if (!$make || strlen($make) == 0) {
            Session::add('feedback_negative', Text::get('FEEDBACK_BIKE_CREATION_FAILED'));
            return false;
        }
        
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "INSERT INTO bikes (rab_id, make, model, color, price, serial, photo, source, status, date_in, date_out) VALUES (:rab_id, :make, :model, :color, :price, :serial, :photo, :source, :status, :date_in, :date_out)";
        $query = $database->prepare($sql);
        $query->execute(array(':rab_id' => $rab_id,':make' => $make, ':model' => $model, ':color' => $color, ':price' => $price, ':serial' => $serial, ':photo' => $photo, ':source' => $source, ':status' => $status, ':date_in' => $date_in, ':date_out' => $date_out));

        if ($query->rowCount() == 1) {
            return true;
        }

        Session::add('feedback_negative', Text::get('FEEDBACK_BIKE_CREATION_FAILED'));
        return false;
    }

    public static function updateBike($id, $rab_id, $make, $model, $color, $price, $serial, $photo, $source, $status, $mechanic, $date_in, $date_out)
    {
        // if (!$make) {
        //   Session::add('feedback_negative', Text::get('FEEDBACK_BIKE_EDITING_FAILED'));
        //   return false;
        // }
        
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "UPDATE bikes SET make = :make, model = :model, color = :color,  price = :price, serial = :serial, photo = :photo, source = :source, status = :status, mechanic = :mechanic, date_in = :date_in, date_out = :date_out WHERE id = :id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':id' => $id, ':rab_id' => $rab_id, ':make' => $make, ':model' => $model, ':color' => $color, ':price' => $price, ':serial' => $serial, ':photo' => $photo, ':source' => $source, ':status' => $status, ':mechanic' => $mechanic, ':date_in' => $date_in, ':date_out' => $date_out));

        if ($query->rowCount() == 1) {
            return true;
        }

        Session::add('feedback_negative', Text::get('FEEDBACK_BIKE_EDITING_FAILED'));
        return false;
    }

    public static function deleteBike($id)
    {
        if (!$id) {
            return false;
        }

        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "DELETE FROM bikes WHERE id = :id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':id' => $id));

        if ($query->rowCount() == 1) {
            return true;
        }

        Session::add('feedback_negative', Text::get('FEEDBACK_BIKE_DELETION_FAILED'));
        return false;
    }
}
