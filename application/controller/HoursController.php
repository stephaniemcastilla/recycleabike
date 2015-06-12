<?php

class HoursController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        // Ensure User Is Hourged In
        Auth::checkAuthentication();
    }

    public function index()
    {
        $this->View->render('hours/index', array(
            'hours' => HoursModel::getAllHours(),
            'people' => PeopleModel::getAllPeople()
        ));
    }

    public function create()
    {

        $status = "out";
        
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

        $type = Request::post('type');

        $total_points = "NULL"; 
        $total_revenue = "NULL";
        
        if ($type == "points_granted"){
          
          $total_points = $total_time * $points_setting;
           
          $person_points = PeopleModel::getPersonPoints(Request::post('person_id'));
          $person_points = $person_points + $total_points;
          PeopleModel::updatePersonPoints(Request::post('person_id'), $person_points);
          
        } else if ($type == "revenue_earned"){
          
          $total_revenue = (((date('H', $total_time) * 60) + (date('i', $total_time))) * $revenue_setting)/60;
          
          $person_revenue = PeopleModel::getPersonRevenue(Request::post('person_id'));
          $person_revenue = $person_revenue + $total_revenue;
          PeopleModel::updatePersonRevenue(Request::post('person_id'), $person_revenue);
        }     
                        
        $start = date('H:i', $start);
        $end = date('H:i', $end);

        HoursModel::createHour(Request::post('date'), Request::post('person_id'), $start, $end, $status, $total_time, $total_points, $total_revenue, Request::post('event_id'));
        
        Redirect::to('hours');
    }

    public function edit($uuid)
    {
        $this->View->render('hour/edit', array(
            'hour' => HoursModel::getHour($uuid)
        ));
    }

    public function editSave()
    {
        HoursModel::updateHour(Request::post('uuid'), Request::post('first'), Request::post('last'), Request::post('email'));
        Redirect::to('hours');
    }

    public function delete($uuid)
    {
        HoursModel::deleteHour($uuid);
        Redirect::to('hours');
    }

    public function time()
    {
        $this->View->render('hour/time', array(
            'time' => HoursModel::getAllTime()
        ));
    }
    
    public function timeByEvent($uuid)
    {
        $this->View->render('hours/timebyevent', array(
            'time' => HoursModel::getTimeByEvent($uuid)
        ));
    }
}
