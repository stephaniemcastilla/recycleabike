<?php

class PartsController extends Controller
{
  
    public function __construct()
    {
        parent::__construct();

        // Ensure User Is Logged In
        //Auth::checkAuthentication();
    }

    public function index()
    {
        $this->View->render('parts/index', array(
            'parts' => PartsModel::getAllParts()
        ));
    }
      
    public function create()
    {        
        PartsModel::createPart(Request::post('name'), Request::post('model'), Request::post('cost'), Request::post('price'), Request::post('points'));
        Redirect::to('parts');
    }

    public function view($id)
    {
        $this->View->render('parts/view', array(
            'part' => PartsModel::getPartByID($id),
            'events' => EventModel::getEventsByPart($id)
        ));
    }

    public function edit($id)
    {
        $this->View->render('parts/edit', array(
            'part' => PartsModel::getPartByID($id)
        ));
    }

    public function update()
    {
        PartsModel::updatePart(Request::post('id'), Request::post('id'), Request::post('name'));
        Redirect::to('parts');
    }

    public function delete($id)
    {
        PartsModel::deletePart($id);
        Redirect::to('parts');
    }
}
