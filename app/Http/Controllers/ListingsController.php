<?php

namespace MailLight\Http\Controllers;

use Illuminate\Http\Request;
use MailLight\Models\BlacklistEntry;
use MailLight\Models\WhitelistEntry;

class ListingsController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('lists', ['whitelist' => WhitelistEntry::orderBy('mailwatch_id', 'desc')->take(50)->get(), 'blacklist' => BlacklistEntry::orderBy('mailwatch_id', 'desc')->take(50)->get()]);
    }

}
