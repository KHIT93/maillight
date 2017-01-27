<?php

namespace MailLight\Http\Controllers;

use Illuminate\Http\Request;
use MailLight\Models\BlacklistEntry;
use MailLight\Support\Api\DeleteResponse;

class BlacklistsController extends Controller
{

    /**
     * Search the storage for a subset of records.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        return ($request->has('query_key')) ? BlacklistEntry::where('from_address', 'like', '%'.$request->get('query_key').'%')->orWhere('to_address', 'like', '%'.$request->get('query_key').'%')->orWhere('to_domain', 'like', '%'.$request->get('query_key').'%')->get(): BlacklistEntry::orderBy('mailwatch_id', 'desc')->take(50)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return BlacklistEntry::create($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(BlacklistEntry $blacklist)
    {
        return ['entity' => $blacklist->uuid, 'status' => $blacklist->delete()];
    }
}
