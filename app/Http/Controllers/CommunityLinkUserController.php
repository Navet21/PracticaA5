<?php

namespace App\Http\Controllers;

use App\Models\CommunityLinkUser;
use Illuminate\Http\Request;
use App\Models\CommunityLink;
use Illuminate\Support\Facades\Auth;
class CommunityLinkUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CommunityLink $link)
    {
        CommunityLinkUser::firstOrNew(['user_id' => Auth::id(), 'community_link_id' => $link->id])->toggle();
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(CommunityLinkUser $communityLinkUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CommunityLinkUser $communityLinkUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CommunityLinkUser $communityLinkUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CommunityLinkUser $communityLinkUser)
    {
        //
    }
}
