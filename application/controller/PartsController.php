<?php

class PartsController extends Controller
{
  
    public function __construct()
    {
        parent::__construct();

        // Ensure User Is Logged In
        Auth::checkAuthentication();
    }

    public function index()
    {
        $this->View->render('parts/index', array(
            'parts' => PartsModel::getAllParts()
        ));
    }
      
    public function create()
    {        
        PartsModel::createPart(Request::post('id'), Request::post('name'));
        Redirect::to('parts');
    }

    public function view($uuid)
    {
        $this->View->render('parts/view', array(
            'part' => PartsModel::getPartByID($uuid),
            'events' => EventModel::getEventsByPart($uuid)
        ));
    }

    public function edit($uuid)
    {
        $this->View->render('parts/edit', array(
            'part' => PartsModel::getPartByID($uuid)
        ));
    }

    public function update()
    {
        PartsModel::updatePart(Request::post('uuid'), Request::post('id'), Request::post('name'));
        Redirect::to('parts');
    }

    public function delete($uuid)
    {
        PartsModel::deletePart($uuid);
        Redirect::to('parts');
    }
}
