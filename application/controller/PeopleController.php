<?php

class PeopleController extends Controller
{

    public function __construct()
    {
        parent::__construct();

        // Ensure User Is Logged In
        Auth::checkAuthentication();
    }

    public function index()
    {
        $this->View->render('people/index', array(
            'type' => 'people',
            'people' => PeopleModel::getAllPeople()
        ));
    }
    
    public function type($type)
    {
        $this->View->render('people/index', array(
            'type' => $type,
            'people' => PeopleModel::getPeopleByType($type)
        ));
    }

    public function create()
    {
        PeopleModel::createPerson(Request::post('first'), Request::post('last'), Request::post('email'));
        Redirect::to('people');
    }

    public function view($uuid)
    {
        $this->View->render('people/view', array(
            'person' => PeopleModel::getPersonByID($uuid),
            'hours' => HoursModel::getHoursByPerson($uuid)
        ));
    }
    
    public function edit($uuid)
    {
        $this->View->render('people/edit', array(
            'person' => PeopleModel::getPersonByID($uuid)
        ));
    }

    public function update()
    {
        PeopleModel::updatePerson(Request::post('uuid'), Request::post('first'), Request::post('last'), Request::post('email'));
        Redirect::to('people');
    }

    public function delete($uuid)
    {
        HoursModel::deleteHoursByPerson($uuid);        
        PeopleModel::deletePerson($uuid);
        Redirect::to('people');
    }
    
    public function getVolunteersByLastName()
    {
        $keyword = '%'.$_POST['keyword'].'%';
        $event = $_POST['event'];
        
        $volunteers = PeopleModel::getVolunteersByLastName($keyword, $event);
        
        foreach ($volunteers as $volunteer) {
          echo "<li style='list-style: none; text-align: left;'>".$volunteer->firstname." ".$volunteer->lastname."<a href='" . URL . "timehours/sign_in?event=" . $event . "&contact=" . $volunteer->id . "' class='btn btn-primary' style='float: right; margin-top: 15px;'>SIGN IN</a></li>";
        }

        echo "<a href='";
        echo URL;
        echo "timehours/register?event=".$event."'><div class='btn btn-success' style='margin: 20px 0px; font-size: 25px;'>Don't see your name? <b>REGISTER NOW > </b></div></a>";
    }

    public function customers()
    {
        $this->View->render('people/customers', array(
            'customers' => PeopleModel::getAllCustomers()
        ));
    }
}


