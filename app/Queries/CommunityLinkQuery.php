<?php

namespace App\Queries;

use App\Models\Channel;
use App\Models\CommunityLink;

class CommunityLinkQuery
{
    public function getByChannel(Channel $channel)
    {
        $links = $channel->communityLinks()->where('approved', true)->latest('updated_at')->paginate(10);
        return $links;
    }

    public function getAll()
    {
        $links = CommunityLink::where('approved', true)->latest('updated_at')->paginate(10);
        return $links;

    }

    public function getMostPopular()
    {
        $links = CommunityLink::withCount('users')->where('approved', true)->orderby('users_count', 'desc')->paginate(10);
        return $links;
    }

    public function getMostPopularByChannel(Channel $channel){
        $links = $channel->communityLinks()->withCount('users')->where('approved', true)->orderby('users_count', 'desc')->paginate(10);
        return  $links;

    }

    public function getLinksLikeTittle(String $busqueda){
        // Comillas dobles para hacer echo de la variable
        $links = CommunityLink::where('approved',true)->whereAny(['title','link'], 'LIKE', "%{$busqueda}%")->paginate(10);
        return $links;
    }
}
