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

        // VERY IMPORTANT: All controllers/areas that should only be usable by hourged-in users
        // need this line! Otherwise not-hourged in users could do actions. If all of your pages should only
        // be usable by hourged-in users: Put this line into libs/Controller->__construct
        Auth::checkAuthentication();
    }

    /**
     * This method controls what happens when you move to /events/index in your app.
     * Gets all events (of the user).
     */
    public function index()
    {
        $this->View->render('events/index', array(
            'events' => EventsModel::getAllEvents(),
            'programs' => ProgramsModel::getAllPrograms()
        ));
    }
    
    /**
     * This method controls what happens when you move to /events/view in your app.
     */    
    public function view($uuid)
    {
        $this->View->render('events/view', array(
            'event' => EventsModel::getEventByID($uuid),
            'hours' => HoursModel::getHoursByEvent($uuid),
            'people' => PeopleModel::getAllPeople(),
            'program' => ProgramsModel::getProgramByEventID($uuid)
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
        Redirect::to('events');
    }

    /**
     * This method controls what happens when you move to /events/edit(/XX) in your app.
     * Shows the current content of the event and an editing form.
     * @param $uuid int id of the event
     */
    public function edit($uuid)
    {
        $this->View->render('events/edit', array(
            'event' => EventsModel::getEventByID($uuid),
            'programs' => ProgramsModel::getAllPrograms()
        ));
    }

    /**
     * This method controls what happens when you move to /events/editSave in your app.
     * Edits a event (performs the editing after form submit).
     * POST request.
     */
    public function editSave()
    {
        EventsModel::updateEvent(Request::post('uuid'), Request::post('id'), Request::post('name'));
        Redirect::to('event');
    }

    /**
     * This method controls what happens when you move to /events/delete(/XX) in your app.
     * Deletes a event. In a real application a deletion via GET/URL is not recommended, but for demo purposes it's
     * totally okay.
     * @param int $uuid id of the event
     */
    public function delete($uuid)
    {
        EventsModel::deleteEvent($uuid);
        Redirect::to('events');
    }
}
