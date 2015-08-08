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
            'people' => PeopleModel::getPeopleByType($type), 
            'points' => PeopleModel::getAllTotalPoints(),
            'time' => PeopleModel::getAllTotalTime()
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
    
    public function getPeopleByLast()
    {
        $last = $_POST['keyword'].'%';
        $event = $_POST['event'];

        $people = PeopleModel::PeopleSignIn($event, $last);

        foreach ($people as $person) {
          echo '<tr>';
          echo '<td>' . htmlentities($person->first) . ' ' . htmlentities($person->last) . '</td>';
          echo '<td style="text-align: right;">';
          echo '<a class="btn default" data-toggle="modal" href="#volunteer" onClick="signInVolunteer(' . htmlentities($person->id) .');">Volunteer</a> 
                <a class="btn btn-primary" data-toggle="modal" href="#useshop" onClick="signInCustomer(' . htmlentities($person->id) .');">Use Shop</a> ';
          echo '</td>';
          echo '</tr>';
        }

    }
    
}


