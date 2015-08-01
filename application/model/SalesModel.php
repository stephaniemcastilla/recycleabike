<?php

class SalesModel
{

    public static function getAllSales()
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT * FROM sales";
        $query = $database->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public static function getSaleByID($uuid)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT * FROM sales WHERE transaction_id = :transaction_id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':transaction_id' => $transaction_id));

        return $query->fetch();
    }

    public static function createSale($transaction_number, $transaction_make, $transaction_model, $transaction_color, $transaction_price, $transaction_serial, $transaction_photo, $transaction_source, $transaction_status, $transaction_date_in, $transaction_date_out)
    {     
        if (!$transaction_make || strlen($transaction_make) == 0) {
            Session::add('feedback_negative', Text::get('FEEDBACK_BIKE_CREATION_FAILED'));
            return false;
        }
        
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "INSERT INTO sales (transaction_number, transaction_make, transaction_model, transaction_color, transaction_price, transaction_serial, transaction_photo, transaction_source, transaction_status, transaction_date_in, transaction_date_out, user_id) VALUES (:transaction_number, :transaction_make, :transaction_model, :transaction_color, :transaction_price, :transaction_serial, :transaction_photo, :transaction_source, :transaction_status, :transaction_date_in, :transaction_date_out, :user_id)";
        $query = $database->prepare($sql);
        $query->execute(array(':transaction_number' => $transaction_number,':transaction_make' => $transaction_make, ':transaction_model' => $transaction_model, ':transaction_color' => $transaction_color, ':transaction_price' => $transaction_price, ':transaction_serial' => $transaction_serial, ':transaction_photo' => $transaction_photo, ':transaction_source' => $transaction_source, ':transaction_date_in' => $transaction_date_in, ':transaction_status' => $transaction_status, ':transaction_date_out' => $transaction_date_out, ':user_id' => Session::get('user_id')));

        if ($query->rowCount() == 1) {
            return true;
        }

        Session::add('feedback_negative', Text::get('FEEDBACK_BIKE_CREATION_FAILED'));
        return false;
    }

    public static function updateSale($transaction_make, $transaction_model, $transaction_color, $transaction_price, $transaction_points, $transaction_serial, $transaction_photo, $transaction_source, $transaction_date_in, $transaction_date_out)
    {
        if (!$transaction_make) {
          Session::add('feedback_negative', Text::get('FEEDBACK_BIKE_EDITING_FAILED'));
          return false;
        }
        
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "UPDATE sales SET transaction_make = :transaction_make, transaction_model = :transaction_model, transaction_color = :transaction_color,  transaction_price = :transaction_price, transaction_points = :transaction_points, transaction_serial = :transaction_serial, transaction_photo = :transaction_photo, transaction_source = :transaction_source, transaction_date_in = :transaction_date_in, transaction_date_out = :transaction_date_out WHERE transaction_id = :transaction_id AND user_id = :user_id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':transaction_make' => $transaction_make, ':transaction_model' => $transaction_model, ':transaction_color' => $transaction_color, ':transaction_price' => $transaction_price, ':transaction_points' => $transaction_points, ':transaction_serial' => $transaction_serial, ':transaction_photo' => $transaction_photo, ':transaction_source' => $transaction_source, ':transaction_date_in' => $transaction_date_in, ':transaction_date_out' => $transaction_date_out, ':user_id' => Session::get('user_id')));

        if ($query->rowCount() == 1) {
            return true;
        }

        Session::add('feedback_negative', Text::get('FEEDBACK_BIKE_EDITING_FAILED'));
        return false;
    }

    public static function deleteSale($transaction_id)
    {
        if (!$transaction_id) {
            return false;
        }

        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "DELETE FROM sales WHERE transaction_id = :transaction_id AND user_id = :user_id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':transaction_id' => $transaction_id, ':user_id' => Session::get('user_id')));

        if ($query->rowCount() == 1) {
            return true;
        }

        Session::add('feedback_negative', Text::get('FEEDBACK_BIKE_DELETION_FAILED'));
        return false;
    }
}
