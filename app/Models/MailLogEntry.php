<?php

namespace MailLight\Models;

use Illuminate\Database\Eloquent\Model;

class MailLogEntry extends Model
{
	use UuidForKey;
    protected $table = 'maillog';
    protected $primaryKey = 'uuid';
    protected $guarded = ['uuid'];
    public $incrementing = false;

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
        if($this->isspam || $this->ishighspam)
        {
            $status_arr[] = 'Spam';
        }
        if($this->ismcp || $this->ishighmcp)
        {
            $status_arr[] = 'MCP';
        }
        if($this->virusinfected)
        {
            $status_arr[] = 'Virus';
        }
        if($this->nameinfected)
        {
            $status_arr[] = 'Bad Content';
        }
        if($this->otherinfected)
        {
            $status_arr[] = 'Infected';
        }
        if($this->spamwhitelisted)
        {
            $status_arr[] = 'W/L';
        }
        if($this->spamblacklisted)
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
            if($this->ishighspam)
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
            if($this->ishighmcp)
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
        if($this->virusinfected)
        {
            $classes[] = 'infected';
            $classes[] = 'is-danger';
        }
        if($this->nameinfected)
        {
            $classes[] = 'infected';
            $classes[] = 'is-warning';
        }
        if($this->otherinfected)
        {
            $classes[] = 'infected';
            $classes[] = 'is-danger';
        }
        if($this->spamwhitelisted)
        {
            $classes[] = 'whitelisted';
            $classes[] = 'is-primary';
        }
        if($this->spamblacklisted)
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
        if (preg_match('/\s\((.+?)\)/i', $this->spamreport, $sa_rules)) {
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
        
        foreach (array('cached', 'score=', 'required', 'autolearn=') as $val) {
            if (preg_match("/$val/", $sa_rules[0])) {
                array_shift($sa_rules);
            }
        }
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
}
