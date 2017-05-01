<?php

namespace MailLight\Http\Controllers;

use Illuminate\Http\Request;
use MailLight\Models\MailLogEntry;

class SpamAssassinController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, MailLogEntry $message)
    {
        return $message;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function release(Request $request, MailLogEntry $message)
    {
        //Determine if the email was already released or deleted
        if($message->is_released)
        {
            return response('The message has already been released.', 204);
        }
        if(!$message->file_exists())
        {
            return response('The message no longer exists on filesystem. Please make sure that it has not already been released or deleted', 204);
        }
        //Call release method on model to trigger the release
        if($message->release() === false)
        {
            return response('The message could not be released. Please see the application error logs for details or contact the system administrator', 500);
        }
        //Log notification to audit log

        //Return a response
        return response('The message has been succesfully released', 200);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, MailLogEntry $message)
    {
        //Determine if the email was already released or deleted
        if($message->is_released)
        {
            return response('The message has already been released.', 204);
        }
        if(!$message->file_exists())
        {
            return response('The message no longer exists on filesystem. Please make sure that it has not already been released or deleted', 204);
        }
        //Delete the message from the database and the filesystem
        $message->delete();
        //Return a response
        return response('The message has been successfully deleted', 200);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function learn(Request $request, MailLogEntry $message)
    {
		$sa_learn_output = [];
		$sa_learn_status = null;
        $sa_output = [];
        $sa_status = null;//Determine if the email was already released or deleted
        if($message->is_released)
        {
            return response('The message has already been released.', 204);
        }
        if(!$message->file_exists())
        {
            return response('The message no longer exists on filesystem. Please make sure that it has not already been released or deleted', 204);
        }

        //Examine the request data to find out how we should pass
        //the message to the sa-learn binary
        switch(request('learn_type'))
		{
			case 'ham':
				//Learn the message as not being harmful
				exec('sa-learn --ham --file '.$message->file_exists(true).' 2>&1', $sa_learn_output, $sa_learn_status);
                $message->is_fp = 1;
			break;
			case 'spam':
				//Learn the message as spam
				exec('sa-learn --spam --file '.$message->file_exists(true).' 2>&1', $sa_learn_output, $sa_learn_status);
                $message->is_fn = 1;
			break;
			case 'report':
				//Learn the message as spam and report it
				exec('sa-learn --spam --file '.$message->file_exists(true).' 2>&1', $sa_learn_output, $sa_learn_status);
                exec(config('mail.spamassassin.executable').'spamassassin -p '.config('mail.mailscanner.config_dir').config('mail.spamassassin.preferences').' -r '.$message->file_exists(true).' 2>&1', $sa_output, $sa_status);
                $message->is_fn = 1;
            break;
			case 'revoke':
				//Learn the message as clean and release it
				exec('sa-learn --ham --file '.$message->file_exists(true).' 2>&1', $sa_learn_output, $sa_learn_status);
                exec(config('mail.spamassassin.executable').'spamassassin -p '.config('mail.mailscanner.config_dir').config('mail.spamassassin.preferences').' -k '.$message->file_exists(true).' 2>&1', $sa_output, $sa_status);
                $message->is_fp = 1;
            break;
		}

        if($sa_learn_status != 0)
        {
            return response('Process failed with status code '.$sa_learn_status.' and the following message: '.implode('<br>', $sa_learn_output), 500);
        }

        if($sa_status != 0)
        {
            return response('Process failed with status code '.$sa_status.' and the following message: '.implode('<br>', $sa_output), 500);
        }

        $message->save();
        //Return a response
        return response('The message was successfully learned', 200);
    }
}
