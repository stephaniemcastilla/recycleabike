<?php

class HoursController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        // Ensure User Is Logged In
        //Auth::checkAuthentication();
    }

    public function index()
    {
        $this->View->render('hours/index', array(
            'hours' => HoursModel::getAllHours(),
            'events' => EventsModel::getAllEvents(), 
            'people' => PeopleModel::getAllPeople()
        ));
    }

    public function create()
    {

        $status = "in";
        
        $points_setting = SettingModel::getSettingValue(1);
        $revenue_setting = SettingModel::getSettingValue(2);

        $start = Request::post('start');
        $end = Request::post('end');

        $start = strtotime($start);
        $end = strtotime($end);
        $total_time = $end - $start;
        $total_time = $total_time/60/60;
        
        $person_time = PeopleModel::getPersonTime(Request::post('person_id'));
        $person_time = $person_time + $total_time;
        PeopleModel::updatePersonTime(Request::post('person_id'), $person_time);

        $mode = Request::post('mode');

        $total_points = "NULL"; 
        $total_revenue = "NULL";
        $available_points = "NULL"; 
        
        if ($mode == "points"){
          
          $total_points = $total_time * $points_setting;
           
          $person_total_points = PeopleModel::getPersonTOtalPoints(Request::post('person_id'));
          $person_total_points = $person_total_points + $total_points;
          PeopleModel::updatePersonTotalPoints(Request::post('person_id'), $person_total_points);
                    
          $person_available_points = PeopleModel::getPersonAvailablePoints(Request::post('person_id'));
          $person_available_points = $person_available_points + $total_points;
          PeopleModel::updatePersonAvailablePoints(Request::post('person_id'), $person_available_points);
          
        } else if ($mode == "revenue"){
          
          $total_revenue = (((date('H', $total_time) * 60) + (date('i', $total_time))) * $revenue_setting)/60;
          
          $person_revenue = PeopleModel::getPersonRevenue(Request::post('person_id'));
          $person_revenue = $person_revenue + $total_revenue;
          PeopleModel::updatePersonRevenue(Request::post('person_id'), $person_revenue);
        }     
                        
        $start = date('H:i', $start);
        $end = date('H:i', $end);

        HoursModel::createHour(Request::post('person_id'), Request::post('event_id'), $start, $end, $mode, $status, $total_time, $total_points, $total_revenue);
        
        Redirect::to('hours');
    }

    public function edit($id)
    {
        $this->View->render('hours/edit', array(
            'hour' => HoursModel::getHourByID($id)
        ));
    }

    public function editSave()
    {
        HoursModel::updateHour(Request::post('id'), Request::post('first'), Request::post('last'), Request::post('email'));
        Redirect::to('hours');
    }

    public function delete($id)
    {
        HoursModel::deleteHour($id);
        Redirect::to('hours');
    }

    public function time()
    {
        $this->View->render('hours/time', array(
            'time' => HoursModel::getAllTime()
        ));
    }
    
    public function timeByEvent($id)
    {
        $this->View->render('hours/timebyevent', array(
            'time' => HoursModel::getTimeByEvent($id)
        ));
    }
}
