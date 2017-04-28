<?php

namespace MailLight\Http\Controllers;

use Illuminate\Http\Request;
use MailLight\Models\MailLogEntry;

class MessagesController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return view('messages', ['messages' => MailLogEntry::orderBy('date', 'desc')->orderBy('time', 'desc')->take(50)->get()]);
        return view('messages.index');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(MailLogEntry $message)
    {
        return view('messages.show', compact('message'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function read_mail(MailLogEntry $message)
    {
        $file = null;
        if($filename = $message->file_exists(true))
        {
            $file = file_get_contents($filename);
        }
        return view('messages.read', compact('message', 'file'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        return MailLogEntry::orderBy('date', 'desc')->orderBy('time', 'desc')->take(50)->get();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function quarantine()
    {
        return MailLogEntry::where('quarantined' ,'=', 1)->orderBy('date', 'desc')->orderBy('time', 'desc')->get();
    }

}
