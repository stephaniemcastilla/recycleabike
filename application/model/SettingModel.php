<?php

/**
 * SettingModel
 * This is basically a simple CRUD (Create/Read/Update/Delete) demonstration.
 */
class SettingModel
{
    /**
     * Get all settings (settings are just example data that the user has created)
     * @return array an array with several objects (the results)
     */
    public static function getAllSettings()
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT * FROM settings";
        $query = $database->prepare($sql);
        $query->execute();

        // fetchAll() is the PDO method that gets all result rows
        return $query->fetchAll();
    }

    /**
     * Get a single setting
     * @param int $setting_id id of the specific setting
     * @return object a single object (the result)
     */
    public static function getSetting($id)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT * FROM settings WHERE id = :id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':id' => $id));

        // fetch() is the PDO method that gets a single result
        return $query->fetch();
    }

    /**
     * Set a setting (create a new one)
     * @param string $setting_text setting text that will be created
     * @return bool feedback (was the setting created properly ?)
     */
    public static function createSetting($setting_first, $setting_last, $setting_email)
    {
        if (!$setting_first || strlen($setting_first) == 0 || !$setting_last || strlen($setting_last) == 0 || !$setting_email || strlen($setting_email) == 0) {
            Session::add('feedback_negative', Text::get('FEEDBACK_PERSON_CREATION_FAILED'));
            return false;
        }
        
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "INSERT INTO settings (setting_first, setting_last, setting_email, user_id) VALUES (:setting_first, :setting_last, :setting_email, :user_id)";
        $query = $database->prepare($sql);
        $query->execute(array(':setting_first' => $setting_first, ':setting_last' => $setting_last, ':setting_email' => $setting_email, ':user_id' => Session::get('user_id')));

        if ($query->rowCount() == 1) {
            return true;
        }

        // default return
        Session::add('feedback_negative', Text::get('FEEDBACK_PERSON_CREATION_FAILED'));
        return false;
    }

    /**
     * Update an existing setting
     * @param int $setting_id id of the specific setting
     * @param string $setting_text new text of the specific setting
     * @return bool feedback (was the update successful ?)
     */
    public static function updateSetting($setting_id, $setting_first, $setting_last, $setting_email)
    {
        if (!$setting_id || !$setting_first || !$setting_last || $setting_email) {
            return false;
        }
        
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "UPDATE settings SET setting_first = :setting_first, setting_last = :setting_last, setting_email = :setting_email WHERE setting_id = :setting_id AND user_id = :user_id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':setting_id' => $setting_id, ':setting_first' => $setting_first, ':setting_last' => $setting_last, ':setting_email' => $setting_email, ':user_id' => Session::get('user_id')));

        if ($query->rowCount() == 1) {
            return true;
        }

        Session::add('feedback_negative', Text::get('FEEDBACK_PERSON_EDITING_FAILED'));
        return false;
    }

    /**
     * Delete a specific setting
     * @param int $setting_id id of the setting
     * @return bool feedback (was the setting deleted properly ?)
     */
    public static function deleteSetting($setting_id)
    {
        if (!$setting_id) {
            return false;
        }

        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "DELETE FROM settings WHERE setting_id = :setting_id AND user_id = :user_id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':setting_id' => $setting_id, ':user_id' => Session::get('user_id')));

        if ($query->rowCount() == 1) {
            return true;
        }

        // default return
        Session::add('feedback_negative', Text::get('FEEDBACK_PERSON_DELETION_FAILED'));
        return false;
    }
    /**
     * Get a single setting value
     * @param int $setting_id id of the specific setting
     * @return value a single value (the result)
     */
    public static function getSettingValue($id)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT setting_value FROM settings WHERE id = :id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':id' => $id));

        // fetch() is the PDO method that gets a single result
        return $query->fetchColumn();
    }
    
}
