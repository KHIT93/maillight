<?php

namespace MailLight\Http\Controllers;

use Illuminate\Http\Request;
use MailLight\Models\WhitelistEntry;
use MailLight\Support\Api\DeleteResponse;

class WhitelistsController extends Controller
{

    /**
     * Search the storage for a subset of records.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        return ($request->has('query_key')) ? WhitelistEntry::where('from_address', 'like', '%'.$request->get('query_key').'%')->orWhere('to_address', 'like', '%'.$request->get('query_key').'%')->orWhere('to_domain', 'like', '%'.$request->get('query_key').'%')->get(): WhitelistEntry::orderBy('mailwatch_id', 'desc')->take(50)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return WhitelistEntry::create($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(WhitelistEntry $whitelist)
    {
        return ['entity' => $whitelist->uuid, 'status' => $whitelist->delete()];
    }
}
