<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommunityLinkForm;
use App\Models\CommunityLink;
use Illuminate\Http\Request;
use App\Queries\CommunityLinkQuery;
use Illuminate\Support\Facades\Auth;

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
    public function store(CommunityLinkForm $request)
    {
        $data = $request->validated();

        $link = new CommunityLink($data);
        $enviado = $link->hasAlreadyBeenSubmitted();
        if (!$enviado) {
            $link->user_id = Auth::id();
            $link->approved = Auth::user()->trusted ?? false;
            $link->save();
            $response = [
                'status' => 'success',
                'message' => 'Link created',
                'data' => $link,
                ];
        } else {
            $response = [
                'status' => 'success',
                'message' => 'Link already submitted',
                'data' => $link,
                ];
        }
        return response()->json($response,200);
    }

    /**
     * Display the specified resource.
     */
    public function show(CommunityLink $communitylink)
    {
        if($communitylink){
            return response()->json($communitylink,200);
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
    public function destroy(CommunityLink $communitylink)
    {
        $communitylink->delete();
        return response()->json(['message' => 'Link eliminado'],200);
    }
}
