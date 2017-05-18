<?php

namespace MailLight\Models;

use Illuminate\Database\Eloquent\Model;
use MailLight\Models\Traits\UuidForKey;

class MailLogEntry extends Model
{
	use UuidForKey;
    protected $table = 'maillog';
    protected $primaryKey = 'uuid';
    protected $guarded = ['uuid'];
	protected $appends = array('selected');
    public $incrementing = false;
	public $selected = false;

	protected $dates = [
		'date'
	];

    public $status_text = null;
    public $status_style = null;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public function status()
    {
        $status_arr = [];
        if($this->is_spam || $this->is_highspam)
        {
            $status_arr[] = 'Spam';
        }
        if($this->is_mcp || $this->is_highmcp)
        {
            $status_arr[] = 'MCP';
        }
        if($this->virus_infected)
        {
            $status_arr[] = 'Virus';
        }
        if($this->name_infected)
        {
            $status_arr[] = 'Bad Content';
        }
        if($this->other_infected)
        {
            $status_arr[] = 'Infected';
        }
        if($this->spam_whitelisted)
        {
            $status_arr[] = 'W/L';
        }
        if($this->spam_blacklisted)
        {
            $status_arr[] = 'B/L';
        }
        $result = (count($status_arr)) ? $status_arr : ['Clean'];
        return $result;
    }

    public function get_status_classes()
    {
        $classes = [];
        $status_arr = $this->status();

        if(in_array('Spam', $status_arr))
        {
            if($this->is_highspam)
            {
                $classes[] = 'highspam';
                $classes[] = 'is-danger';
            }
            else
            {
                $classes[] = 'spam';
                $classes[] = 'is-warning';
            }
        }
        if(in_array('MCP', $status_arr))
        {
            if($this->is_highmcp)
            {
                $classes[] = 'highmcp';
                $classes[] = 'is-danger';
            }
            else
            {
                $classes[] = 'mcp';
                $classes[] = 'is-warning';
            }
        }
        if($this->virus_infected)
        {
            $classes[] = 'infected';
            $classes[] = 'is-danger';
        }
        if($this->name_infected)
        {
            $classes[] = 'infected';
            $classes[] = 'is-warning';
        }
        if($this->other_infected)
        {
            $classes[] = 'infected';
            $classes[] = 'is-danger';
        }
        if($this->spam_whitelisted)
        {
            $classes[] = 'whitelisted';
            $classes[] = 'is-primary';
        }
        if($this->spam_blacklisted)
        {
            $classes[] = 'blacklisted';
            $classes[] = 'is-dark';
        }
        $result = implode(' ', $classes);
        return $result;
    }

    public function spamreport_formatted()
    {
        $report = [];
        if (preg_match('/\s\((.+?)\)/i', $this->spam_report, $sa_rules)) {
            // Get rid of the first match from the array
            array_shift($sa_rules);
            // Split the array
            $sa_rules = explode(", ", $sa_rules[0]);
            // Check to make sure a check was actually run
            if ($sa_rules[0] == "Message larger than max testing size" || $sa_rules[0] == "timed out") {
                return $sa_rules[0];
            }
            // Get rid of the 'score=', 'required' and 'autolearn=' lines
            foreach (array('cached', 'score=', 'required', 'autolearn=') as $val) {
                if (preg_match("/$val/", $sa_rules[0])) {
                    array_shift($sa_rules);
                }
            }
            while (list($key, $val) = each($sa_rules)) {
                array_push($report, $this->get_sa_rule_desc($val));
            }
        }

        /*foreach (array('cached', 'score=', 'required', 'autolearn=') as $val) {
            if (preg_match("/$val/", $sa_rules[0])) {
                array_shift($sa_rules);
            }
        }*/
        return view('partials.spamreport', compact('report'));
    }

    protected function get_sa_rule_desc($rule)
    {
        // Check if SA scoring is enabled
        if (preg_match('/^(.+) (.+)$/', $rule, $regs)) {
            $rule = $regs[1];
            $rule_score = $regs[2];
        } else {
            $rule_score = "";
        }
        return ['key' => $rule, 'value' => $rule_score];
    }

	public function geodata()
	{
		return geoip()->getLocation($this->clientip);
	}

	public function sender_hostname()
	{
		return \Cache::remember('sender_hostname'.$this->clientip, 10080, function() {
			return gethostbyaddr($this->clientip);
		});
	}

	public function file_exists($return_filepath = false)
	{
		$quarantine_dir = \MailLight\Support\ConfigHelper::getConfVar('QuarantineDir');
        $date = $this->date->format('Ymd');
        $filename = '';
        switch(true)
        {
            case (file_exists($quarantine_dir.'/'.$date.'/nonspam/'.$this->mailwatch_id)):
                $filename = $date.'/nonspam/'.$this->mailwatch_id;
                break;
            case (file_exists($quarantine_dir.'/'.$date.'/spam/'.$this->mailwatch_id)):
                $filename = $date.'/spam/'.$this->mailwatch_id;
                break;
            case (file_exists($quarantine_dir.'/'.$date.'/mcp/'.$this->mailwatch_id)):
                $filename = $date.'/mcp/'.$this->mailwatch_id;
                break;
            case (file_exists($quarantine_dir.'/'.$date.'/'.$this->mailwatch_id.'/message')):
                $filename = $date.'/'.$this->mailwatch_id.'/message';
                break;
        }
        return ($filename == '') ? false: (($return_filepath) ? $quarantine_dir.'/'.$filename : true);
	}

	public function release()
	{
		//If the message does not exist in the filesystem, return false
		if(!$this->file_exists())
		{
			return false;
		}

		//Otherwise, release it

		//Update the model to indicate that it has been released
		$this->is_released = true;
		$this->save();

		return $this;

	}

	public function getSelectedAttribute()
    {
        return $this->selected;
    }
}
