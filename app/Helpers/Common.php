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
            $count = MMember::where('group_id','=',$master->group_id)->count();
            $range = range(1, $count);
        }else{
            $range = range(0,0);
        }

        return $range;
    }
}
