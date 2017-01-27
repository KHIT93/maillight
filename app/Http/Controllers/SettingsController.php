<?php

namespace MailLight\Http\Controllers;

use Illuminate\Http\Request;
use MailLight\Models\Setting;

class SettingsController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('settings');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function all()
    {
    	$results = [];
    	foreach (Setting::all() as $option) {
    		$results[$option->name] = $option;
    	}
        return $results;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	return Setting::create($request->all());
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
    	return Setting::update($request->all());
    }

}
