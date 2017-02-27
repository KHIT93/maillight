<?php

namespace MailLight\Http\Controllers;

use Illuminate\Http\Request;
use MailLight\Models\MailLogEntry;

class ReportsController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('reports.index');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function get_filtered_data($return_raw_data = false, $paginated = true)
    {
    	$data = null;
    	$new = null;
    	$old = null;
    	$count = null;
        $results = null;
    	$filters = session('reports_filter_domain', []);
        if($paginated === false){ \Log::info('paginated is not set'); }
    	if(count($filters))
    	{
    		\Log::info('There are active filters');
    		foreach ($filters as $filter) {
    			\Log::info('Filtering data '.$filter['field'].' '.$filter['operator'].' '.$filter['value']);
	    		if(is_null($data))
	    		{
	    			$data = MailLogEntry::where($filter['field'], $filter['operator'], $filter['value']);
	    		}
	    		else
	    		{
	    			$data->where($filter['field'], $filter['operator'], $filter['value']);
	    		}
	    	}
	    	\Log::info('Filtering complete. Query to run: '.$data->toSql());
	    	//$results = $data->orderBy('date', 'desc')->orderBy('time', 'desc');
            if($paginated)
            {
                \Log::info('Filtered results will be paginated '.$paginated);
                $results = $data->orderBy('date', 'desc')->orderBy('time', 'desc')->paginate(50);
            }
            else
            {
                \Log::info('Filtered results will not be paginated '.$paginated);
                $results = $data->orderBy('date', 'asc')->orderBy('time', 'asc')->get();
            }
	    	$new = $data->orderBy('date', 'desc')->first()->date;
	    	$old = $data->orderBy('date', 'asc')->first()->date;
	    	$count = ($paginated) ? $results->total() : $results->count();
    	}
    	else
    	{
    		$new = MailLogEntry::orderBy('date', 'desc')->orderBy('time', 'desc')->first()->date;
    		$old = MailLogEntry::orderBy('date', 'asc')->orderBy('time', 'asc')->first()->date;
    		$count = MailLogEntry::count();
            if($paginated)
            {
                \Log::info('Results will be paginated '.$paginated);
                $results = MailLogEntry::orderBy('date', 'desc')->orderBy('time', 'desc')->paginate(50);
            }
            else
            {
                \Log::info('Results will not be paginated '.$paginated);
                $results = MailLogEntry::orderBy('date', 'asc')->orderBy('time', 'asc')->get();
            }
    	}
        return ($return_raw_data) ? ['old' => $old, 'new' => $new, 'count' => $count, 'data' => $results]: ['old' => $old, 'new' => $new, 'count' => $count];
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function apply_filter(Request $request)
    {
    	$new_filter = $request->get('reports_filter_domain');
    	$filters = session('reports_filter_domain', []);
    	$filters[$new_filter['field']] = $new_filter;
    	session()->put('reports_filter_domain', $filters);
    	$data = session('reports_filter_domain');
    	return $data;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function get_filter_options()
    {
    	$filters = [
    		'date' => "Date",
			'headers' => "Headers",
			'mailwatch_id' => "Message ID",
			'size' => "Size (bytes)",
			'from_address' => "From",
			'from_domain' => "From Domain",
			'to_address' => "To",
			'to_domain' => "To Domain",
			'subject' => "Subject",
			'clientip' => "Received from (IP Address)",
			'isspam' => "is Spam (&gt;0 = TRUE)",
			'ishighspam' => "is High Scoring Spam (&gt;0 = TRUE)",
			'issaspam' => "is Spam according to SpamAssassin (&gt;0 = TRUE)",
			'isrblspam' => "is Listed in one or more RBL's (&gt;0 = TRUE)",
			'spamwhitelisted' => "is Whitelisted (&gt;0 = TRUE)",
			'spamblacklisted' => "is Blacklisted (&gt;0 = TRUE)",
			'sascore' => "SpamAssassin Score",
			'spamreport' => "Spam Report",
			'ismcp' => "is MCP (&gt;0 = TRUE)",
			'ishighmcp' => "is High Scoring MCP (&gt;0 = TRUE)",
			'issamcp' => "is MCP according to SpamAssassin (&gt;0 = TRUE)",
			'mcpwhitelisted' => "is MCP Whitelisted (&gt;0 = TRUE)",
			'mcpblacklisted' => "is MCP Blacklisted (&gt;0 = TRUE)",
			'mcpscore' => "MCP Score",
			'mcpreport' => "MCP Report",
			'virusinfected' => "contained a Virus (&gt;0 = TRUE)",
			'nameinfected' => "contained an Unacceptable Attachment (&gt;0 = TRUE)",
			'otherinfected' => "contained other infections (&gt;0 = TRUE)",
			'report' => "Virus Report",
			'hostname' => "MailScanner Hostname",
    	];
    	$active_filters = session('reports_filter_domain', []);
    	foreach ($active_filters as $key => $filter) {
    		if(array_key_exists($key, $filters))
    		{
    			unset($filters[$key]);
    		}
    	}
    	return ['filter_options' =>array_diff_key($filters, array_keys($active_filters)), 'active_filters' => $active_filters];
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function remove_filter($filter)
    {
    	$filters = session('reports_filter_domain');
    	if(array_key_exists($filter, $filters))
        {
            unset($filters[$filter]);
            session()->put('reports_filter_domain', $filters);
        }

    	return $filters;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function messages_report()
    {
    	return view('reports.messages', ['static_data' => true, 'messages' => $this->get_filtered_data(true)['data']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function messages_by_date()
    {
        return view('reports.messages_by_date');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function filter_messages_by_date()
    {
        if(session('reports_filter_domain') != [])
        {
            $data = $this->get_filtered_data(true, false)['data']->groupBy('date');
            $labels = [];
            $results = [];
            foreach ($data as $day) {
                $stats = [
                    'label' => $day->first()->date,
                    'messages' => count($day),
                    'virus' => $day->sum('virusinfected') + $day->sum('otherinfected'),
                    'msg_virus_ratio' => 0,
                    'spam' => $day->sum('isspam') + $day->sum('ishighspam'),
                    'msg_spam_ratio' => 0,
                    'volumne' => $day->sum('size')
                ];
                $stats['msg_virus_ratio'] = ($stats['virus'] > 0) ? ($stats['virus'] / $stats['messages']) * 100 : 0;
                $stats['msg_spam_ratio'] = ($stats['spam'] > 0) ? ($stats['spam'] / $stats['messages']) * 100 : 0;
                $results[] = $stats;
                $labels[] = $day->first()->date;
            }
            return ['results' => $results, 'labels' => $labels];
        }
        else
        {
            //abort(400, 'You have not applied any filters, therefore this report will not work');
            return response()->json([ 'error' => 400, 'message' => 'You have not applied any filters, therefore this report will not work' ], 400);
        }
    }
}
