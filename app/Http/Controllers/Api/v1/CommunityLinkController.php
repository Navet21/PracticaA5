<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\CommunityLink;
use Illuminate\Http\Request;
use App\Queries\CommunityLinkQuery;

class CommunityLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $term = request()->get('busqueda');
        if (request()->exists('popular')) {
            $links = (new CommunityLinkQuery())->getMostPopular();
        }
        elseif($term){
            // El metodo request()->get(palabraclave) me recoje el valor de la palabra clave que le paso por el input, tiene que tener el mismo nombre en la variable name
            $links = (new CommunityLinkQuery())->getLinksLikeTittle($term);
        }
        else {
            $links = (new CommunityLinkQuery())->getAll(); 
        }
        return response()->json($links,200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(CommunityLink $communityLink)
    {
        if($communityLink){
            return response()->json($communityLink,200);
        }
        else{
            return response("Link no encontrado");
        }
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
}
