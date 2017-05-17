<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use View;
use Input;
use Validator;
use Redirect;
use Session;
use Auth;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //check authentication. 
        if(!Auth::check()){
            return Redirect::to('/home');
        }
        
        // get all the clients
        $clients = Client::all();

        // load the view and pass the client
        return View::make('clients.index')
            ->with('clients', $clients);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //check authentication.
        if(!Auth::check()){
            return Redirect::to('/home');
        }

        // redirect to create blade
        return View::make('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //check authentication.
        if(!Auth::check()){
            return Redirect::to('/home');
        }

        // define error messages
        $messages = [
            'firstname.required' => 'Please submit the First Name!',
            'lastname.required' => 'Please submit the Last Name',
            'email.required' => 'Please submit the E-mail address!',
            'email.email' => 'Please submit a valid E-mail address!',
            'phone.required' => 'Please submit a valid telephone number!',
            'city.required' => 'Please submit a valid City',
        ];

        // Define validators
        $rules = array(
            'firstname' => 'required',
            'lastname'  => 'required',
            'email'     => 'required|email',
            'phone'     => 'required',
            'city'      => 'required'
        );
        $validator = Validator::make(Input::all(), $rules, $messages);

        // process the store
        if ($validator->fails()) {
            return Redirect::to('clients/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $client = new Client;
            $client->firstname = Input::get('firstname');
            $client->lastname = Input::get('lastname');
            $client->email = Input::get('email');
            $client->phone = Input::get('phone');
            $client->city = Input::get('city');
            $client->company = Input::get('company');
            $client->save();

            // redirect to index page
            Session::flash('message', 'Successfully created the Client!');
            return Redirect::to('clients');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //check authentication.
        if(!Auth::check()){
            return Redirect::to('/home');
        }

        // get the client
        $client = Client::find($id);

        // show the view and pass the clientto it
        return View::make('clients.show')
            ->with('client', $client);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //check authentication.
        if(!Auth::check()){
            return Redirect::to('/home');
        }

        // get the nclient
        $client = Client::find($id);

        // show the edit form and pass the client
        return View::make('clients.edit')
            ->with('client', $client);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //check authentication.
        if(!Auth::check()){
            return Redirect::to('/home');
        }

        // define error messages
        $messages = [
            'firstname.required' => 'Please submit the First Name!',
            'lastname.required' => 'Please submit the Last Name',
            'email.required' => 'Please submit the E-mail address!',
            'email.email' => 'Please submit a valid E-mail address!',
            'phone.required' => 'Please submit a valid telephone number!',
            'city.required' => 'Please submit a valid City',
        ];

        // define the validators
        $rules = array(
            'firstname' => 'required',
            'lastname'  => 'required',
            'email'     => 'required|email',
            'phone'     => 'required',
            'city'      => 'required'
        );
        $validator = Validator::make(Input::all(), $rules, $messages);

        // process the edit
        if ($validator->fails()) {
            return Redirect::to('clients/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $client = Client::find($id);
            $client->firstname = Input::get('firstname');
            $client->lastname = Input::get('lastname');
            $client->email = Input::get('email');
            $client->phone = Input::get('phone');
            $client->city = Input::get('city');
            $client->company = Input::get('company');
            $client->save();

            // redirect
            Session::flash('message', 'Successfully updated the Client!');
            return Redirect::to('clients');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //check authentication.
        if(!Auth::check()){
            return Redirect::to('/home');
        }

        // delete
        $client = Client::find($id);
        $client->delete();

        // redirect
        Session::flash('message', 'Successfully deleted the Client!');
        return Redirect::to('clients');
    }
}
