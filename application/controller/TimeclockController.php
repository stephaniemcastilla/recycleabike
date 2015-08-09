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

        // Ensure User Is Logged In
        //Auth::checkAuthentication();
    }

    public function index()
    {
        $this->View->renderFullscreen('timeclock/index', array(
            'events' => EventsModel::getTodaysEvents(),
            'programs' => ProgramsModel::getAllPrograms()
        ));
    }
    
    public function event($id)
    {
        $this->View->renderFullscreen('timeclock/event', array(
            'event' => EventsModel::getEventByID($id),
            'program' => ProgramsModel::getProgramByEventID($id)
        ));
    }
    
    public function newEvent()
    {
        $this->View->renderFullscreen('timeclock/newevent', array(
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
        $this->View->renderFullscreen('timeclock/register');
    }
    
    public function signInReason($id)
    {
        $this->View->renderFullscreen('timeclock/signin_reason', array(
            'people' => PeopleModel::getPeopleByEventNotSignedIn($id),
            'volunteers' => PeopleModel::getVolunteersExcludedByEvent($id),
            'customers' => PeopleModel::getCustomersExcludedByEvent($id),
            'event' => $id
        ));
    }
    
    public function signIn($id)
    {
        $this->View->renderFullscreen('timeclock/signin', array(
            'people' => PeopleModel::getPeopleByEventNotSignedIn($id),
            'event' => $id
        ));
    }
    
    public function signInConfirm()
    {        
        $person_id = Request::post('person_id');
        $event_id = Request::post('event_id');
        $mode = Request::post('mode');
        $start = date("Y-m-d H:i:s"); 
        $status = "in";
        $total_time = 0;
        $total_points = 0;
        $total_revenue = 0;
        
        HoursModel::signIn(Request::post('person_id'), Request::post('event_id'), $start, $mode, $status, $total_time, $total_points, $total_revenue);
        
        $this->View->renderFullscreen('timeclock/signinconfirm', array(
          'person' => PeopleModel::getPersonByID($person_id),
          'person_points' => PeopleModel::getPersonTotalPoints($person_id),
          'event' => EventsModel::getEventByID($event_id),
          'program' => ProgramsModel::getProgramByEventID($event_id)
        ));
    }
    
    public function signOut($id)
    {
        $this->View->renderFullscreen('timeclock/signout', array(
            'people' => PeopleModel::getPeopleByEventSignedIn($id),
            'hours' => HoursModel::getHoursByEvent($id),
            'event' => $id
        ));
    }
    
    public function signOutConfirm()
    {        
      
        $points_setting = SettingModel::getSettingValue(1);
        $revenue_setting = SettingModel::getSettingValue(2);
        
        $hour_id = Request::post('hour_id');
        $person_id = Request::post('person_id');
        $event_id = Request::post('event_id');
        $status = "out";
        
        $start = Request::post('hour_start');
        $end = date("Y-m-d H:i:s");
        
        $start = strtotime($start);
        $end = strtotime($end);
        $total_time = $end - $start;
        $total_time = $total_time/60/60;
        
        $mode = Request::post('hour_mode');

        $total_points = "NULL"; 
        $total_revenue = "NULL";
        
        if ($mode == "points"){
          
          $total_points = $total_time * $points_setting;
          
        } else if ($mode == "revenue"){
          
          $total_revenue = ($total_time * $revenue_setting);
        }     
                                
        $end = date('Y-m-d H:i:s', $end);
                
        HoursModel::signOutHour($hour_id, $end, $status, $total_time, $total_points, $total_revenue);
        
        $this->View->renderFullscreen('timeclock/signoutconfirm', array(
          'person' => PeopleModel::getPersonByID($person_id),
          'person_points' => PeopleModel::getPersonTotalPoints($person_id),
          'event' => EventsModel::getEventByID($event_id),
          'hour' => HoursModel::getHourByID($hour_id)
        ));
    }
    
    public function signOutFinalize()
    {        
        $person_id = Request::post('person_id');
        $id = Request::post('id');
        
        HoursModel::signOutHour($id, $end);
        
        $this->View->renderFullscreen('timeclock/signoutconfirm', array(
          'person' => PeopleModel::getPersonByID($person_id),
          'event' => EventsModel::getEventByID($id)
        ));
    }
    
    public function view($id)
    {
        $this->View->renderFullscreen('timeclock/view', array(
            'hours' => HoursModel::getHoursByEvent($id),
            'people' => PeopleModel::getAllPeople(),
            'event' => $id
        ));
    }
    
    public function newguest($id)
    {
        $this->View->renderFullscreen('timeclock/newguest', array(
          'event' => $id
        ));
    }
    
    public function contact($id)
    {
        $this->View->renderFullscreen('timeclock/contact', array(
          'event' => $id
        ));
    }
    
    public function purchase()
    {
        $this->View->renderFullscreen('timeclock/purchase');
    }
    
    public function newsletter($id)
    {
        $this->View->renderFullscreen('timeclock/newsletter', array(
          'event' => $id
        ));
    }
    
}
