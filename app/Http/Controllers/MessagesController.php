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
        return view('messages');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(MailLogEntry $message)
    {
        return view('message_detail', compact('message'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function read_mail(MailLogEntry $message)
    {
        $quarantine_dir = \MailLight\Support\ConfigHelper::getConfVar('QuarantineDir');
        $date = $message->date->format('Ymd');
        $filename = '';
        switch(true)
        {
            case (file_exists($quarantine_dir.'/'.$date.'/nonspam/'.$message->mailwatch_id)):
                $filename = $date.'/nonspam/'.$message->mailwatch_id;
                break;
            case (file_exists($quarantine_dir.'/'.$date.'/spam/'.$message->mailwatch_id)):
                $filename = $date.'/spam/'.$message->mailwatch_id;
                break;
            case (file_exists($quarantine_dir.'/'.$date.'/mcp/'.$message->mailwatch_id)):
                $filename = $date.'/mcp/'.$message->mailwatch_id;
                break;
            case (file_exists($quarantine_dir.'/'.$date.'/'.$message->mailwatch_id.'/message')):
                $filename = $date.'/'.$message->mailwatch_id.'/message';
                break;
        }
        $file = file_get_contents($quarantine_dir.'/'.$filename);
        return view('message_detail_display', compact('message', 'file'));
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
