<?php

class ProgramsController extends Controller
{
  
    public function __construct()
    {
        parent::__construct();

        // Ensure User Is Logged In
        //Auth::checkAuthentication();
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

    public function view($id)
    {
        $this->View->render('programs/view', array(
            'program' => ProgramsModel::getProgramByID($id),
            'events' => EventsModel::getEventsByProgram($id)
        ));
    }

    public function edit($id)
    {
        $this->View->render('programs/edit', array(
            'program' => ProgramsModel::getProgramByID($id)
        ));
    }

    public function update()
    {
        ProgramsModel::updateProgram(Request::post('id'), Request::post('id'), Request::post('name'));
        Redirect::to('programs');
    }

    public function delete($id)
    {
        ProgramsModel::deleteProgram($id);
        Redirect::to('programs');
    }
}
