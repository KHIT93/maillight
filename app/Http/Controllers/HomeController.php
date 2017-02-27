<?php

namespace MailLight\Http\Controllers;

use Illuminate\Http\Request;
use MailLight\Support\ConfigHelper;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home.index');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function lists()
    {
        return view('lists.index');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function quarantine()
    {
        return view('home.quarantine');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function tools()
    {
        return view('tools.index');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function systeminfo()
    {
        $data = [
            'php_version' => PHP_VERSION,
            'php_bin' => PHP_BINARY,
            'os' => PHP_OS,
            'mailscanner_version' => ConfigHelper::getConfVar('MailScannerVersionNumber'),
            'sa_version' => passthru(config('spamassassin.executable')." -V | tr '\\\n' ' ' | cut -d' ' -f3"),
            'geoip_age' => \Carbon\Carbon::createFromTimestamp(filemtime(storage_path('app/geoip.mmdb')))
                            ->diffForHumans(),
            'core_version' => app()::VERSION
        ];
        return view('home.systeminfo', compact('data'));
    }

}
