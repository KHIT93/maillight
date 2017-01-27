<?php

namespace MailLight\Http\Controllers;

use Illuminate\Http\Request;

class ToolsController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tools');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function mysql_status()
    {
        return view('tools');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function mailscanner_config()
    {
        return view('tools');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function geoip()
    {
        return view('tools');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function update_geoip()
    {
        return view('tools');
    }
}
