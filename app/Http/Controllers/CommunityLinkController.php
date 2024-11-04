<?php

namespace App\Http\Controllers;
use App\Http\Requests\CommunityLinkForm;
use Illuminate\Support\Facades\Auth;
use App\Models\CommunityLink;
use Illuminate\Http\Request;
use App\Models\Channel;
use App\Queries\CommunityLinkQuery;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class CommunityLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Channel $channel = null)
    {
        if($channel && request()->exists('popular') ){
            $links = (new CommunityLinkQuery())->getMostPopularByChannel($channel);
        }
        else if($channel){
            $links = (new CommunityLinkQuery())->getByChannel($channel);
        }
        else if (request()->exists('popular')) {
            $links = (new CommunityLinkQuery())->getMostPopular();
        }
        else {
            $links = (new CommunityLinkQuery())->getAll(); 
        }
        $channels = Channel::orderBy('title', 'asc')->get();
        return view('dashboard', compact('links'), compact('channels'));
        
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
    public function store(CommunityLinkForm $request)
    {
        $data = $request->validated();
        $link = new CommunityLink($data);
        $enviado = $link->hasAlreadyBeenSubmitted();
        if (!$enviado) {
            // Si uso CommunityLink::create($data) tengo que declarar user_id y channel_id como $fillable
            $link->user_id = Auth::id();
            $link->approved = Auth::user()->trusted ?? false;
            $link->save();
            return Auth::user()->trusted ? back()->with('success', "Link shared!") : back()->with('info', "Link waiting for confirm!");
            // if(Auth::user()->trusted){
            //     return back()->with('success',"Link shared!");
            // }
            // else{
            //     return back()->with('info',"Link waiting for confirm!");
            // }
        } else {
            return back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CommunityLink $communityLink)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CommunityLink $communityLink)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CommunityLink $communityLink)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CommunityLink $communityLink)
    {
        //
    }

    public function linksDeUsuarios()
    {
        $user = Auth::user();
        $links = $user->mylinks()->paginate(10);
        return view('mylinks', compact('links'));
    }
}

//Preguntas practica A10
/*
$channels = Channel::orderBy('title','asc')->get();
Este código lo que hace es que consigue todos los channels , los ordena por titulo y los ordena de manera ascendente.

<div class="mb-4">
<label for="Channel" class="block text-white font-medium">Channel:</label>
<select
class="@error('channel_id') is-invalid @enderror mt-1 block w-full rounded-md border-gray-600 bg-gray-700 text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
name="channel_id">
<option selected disabled>Pick a Channel...</option>
@foreach ($channels as $channel)
<option value="{{ $channel->id }}">
{{ $channel->title }}
</option>
@endforeach
</select>
@error('channel_id')
<span class="text-red-500 mt-2">{{ $message }}</span>
@enderror
</div>

Este código lo que hace es poner un desplegable seleccionable y con un for each los genera y pone el titulo del channel para seleccionar.

<div class="mb-4">
<label for="Channel" class="block text-white font-medium">Channel:</label>
<select
class="@error('channel_id') is-invalid @enderror mt-1 block w-full rounded-md border-gray-600 bg-gray-700 text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
name="channel_id">
<option selected disabled>Pick a Channel...</option>
@foreach ($channels as $channel)
<option value="{{ $channel->id }}">
{{ $channel->title }}
</option>
@endforeach
</select>
@error('channel_id')
<span class="text-red-500 mt-2">{{ $message }}</span>
@enderror
</div>

Esta línea lo que hace es poner el valor anterior por si fallamos al meter un link y queremos mantener los valores del channel.

*/