<?php

namespace MailLight\Http\Controllers;

use Illuminate\Http\Request;
use MailLight\Support\ConfigHelper;

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
        return view(
            'mailscanner_config',
            [
                'config' => ConfigHelper::parseConfigFile(config('mail.mailscanner.config_dir').'MailScanner.conf')
            ]
        );
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function geoip()
    {
        // Get default service
        $service = app('geoip')->getService();
        // Ensure the selected service supports updating
        if (method_exists($service, 'update') === false) {
            return 'The current service "' . get_class($service). '" does not support updating.';
        }

        // Perform update
        if ($result = $service->update()) {
            return ['result' => $result];
        }
        else {
            return abort(400, 'Update failed');
        }

    }
}
