<?php

namespace App\Helpers;

use App\Models\MMasterPhotocard;
use App\Models\MMember;

class Common
{
    public function listMember($id)
    {
        if($id!=0){
            $master = MMasterPhotocard::find($id);
            $first = MMember::where('group_id','=',$master->group_id)->where('tipe',0)->orderBy('id','asc')->first();
            $last = MMember::where('group_id','=',$master->group_id)->where('tipe',0)->orderBy('id','desc')->first();
            $range = range($first->id, $last->id);
        }else{
            $range = range(0,0);
        }

        return $range;
    }
}
