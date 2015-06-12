<?php

class RepairsController extends Controller
{
  
    public function __construct()
    {
        parent::__construct();

        // Ensure User Is Hourged In
        Auth::checkAuthentication();
    }

    public function index()
    {
        $this->View->render('repairs/index', array(
            'repairs' => RepairsModel::getAllRepairs(),
            'bikes' => BikesModel::getAllBikes(),
            'people' => PeopleModel::getAllPeople(),
            'hours' => HoursModel::getAllHours()
        ));
    }
      
    public function create()
    {        
        RepairsModel::createRepair(Request::post('id'), Request::post('name'));
        Redirect::to('repairs');
    }

    public function view($uuid)
    {
        $this->View->render('repairs/view', array(
            'repair' => RepairsModel::getRepairByID($uuid),
            'events' => EventModel::getEventsByRepair($uuid)
        ));
    }

    public function edit($uuid)
    {
        $this->View->render('repairs/edit', array(
            'repair' => RepairsModel::getRepairByID($uuid)
        ));
    }

    public function update()
    {
        RepairsModel::updateRepair(Request::post('uuid'), Request::post('id'), Request::post('name'));
        Redirect::to('repairs');
    }

    public function delete($uuid)
    {
        RepairsModel::deleteRepair($uuid);
        Redirect::to('repairs');
    }
}
