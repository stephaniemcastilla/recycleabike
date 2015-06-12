<?php

class ProgramsController extends Controller
{
  
    public function __construct()
    {
        parent::__construct();

        // Ensure User Is Logged In
        Auth::checkAuthentication();
    }

    public function index()
    {
        $this->View->render('programs/index', array(
            'programs' => ProgramsModel::getAllPrograms()
        ));
    }
      
    public function create()
    {        
        ProgramsModel::createProgram(Request::post('id'), Request::post('name'));
        Redirect::to('programs');
    }

    public function view($uuid)
    {
        $this->View->render('programs/view', array(
            'program' => ProgramsModel::getProgramByID($uuid),
            'events' => EventsModel::getEventsByProgram($uuid)
        ));
    }

    public function edit($uuid)
    {
        $this->View->render('programs/edit', array(
            'program' => ProgramsModel::getProgramByID($uuid)
        ));
    }

    public function update()
    {
        ProgramsModel::updateProgram(Request::post('uuid'), Request::post('id'), Request::post('name'));
        Redirect::to('programs');
    }

    public function delete($uuid)
    {
        ProgramsModel::deleteProgram($uuid);
        Redirect::to('programs');
    }
}
