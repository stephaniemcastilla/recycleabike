<?php

/**
 * This controller shows an area that's only visible for logged in users (because of Auth::checkAuthentication(); in line 16)
 */
class TimeclockController extends Controller
{
    /**
     * Construct this object by extending the basic Controller class
     */
    public function __construct()
    {
        parent::__construct();

        // this entire controller should only be visible/usable by logged in users, so we put authentication-check here
        Auth::checkAuthentication();
    }

    public function index()
    {
        $this->View->renderWithoutHeaderAndFooter('timeclock/index', array(
            'events' => EventsModel::getTodaysEvents(),
            'programs' => ProgramsModel::getAllPrograms()
        ));
    }
    
    public function event($event_id)
    {
        $this->View->renderWithoutHeaderAndFooter('timeclock/event', array(
            'event' => EventsModel::getEventByID($event_id),
            'program' => ProgramsModel::getProgramByEventID($event_id)
        ));
    }
    
    public function newEvent()
    {
        $this->View->renderWithoutHeaderAndFooter('timeclock/newevent', array(
            'programs' => ProgramsModel::getAllPrograms()
        ));
    }
    
    public function eventCreate()
    {        
        EventsModel::createEvent(Request::post('date'), Request::post('start'), Request::post('end'), Request::post('program_id'));
        Redirect::to('events');
    }
    
    public function register()
    {
        $this->View->renderWithoutHeaderAndFooter('timeclock/register');
    }
    
    public function signIn($event_id)
    {
        $this->View->renderWithoutHeaderAndFooter('timeclock/signin', array(
            'people' => PeopleModel::getPeopleByEventNotSignedIn($event_id),
            'volunteers' => PeopleModel::getVolunteersExcludedByEvent($event_id),
            'customers' => PeopleModel::getCustomersExcludedByEvent($event_id),
            'event' => $event_id
        ));
    }
    
    public function signInConfirm()
    {        
        $person_id = Request::post('person_id');
        $event_id = Request::post('event_id');
        $date = date("Y-m-d");
        $start = date("H:i:s"); 
        $end = "00:00:00";
        $status = "in";
        $total_time = 0;
        $total_points = 0;
        $total_revenue = 0;
        
        HoursModel::createHour($date, $person_id, $start, $end, $status, $total_time, $total_points, $total_revenue, $event_id);
        
        $this->View->renderWithoutHeaderAndFooter('timeclock/signinconfirm', array(
          'person' => PeopleModel::getPersonByID($person_id),
          'event' => EventsModel::getEventByID($event_id),
          'program' => ProgramsModel::getProgramByEventID($event_id)
        ));
    }
    
    public function signOut($event_id)
    {
        $this->View->renderWithoutHeaderAndFooter('timeclock/signout', array(
            'people' => PeopleModel::getPeopleByEventSignedIn($event_id),
            'hours' => HoursModel::getHoursByEvent($event_id),
            'event' => $event_id
        ));
    }
    
    public function signOutConfirm()
    {        
      
        $points_setting = SettingModel::getSettingValue(1);
        $revenue_setting = SettingModel::getSettingValue(2);
        
        $hour_uuid = Request::post('hour_id');
        $person_uuid = Request::post('person_id');
        $event_uuid = Request::post('event_id');
        $status = "out";
        
        $start = Request::post('hour_start');
        $end = date("H:i:s");
        
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
                
        HoursModel::signOutHour($hour_uuid, $end, $status,$total_time, $total_points, $total_revenue);
        
        $this->View->renderWithoutHeaderAndFooter('timeclock/signoutconfirm', array(
          'person' => PeopleModel::getPersonByID($person_uuid),
          'event' => EventsModel::getEventByID($event_uuid),
          'hour' => HoursModel::getHourByID($hour_uuid)
        ));
    }
    
    public function signOutFinalize()
    {        
        $person_id = Request::post('person_id');
        $event_id = Request::post('event_id');
        
        HoursModel::signOutHour($uuid, $end);
        
        $this->View->renderWithoutHeaderAndFooter('timeclock/signoutconfirm', array(
          'person' => PeopleModel::getPersonByID($person_id),
          'event' => EventsModel::getEventByID($event_id)
        ));
    }
    
    public function status()
    {
        $this->View->renderWithoutHeaderAndFooter('timeclock/status');
    }
    public function purchase()
    {
        $this->View->renderWithoutHeaderAndFooter('timeclock/purchase');
    }
}
