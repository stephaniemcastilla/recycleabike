<?php

/**
 * The event controller: Just an example of simple create, read, update and delete (CRUD) actions.
 */
class EventsController extends Controller
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

    /**
     * This method controls what happens when you move to /events/index in your app.
     * Gets all events (of the user).
     */
    public function index()
    {
        $this->View->render('events/index', array(
            'events' => EventsModel::getAllEvents(),
            'programs' => ProgramsModel::getAllPrograms(), 
            'hours' => HoursModel::getAllHours()
        ));
    }
    
    /**
     * This method controls what happens when you move to /events/view in your app.
     */    
    public function view($id)
    {
        $this->View->render('events/view', array(
            'event' => EventsModel::getEventByID($id),
            'hours' => HoursModel::getHoursByEvent($id),
            'people' => PeopleModel::getAllPeople(),
            'program' => ProgramsModel::getProgramByEventID($id),
            'programs' => ProgramsModel::getAllPrograms()
        ));
    }
    
    /**
     * This method controls what happens when you move to /dashboard/create in your app.
     * Creates a new event. This is usually the target of form submit actions.
     * POST request.
     */
    public function create()
    {        
        EventsModel::createEvent(Request::post('date'), Request::post('start'), Request::post('end'), Request::post('program_id'));
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        Redirect::back();
    }

    /**
     * This method controls what happens when you move to /events/edit(/XX) in your app.
     * Shows the current content of the event and an editing form.
     * @param $id int id of the event
     */
    public function edit($id)
    {
        $this->View->render('events/edit', array(
            'event' => EventsModel::getEventByID($id),
            'programs' => ProgramsModel::getAllPrograms()
        ));
    }

    /**
     * This method controls what happens when you move to /events/editSave in your app.
     * Edits a event (performs the editing after form submit).
     * POST request.
     */
    public function update()
    {
        EventsModel::updateEvent(Request::post('id'), Request::post('date'), Request::post('start'), Request::post('end'), Request::post('program_id'));
        Redirect::back();
    }

    /**
     * This method controls what happens when you move to /events/delete(/XX) in your app.
     * Deletes a event. In a real application a deletion via GET/URL is not recommended, but for demo purposes it's
     * totally okay.
     * @param int $id id of the event
     */
    public function delete($id)
    {
        EventsModel::deleteEvent($id);
        Redirect::to('events');
    }
}
