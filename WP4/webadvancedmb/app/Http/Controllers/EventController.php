<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use View;
use Input;
use Validator;
use Redirect;
use Session;
use Auth;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //check authentication.
        if(!Auth::check()){
            return Redirect::to('/home');
        }

        // get all the events
        $events = Event::all();

        // load the view and pass the event
        return View::make('events.index')
            ->with('events', $events);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //check authentication.
        if(!Auth::check()){
            return Redirect::to('/home');
        }

        // redirect to create blade
        return View::make('events.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //check authentication.
        if(!Auth::check()){
            return Redirect::to('/home');
        }

        // define error messages
        $messages = [
            'agent.required' => 'Please submit the Agent Name!',
            'description.required' => 'Please submit the Event Description!',
            'act.required' => 'Please submit the Act!',
            'city.required' => 'Please submit a valid City',
        ];

        // Define validators
        $rules = array(
            'agent' => 'required',
            'description'  => 'required',
            'act'     => 'required',
            'city'      => 'required'
        );
        $validator = Validator::make(Input::all(), $rules, $messages);

        // process the store
        if ($validator->fails()) {
            return Redirect::to('events/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $event = new Event;
            $event->agent = Input::get('agent');
            $event->description = Input::get('description');
            $event->act = Input::get('act');
            $event->city = Input::get('city');
            $event->starthour = Input::get('starthour');
            $event->save();

            // redirect to index page
            Session::flash('message', 'Successfully created the Event!');
            return Redirect::to('events');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //check authentication.
        if(!Auth::check()){
            return Redirect::to('/home');
        }

        // get the client
        $event = Event::find($id);

        // show the view and pass the event to it
        return View::make('events.show')
            ->with('event', $event);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //check authentication.
        if(!Auth::check()){
            return Redirect::to('/home');
        }

        // get the event
        $event = Event::find($id);

        // show the edit form and pass the event
        return View::make('events.edit')
            ->with('event', $event);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //check authentication.
        if(!Auth::check()){
            return Redirect::to('/home');
        }

        // define error messages
        $messages = [
            'agent.required' => 'Please submit the Agent Name!',
            'description.required' => 'Please submit the Event Description!',
            'act.required' => 'Please submit the Act!',
            'city.required' => 'Please submit a valid City',
        ];

        // Define validators
        $rules = array(
            'agent' => 'required',
            'description'  => 'required',
            'act'     => 'required',
            'city'      => 'required'
        );
        $validator = Validator::make(Input::all(), $rules, $messages);

        // process the store
        if ($validator->fails()) {
            return Redirect::to('events/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $event = Event::find($id);
            $event->agent = Input::get('agent');
            $event->description = Input::get('description');
            $event->act = Input::get('act');
            $event->city = Input::get('city');
            $event->starthour = Input::get('starthour');
            $event->save();

            // redirect to index page
            Session::flash('message', 'Successfully updated the Event!');
            return Redirect::to('events');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //check authentication.
        if(!Auth::check()){
            return Redirect::to('/home');
        }

        // delete
        $event = Event::find($id);
        $event->delete();

        // redirect
        Session::flash('message', 'Successfully deleted the Event!');
        return Redirect::to('events');
    }
}
