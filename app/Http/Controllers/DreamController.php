<?php

namespace App\Http\Controllers;

use App\Models\MAlbum;
use App\Models\MChannel;
use App\Models\MGroup;
use App\Models\MMember;
use App\Models\MPhotocard;

class DreamController extends Controller
{
    public function index()
    {
        $groups = MGroup::all();
        return view('welcome',compact('groups'));
    }

    public function listPerGroup($slug)
    {
        //test
        $group= MGroup::where('slug','=',$slug)->first();
        if($group!=null){
            $members = MMember::where('group_id','=',$group->id)->get();
            $albums = MAlbum::where('group_id','=',$group->id)->orderBy('order','desc')->get();
            $albumsThum = MAlbum::where('group_id','=',$group->id)->orderBy('order','desc')->get();
        }else{
            return view('dreamcard.notfound');
        }
        return view('dreamcard.group',compact('members','albums','group','slug','albumsThum'));
    }

    // public function listAlbum($group_slug,$slug)
    // {
    //     $group= MGroup::where('slug','=',$group_slug)->first();
    //     $album= MAlbum::where('slug','=',$slug)->first();
    //     $style1="";
    //     $style2="";
    //     $style3="1";
    //     $style4="";
    //     $style5="";
    //     $style6="";
    //     if($group!=null){
    //         $albums = MAlbum::where('group_id','=',$group->id)->orderBy('order','desc')->get();
    //         $arrphoto=array();
    //         $channels = MChannel::where('album_id','=',$album->id)->get();
    //         $photocards = MPhotocard::where('group_id','=',$group->id)
    //                                 ->where('album_id','=',$album->id);
    //         $vipot_columns=[];
    //         foreach ($channels as $key => $channel) {
    //             $photocards = MPhotocard::where('group_id','=',$group->id)
    //                         ->where('album_id','=',$album->id)
    //                         ->where('channel_id','=',$channel->id)->get();
    //             if (! array_key_exists($key,$channel) ) {
    //                 $vipot_columns[$key] = [
    //                     'channel'=> $channel->channel,
    //                     'photo'=>$photocards
    //                 ];
    //             }
    //         }
    //         //dd($vipot_columns);
    //     }else{
    //     }
    //     return view('dreamcard.album',compact('vipot_columns','albums','group','slug','album','style1','style2','style3','style4','style5','style6'));
    // }

    public function listAlbumCategori($group_slug,$slug,$cat=null)
    {
        $group= MGroup::where('slug','=',$group_slug)->first();
        $album= MAlbum::where('slug','=',$slug)->first();
        $categori_id=-1;
        $limit=1;
        $style1="";
        $style2="";
        $style3="";
        $style4="";
        $style5="";
        $style6="";
        switch ($cat) {
            case 'other':
                # code...
                $categori_id=2;
                $style6="1";
                $limit=0;
                break;
            case 'fansign':
                # code...
                $categori_id=1;
                $style5="1";
                $limit=0;
                break;
            case 'album':
                    # code...
                    $categori_id=-1;
                    $style4="1";
                    $limit=0;
                    break;
            case 'all':
                # code...
                $categori_id=-1;
                $style3="1";
                $limit=0;
                break;
            default:
                # code...
                $categori_id=-1;
                $style3="1";
                $limit=1;
                break;
        }
        //dd($limit);
        if($group!=null){
            $albums = MAlbum::where('group_id','=',$group->id)->orderBy('order','desc')->get();
            $arrphoto=array();
            $channels = MChannel::where('album_id','=',$album->id);
            if($categori_id!=-1){
                $channels = $channels->where('kategori_id','=',$categori_id);
            }
            if($limit==1){
                $channels = $channels->limit('3');
            }
            $channels = $channels->get();
            //dd($channels);
            $photocards = MPhotocard::where('group_id','=',$group->id)
                                    ->where('album_id','=',$album->id);
            $vipot_columns=[];
            foreach ($channels as $key => $channel) {
                $photocards = MPhotocard::where('group_id','=',$group->id)
                            ->where('album_id','=',$album->id)
                            ->where('channel_id','=',$channel->id)->get();
                if($channel!=null){
                    if (!array_key_exists($key,$channel) ) {
                        $vipot_columns[$key] = [
                            'channel'=> $channel->channel,
                            'photo'=>$photocards
                        ];
                    }
                }
            }
        }else{
            return view('dreamcard.notfound');
        }
        return view('dreamcard.album',compact('vipot_columns','albums','group','slug','album','style1','style2','style3','style4','style5','style6','limit'));
    }
}
