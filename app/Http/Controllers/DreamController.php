<?php

namespace App\Http\Controllers;

use App\Models\MAlbum;
use App\Models\MChannel;
use App\Models\MGroup;
use App\Models\MMember;
use App\Models\MPhotocard;
use App\Models\TPhotocard;
use App\Models\TphotocardWishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Jenssegers\ImageHash\ImageHash;
use Jenssegers\ImageHash\Implementations\DifferenceHash;
use PhpParser\Node\Stmt\Foreach_;

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
            $albums = MAlbum::where('group_id','=',$group->id)->where('tipe','=',0)->orderBy('order','desc')->get();
            $albumsThum = MAlbum::where('group_id','=',$group->id)->where('tipe','=',0)->orderBy('order','desc')->get();
            $MdThums = MAlbum::where('group_id','=',$group->id)->where('tipe','=',1)->orderBy('order','desc')->get();
        }else{
            return view('dreamcard.notfound');
        }
        return view('dreamcard.group',compact('members','albums','group','slug','albumsThum','MdThums'));
    }

    // public function listAlbumCategori($group_slug,$slug,$cat=null)
    // {
    //     $group= MGroup::where('slug','=',$group_slug)->first();
    //     $album= MAlbum::where('slug','=',$slug)->first();
    //     $categori_id=-1;
    //     $limit=1;
    //     $style1="";
    //     $style2="";
    //     $style3="";
    //     $style4="";
    //     $style5="";
    //     $style6="";
    //     $default=0;
    //     switch ($cat) {
    //         case 'other':
    //             # code...
    //             $categori_id=2;
    //             $style6="1";
    //             $limit=0;
    //             break;
    //         case 'fansign':
    //             # code...
    //             $categori_id=1;
    //             $style5="1";
    //             $limit=0;
    //             break;
    //         case 'album':
    //                 # code...
    //                 $categori_id=0;
    //                 $style4="1";
    //                 $limit=0;
    //                 break;
    //         case 'all':
    //             # code...
    //             $categori_id=-1;
    //             $style3="1";
    //             $limit=0;
    //             break;
    //         default:
    //             # code...
    //             $default=1;
    //             $categori_id=0;
    //             $style4="1";
    //             $limit=0;
    //             break;
    //     }
    //     $active="";
    //     $activemd="";
    //     $isExistAlbum=0;
    //     $isExistPob=0;
    //     $isExistOther=0;
    //     if($group!=null){
    //         $isExistAlbum = MPhotocard::join('m_channel','m_channel.id','=','m_photocard.channel_id')
    //                         ->where('m_photocard.album_id', '=', $album->id)
    //                         ->where('m_channel.kategori_id','=',0)
    //                         ->first();
    //         $isExistPob = MPhotocard::join('m_channel','m_channel.id','=','m_photocard.channel_id')
    //                         ->where('m_photocard.album_id', '=', $album->id)
    //                         ->where('m_channel.kategori_id','=',1)
    //                         ->first();
    //         $isExistOther = MPhotocard::join('m_channel','m_channel.id','=','m_photocard.channel_id')
    //                         ->where('m_photocard.album_id', '=', $album->id)
    //                         ->where('m_channel.kategori_id','=',2)
    //                         ->first();
    //         if($album->tipe==0){
    //             $active="active";
    //             $activemd="";
    //         }else{
    //             if($isExistAlbum != null){
    //                 if($default==1){
    //                     $active="";
    //                     $activemd="active";
    //                     $categori_id=0;
    //                     $style4="1";
    //                     $limit=0;
    //                 }
    //             }else if($isExistPob != null){
    //                 if($default==1){
    //                     $active="";
    //                     $activemd="active";
    //                     $categori_id=1;
    //                     $style5="1";
    //                     $limit=0;
    //                 }
    //             }else{
    //                 if($default==1){
    //                     $active="";
    //                     $activemd="active";
    //                     $categori_id=2;
    //                     $style6="1";
    //                     $limit=0;
    //                 }
    //             }
    //         }
    //         $albums = MAlbum::where('group_id','=',$group->id)->where('tipe','=',0)->orderBy('order','desc')->get();
    //         $MdThums = MAlbum::where('group_id','=',$group->id)->where('tipe','=',1)->orderBy('order','desc')->get();
    //         $members = MMember::where('group_id','=',$group->id)->get();
    //         $arrphoto=array();
    //         $channels = MChannel::where('album_id','=',$album->id);
    //         if($categori_id!=-1){
    //             $channels = $channels->where('kategori_id','=',$categori_id);
    //         }
    //         if($limit==1){
    //             $channels = $channels->limit('3');
    //         }
    //         $channels = $channels->get();
    //         $photocards = MPhotocard::where('group_id','=',$group->id)
    //                                 ->where('album_id','=',$album->id);
    //         //cek my photocard
    //         $myphotocards=array();
    //         if(@auth('web')->user()->id!=0){
    //             $myphotocard = TPhotocard::join('m_photocard','m_photocard.id','=','t_photocard.photocard_id')
    //                                     ->join('m_channel','m_photocard.channel_id','=','m_channel.id')
    //                                     ->join('m_album','m_photocard.album_id','=','m_album.id')
    //                                     ->join('m_member','m_photocard.member_id','=','m_member.id')
    //                                     ->join('m_group','m_photocard.group_id','=','m_group.id')
    //                                             ->select('m_photocard.id')
    //                                             ->where('t_photocard.user_id','=',@auth('web')->user()->id)->get();
    //             foreach ($myphotocard as $key => $value) {
    //                 $myphotocards[]= $value->id;
    //             }
    //         }
    //         //dd($myphotocards);
    //         $vipot_columns=[];
    //         foreach ($channels as $key => $channel) {
    //             $photocards = MPhotocard::where('group_id','=',$group->id)
    //                         ->where('album_id','=',$album->id)
    //                         ->where('channel_id','=',$channel->id)->get();
    //                 if(!$photocards->isEmpty()){
    //                     $vipot_columns[$key] = [
    //                         'channel'=> $channel->channel,
    //                         'photo'=>$photocards,
    //                     ];
    //                 }
    //         }
    //     }else{
    //         return view('dreamcard.notfound');
    //     }
    //     $countphoto=0;
    //     $countphotowhistlist=0;
    //     if(@auth('web')->user()->id!=0){
    //         $countphoto = TPhotocard::where('user_id','=',auth('web')->user()->id)->count();
    //         $countphotowhistlist = TphotocardWishlist::where('user_id','=',auth('web')->user()->id)->count();
    //     }

    //     return view('dreamcard.album',compact('vipot_columns','albums','group','slug','album','style1','style2','style3','style4','style5','style6','limit','members','MdThums','active','activemd','countphoto','countphotowhistlist','isExistAlbum','isExistPob','isExistOther','myphotocards'));
    // }

    public function listAlbum($group_slug,$slug,$channelid=null,$cat=null,$cek=null)
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
        $default=0;
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
                    $categori_id=0;
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
                $default=1;
                $categori_id=0;
                $style4="1";
                $limit=0;
                break;
        }
        $active="";
        $activemd="";
        $isExistAlbum=0;
        $isExistPob=0;
        $isExistOther=0;
        if($group!=null){
            $isExistAlbum = MPhotocard::join('m_channel','m_channel.id','=','m_photocard.channel_id')
                            ->where('m_photocard.album_id', '=', $album->id)
                            ->where('m_channel.kategori_id','=',0)
                            ->first();
            $isExistPob = MPhotocard::join('m_channel','m_channel.id','=','m_photocard.channel_id')
                            ->where('m_photocard.album_id', '=', $album->id)
                            ->where('m_channel.kategori_id','=',1)
                            ->first();
            $isExistOther = MPhotocard::join('m_channel','m_channel.id','=','m_photocard.channel_id')
                            ->where('m_photocard.album_id', '=', $album->id)
                            ->where('m_channel.kategori_id','=',2)
                            ->first();
            if($album->tipe==0){
                $active="active";
                $activemd="";
            }else{
                if($isExistAlbum != null){
                    if($default==1){
                        $active="";
                        $activemd="active";
                        $categori_id=0;
                        $style4="1";
                        $limit=0;
                    }
                }else if($isExistPob != null){
                    if($default==1){
                        $active="";
                        $activemd="active";
                        $categori_id=1;
                        $style5="1";
                        $limit=0;
                    }
                }else{
                    if($default==1){
                        $active="";
                        $activemd="active";
                        $categori_id=2;
                        $style6="1";
                        $limit=0;
                    }
                }
            }
            $albums = MAlbum::where('group_id','=',$group->id)->where('tipe','=',0)->orderBy('order','desc')->get();
            $MdThums = MAlbum::where('group_id','=',$group->id)->where('tipe','=',1)->orderBy('order','desc')->get();
            $members = MMember::where('group_id','=',$group->id)->get();
            $arrphoto=array();

            $channels = MChannel::where('album_id','=',$album->id);
            if($channelid!=0){
                $channels = $channels->where('id','=',$channelid);
            }else{
                if($categori_id!=-1){
                    $channels = $channels->where('kategori_id','=',$categori_id);
                }
            }
            if($limit==1){
                $channels = $channels->limit('3');
            }
            $channels = $channels->get();

            //melakukan pengecekan dengann koleksi user
            $myphotocards=array();
            if(@auth('web')->user()->id!=0){
                if($cek!=null){
                    $myphotocard = TPhotocard::join('m_photocard','m_photocard.id','=','t_photocard.photocard_id')
                                            ->join('m_channel','m_photocard.channel_id','=','m_channel.id')
                                            ->join('m_album','m_photocard.album_id','=','m_album.id')
                                            ->join('m_member','m_photocard.member_id','=','m_member.id')
                                            ->join('m_group','m_photocard.group_id','=','m_group.id')
                                                    ->select('m_photocard.id')
                                                    ->where('t_photocard.user_id','=',@auth('web')->user()->id)->get();
                    foreach ($myphotocard as $key => $value) {
                        $myphotocards[]= $value->id;
                    }
                }
            }

            //membuat daftar photocard
            $vipot_columns=[];
            foreach ($channels as $key => $channel) {
                $photocards = MPhotocard::where('group_id','=',$group->id)
                            ->where('album_id','=',$album->id)
                            ->where('channel_id','=',$channel->id)->get();

                $vipot_columns[$key] = [
                    'channel'=> $channel->channel,
                    'photo'=>$photocards
                ];
            }
        }else{
            return view('dreamcard.notfound');
        }
        $countphoto=0;
        $countphotowhistlist=0;
        if(@auth('web')->user()->id!=0){
            $countphoto = TPhotocard::where('user_id','=',auth('web')->user()->id)->count();
            $countphotowhistlist = TphotocardWishlist::where('user_id','=',auth('web')->user()->id)->count();
        }
        return view('dreamcard.album',compact('vipot_columns','albums','group','slug','album','style1','style2','style3','style4','style5','style6','limit','members','MdThums','active','activemd','countphoto','countphotowhistlist','isExistAlbum','isExistPob','isExistOther','myphotocards','cek'));

    }

    public function listMember($group_slug,$slug,$cek=null)
    {
        $group= MGroup::where('slug','=',$group_slug)->first();
        $member = MMember::where('slug','=',$slug)->first();
        // if($slug!=0){
        //     $member = MMember::where('slug','=',$slug)->first();
        // }else{
        //     $member = MMember::first();
        // }
        $members = MMember::where('group_id','=',$group->id)->get();
        if($group!=null){
            $albums = MAlbum::where('group_id','=',$group->id)->where('tipe','=',0)->orderBy('order','desc')->get();
            $MdThums = MAlbum::where('group_id','=',$group->id)->where('tipe','=',1)->orderBy('order','desc')->get();
            $allalbums = MAlbum::where('group_id','=',$group->id)->orderBy('order','desc')->get();

            //cek dengan koleksi
            $myphotocards=array();
            if(@auth('web')->user()->id!=0){
                if($cek!=null){
                    $myphotocard = TPhotocard::join('m_photocard','m_photocard.id','=','t_photocard.photocard_id')
                                            ->join('m_channel','m_photocard.channel_id','=','m_channel.id')
                                            ->join('m_album','m_photocard.album_id','=','m_album.id')
                                            ->join('m_member','m_photocard.member_id','=','m_member.id')
                                            ->join('m_group','m_photocard.group_id','=','m_group.id')
                                                    ->select('m_photocard.id')
                                                    ->where('t_photocard.user_id','=',@auth('web')->user()->id)->get();
                    foreach ($myphotocard as $key => $value) {
                        $myphotocards[]= $value->id;
                    }
                }
            }

            //menampilkan sesuai dengan masterdata
            $photocards = MPhotocard::where('group_id','=',$group->id)
                                    ->where('member_id','=',$member->id);
            $vipot_columns=[];
            foreach ($allalbums as $key => $album) {
                $channels = MChannel::where('album_id','=',$album->id)
                                    ->select('kategori_id',DB::raw('if(kategori_id=0,"Album Inclusions",if(kategori_id=1,"Fansign/POB","Other Photocard")) as channel'))
                                    ->groupBy('m_channel.kategori_id')->get();
                $vipot_cat_photo=[];
                foreach ($channels as $keyc => $channel) {
                    $photocards = MPhotocard::join('m_channel','m_channel.id','=','m_photocard.channel_id')
                            ->select("m_photocard.*")
                            ->where('m_photocard.group_id','=',$group->id)
                            ->where('m_photocard.album_id','=',$album->id)
                            ->where('m_channel.kategori_id','=',$channel->kategori_id)
                            ->where('m_photocard.member_id','=',$member->id)->get();
                            $vipot_cat_photo[$keyc]=[
                                "cat" => $channel,
                                "photo"=>  $photocards
                            ];
                }
                $vipot_columns[$key] = [
                    'album'=> $album->album,
                    'photo'=>$vipot_cat_photo
                ];
            }
        }else{
            return view('dreamcard.notfound');
        }
        $countphoto=0;
        $countphotowhistlist=0;
        if(@auth('web')->user()->id!=0){
            $countphoto = TPhotocard::where('user_id','=',auth('web')->user()->id)->count();
            $countphotowhistlist = TphotocardWishlist::where('user_id','=',auth('web')->user()->id)->count();
        }
        return view('dreamcard.member',compact('vipot_columns','members','group','slug','group_slug','albums','countphoto','countphotowhistlist','MdThums','myphotocards','cek'));
    }

    public function addToCart($id)
    {
        $photocard = MPhotocard::findOrFail($id);
        $channel = MChannel::findOrFail($photocard->channel_id);
        $album = MAlbum::findOrFail($photocard->album_id);
        $group = MGroup::findOrFail($photocard->group_id);
        $member = MMember::findOrFail($photocard->member_id);
        $userid = auth('web')->user()->id;
        $exist=0;
        if($userid!=0){
            $isExist = TPhotocard::where('photocard_id', '=', $photocard->id)
                        ->where('user_id','=',$userid)
                        ->first();
            if ($isExist === null) {
                $tphotocard = new TPhotocard();
                $tphotocard->photocard_id = $photocard->id;
                $tphotocard->user_id = auth('web')->user()->id;
                $tphotocard->save();
            }else{
                $exist=1;
            }
        }
        $countphoto = TPhotocard::where('user_id','=',auth('web')->user()->id)->count();
        return response()->json([
            "countphoto"=>$countphoto,
            "exist"=>$exist
        ]);
     }

    public function remove(Request $request)
    {
        if($request->id) {
            // $cart = session()->get('cart');
            // if(isset($cart[$request->id])) {
            //     unset($cart[$request->id]);
            //     session()->put('cart', $cart);
            // }
            //dd($request->id);
            $userid=auth('web')->user()->id;
            if($userid!=0){
                $query = TPhotocard::where('user_id','=',$userid)
                            ->where('photocard_id','=',$request->id)->delete();
            }
            session()->flash('success', 'Product removed successfully');
        }
    }

    public function removeall(Request $request)
    {
        //$request->session()->forget('cart');
        $userid=auth('web')->user()->id;
        if($userid!=0){
            $query = TPhotocard::where('user_id','=',$userid)->delete();
        }
        session()->flash('success', 'Product removed successfully');
    }

    public function cart($namagroup,$slugalbum=null,$slugchannel=null)
    {
        if(auth('web')->user()==null){
            return view('dreamcard.notfound');
        }
        $hastag=[];
        $album=[];
        $member=[];
        $group=[];
        $userid=auth('web')->user()->id;
        $cart = TPhotocard::join('m_photocard','m_photocard.id','=','t_photocard.photocard_id')
                            ->join('m_channel','m_photocard.channel_id','=','m_channel.id')
                            ->join('m_album','m_photocard.album_id','=','m_album.id')
                            ->join('m_member','m_photocard.member_id','=','m_member.id')
                            ->join('m_group','m_photocard.group_id','=','m_group.id')
                                    ->select('t_photocard.id'
                                    ,'m_photocard.id as photo_id'
                                    ,'m_photocard.album_id'
                                    ,'m_photocard.member_id','m_photocard.group_id'
                                    ,'m_photocard.pic_front'
                                    ,'m_channel.channel'
                                    ,'m_album.id as album_id' ,'m_album.album'
                                    ,'m_member.id as member_id' ,'m_member.member_name as member'
                                    ,'m_group.id as group_id' ,'m_group.group_name as group'
                                    )
                                    ->where('t_photocard.user_id','=',$userid);
       //namagroupnamagroupnamagroupdd($namagroup." - ".$album);
       if($namagroup!=null){
        $cart = $cart->where('m_group.slug','=',$namagroup);
       }
       if($slugalbum!=null){
            $cart = $cart->where('m_album.slug','=',$slugalbum);
        }
        $cart = $cart->get();
       foreach ($cart  as $key => $value) {
            $album[$value['album_id']]=[
                "album" => $value['album']
            ];
        }
        foreach ($cart  as $key => $members) {
            $member[$members['member_id']]=[
                "member" => $members['member']
            ];
        }
        $group_id=0;
        foreach ($cart  as $key => $groups) {
            $group[$groups['group_id']]=[
                "group" => $groups['group']
            ];
            $group_id = $groups['group_id'];
        }
        $hastag=[
            "tipe" =>"#MyPhotocard",
            "photo" =>"#Photocard",
            "group" =>$group,
            "album" =>$album,
            "member"=>$member
        ];
        $albums=[];
        $members=[];
        $sideMenu=[];
        if($group_id!=0){
            $group= MGroup::where('id','=',$group_id)->first();
            $groups = TPhotocard::join('m_photocard','m_photocard.id','=','t_photocard.photocard_id')
                        ->join('m_group','m_group.id','=','m_photocard.group_id')
                        ->select('m_group.id','m_group.group_name','m_group.slug')
                        ->where('t_photocard.user_id','=',$userid)
                        ->groupBy('m_group.id','m_group.group_name','m_group.slug')
                        ->get();
            foreach ($groups as $key => $group) {
                //mencari channel
                $albums = TPhotocard::join('m_photocard','m_photocard.id','=','t_photocard.photocard_id')
                            ->join('m_album','m_album.id','=','m_photocard.album_id')
                            ->select('m_album.id','m_album.album','m_album.slug')
                            ->where('t_photocard.user_id','=',$userid)
                            ->where('m_photocard.group_id','=',$group->id)
                            ->groupBy('m_album.id','m_album.album','m_album.slug')
                            ->get();
                # code...
                $sideMenu[$key]=[
                    "group"=>$group,
                    "channel"=>$albums,
                ];
            }
            $members = MMember::where('group_id','=',$group->id)->get();
        }
        return view('dreamcard.tphotocard',compact('hastag','namagroup','albums','members','group','cart','sideMenu'));
    }


    public function addToCartWtb($id)
    {
        $photocard = MPhotocard::findOrFail($id);
        $channel = MChannel::findOrFail($photocard->channel_id);
        $album = MAlbum::findOrFail($photocard->album_id);
        $group = MGroup::findOrFail($photocard->group_id);
        $member = MMember::findOrFail($photocard->member_id);
        $userid = auth('web')->user()->id;
        $countphotowish=0;
        $exist=0;
        if($userid!=0){
            $isExist = TphotocardWishlist::where('photocard_id', '=', $photocard->id)
                        ->where('user_id','=',$userid)
                        ->first();
            if ($isExist === null) {
                $tphotocard = new TphotocardWishlist();
                $tphotocard->photocard_id = $photocard->id;
                $tphotocard->user_id = auth('web')->user()->id;
                $tphotocard->save();
            }else{
                $exist=1;
            }
            $countphotowish = TphotocardWishlist::where('user_id','=',auth('web')->user()->id)->count();
        }
        $countphoto=$countphotowish;
        return response()->json([
            "countphoto"=>$countphoto,
            "exist"=>$exist
        ]);
    }

    public function cartwtb($namagroup=null,$slugalbum=null,$slugchannel=null)
    {
        if(auth('web')->user()==null){
            return view('dreamcard.notfound');
        }
        $hastag=[];
        $album=[];
        $member=[];
        $group=[];
        $userid=auth('web')->user()->id;
        $cart = TphotocardWishlist::join('m_photocard','m_photocard.id','=','t_photocard_whislist.photocard_id')
                            ->join('m_channel','m_photocard.channel_id','=','m_channel.id')
                            ->join('m_album','m_photocard.album_id','=','m_album.id')
                            ->join('m_member','m_photocard.member_id','=','m_member.id')
                            ->join('m_group','m_photocard.group_id','=','m_group.id')
                                    ->select('t_photocard_whislist.id'
                                    ,'m_photocard.id as photo_id'
                                    ,'m_photocard.album_id'
                                    ,'m_photocard.member_id','m_photocard.group_id'
                                    ,'m_photocard.pic_front'
                                    ,'m_channel.channel'
                                    ,'m_album.id as album_id' ,'m_album.album as album'
                                    ,'m_member.id as member_id' ,'m_member.member_name as member'
                                    ,'m_group.id as group_id' ,'m_group.group_name as group'
                                    )
                                    ->where('t_photocard_whislist.user_id','=',$userid);
        if($namagroup!=null){
            $cart = $cart->where('m_group.slug','=',$namagroup);
        }
        if($slugalbum!=null){
            $cart = $cart->where('m_album.slug','=',$slugalbum);
        }
       foreach ($cart  as $key => $value) {
            $album[$value['album_id']]=[
                "album" => $value['album']
            ];
        }
        $cart=$cart->get();
        foreach ($cart  as $key => $members) {
            $member[$members['member_id']]=[
                "member" => $members['member']
            ];
        }
        $group_id=0;
        foreach ($cart  as $key => $groups) {
            $group[$groups['group_id']]=[
                "group" => $groups['group']
            ];
            $group_id = $groups['group_id'];
        }
        $hastag=[
            "tipe" =>"#WTB",
            "photo" =>"#Photocard",
            "group" =>$group,
            "album" =>$album,
            "member"=>$member
        ];
        $group=[];
        $albums=[];
        $members=[];
        $sideMenu=[];
        if($group_id!=0){
            $group= MGroup::where('id','=',$group_id)->first();
            $groups = TphotocardWishlist::join('m_photocard','m_photocard.id','=','t_photocard_whislist.photocard_id')
                        ->join('m_group','m_group.id','=','m_photocard.group_id')
                        ->select('m_group.id','m_group.group_name','m_group.slug')
                        ->where('t_photocard_whislist.user_id','=',$userid)
                        ->groupBy('m_group.id','m_group.group_name','m_group.slug')
                        ->get();
            foreach ($groups as $key => $group) {
                //mencari channel
                $albums = TphotocardWishlist::join('m_photocard','m_photocard.id','=','t_photocard_whislist.photocard_id')
                            ->join('m_album','m_album.id','=','m_photocard.album_id')
                            ->select('m_album.id','m_album.album','m_album.slug')
                            ->where('t_photocard_whislist.user_id','=',$userid)
                            ->where('m_photocard.group_id','=',$group->id)
                            ->groupBy('m_album.id','m_album.album','m_album.slug')
                            ->get();
                # code...
                $sideMenu[$key]=[
                    "group"=>$group,
                    "channel"=>$albums,
                ];
            }
            $members = MMember::where('group_id','=',$group->id)->get();
            $albums = MAlbum::where('group_id','=',$group->id)->where('tipe','=',0)->orderBy('order','desc')->get();
            $members = MMember::where('group_id','=',$group->id)->get();
        }
        return view('dreamcard.tphotocardwtb',compact('hastag','namagroup','albums','members','group','cart','sideMenu'));
    }

    public function removewtb(Request $request)
    {
        if($request->id) {
            $userid=auth('web')->user()->id;
            if($userid!=0){
                $query = TphotocardWishlist::where('user_id','=',$userid)
                            ->where('photocard_id','=',$request->id)->delete();
            }
            session()->flash('success', 'Product removed successfully');
        }
    }

    public function removeallwtb(Request $request)
    {
        //$request->session()->forget('cartwtb');
        $userid=auth('web')->user()->id;
        if($userid!=0){
            $query = TphotocardWishlist::where('user_id','=',$userid)->delete();
        }
        session()->flash('success', 'Product removed successfully');
    }

    public function addToCartTrhave($id)
    {
        $photocard = MPhotocard::findOrFail($id);

        $cart = session()->get('carttrhave', []);

        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "quantity" => 1,
                "id"=>$photocard->id,
                "name"=>$photocard->memberp->member_name,
                "pic_front" => $photocard->pic_front,
                "pic_back" => $photocard->pic_back
            ];
        }

        session()->put('carttrhave', $cart);
        $countphoto=count((array) session('carttrhave'));
        return response()->json(["countphoto"=>$countphoto]);
    }

    public function addToCartTrwant($id)
    {
        $photocard = MPhotocard::findOrFail($id);

        $cart = session()->get('carttrwant', []);

        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "quantity" => 1,
                "id"=>$photocard->id,
                "name"=>$photocard->memberp->member_name,
                "pic_front" => $photocard->pic_front,
                "pic_back" => $photocard->pic_back
            ];
        }

        session()->put('carttrwant', $cart);
        $countphoto=count((array) session('carttrwant'));
        return response()->json(["countphoto"=>$countphoto]);
    }

    public function carttr()
    {
        return view('dreamcard.tphotocardtr');
    }

    public function searchphotocard($group_slug=null)
    {
        // return view('dreamcard.search');
        $distances = [];
        $group=[];
        $albums = [];
        $members=[];
        if($group_slug!=null){
            $group= MGroup::where('slug','=',$group_slug)->first();
            $albums = MAlbum::where('group_id','=',$group->id)->where('tipe','=',0)->orderBy('order','desc')->get();
            $members = MMember::where('group_id','=',$group->id)->get();
        }
        return view('dreamcard.search',compact('distances','group','albums','members'));
    }

    public function prosesUpload(Request $request){
		$this->validate($request, [
			'file' => 'required | mimes:jpeg,jpg,png | max:1000',
            'g-recaptcha-response' => 'recaptcha',
		]);
		// menyimpan data file yang diupload ke variabel $file
		$file = $request->file('file');
        $tujuan_upload = public_path('data_pencarian');//'uploads\\data_pencarian';
	    $file->move($tujuan_upload,$file->getClientOriginalName());
        $pathfind = public_path('data_pencarian')."\\".$file->getClientOriginalName();
        if(config('app.str_adm')!="production"){
            $pathfind = str_replace("\\","/",$pathfind );
        }
        $hasher = new ImageHash(new DifferenceHash());
        $hashSearch = $hasher->hash($pathfind);

        $distances = [];
        $photocards = MPhotocard::orderBy('id', 'DESC')->get();

        $group_id=0;
        foreach ($photocards as $key => $photocard) {
            $bits1 = $hashSearch->toBits();
            $bits2 = $photocard->hash_img;
            $length = max(strlen($bits1), strlen($bits2));
            $bits1 = str_pad($bits1, $length, '0', STR_PAD_LEFT);
            $bits2 = str_pad($bits2, $length, '0', STR_PAD_LEFT);
            $count = count(array_diff_assoc(str_split($bits1), str_split($bits2)));
            if($count<25){
                $distances[$key] = [
                    'count'=>$count,
                    'photo'=> $photocard->pic_front,
                    'group'=>$photocard->groupp->group_name,
                    'channel'=> $photocard->channelp->channel,
                    'member' =>$photocard->memberp->member_name,
                    'album' =>$photocard->albump->album,
                    'group_slug'=>$photocard->groupp->slug,
                    'group_id'=>$photocard->group_id,
                    'album_slug'=>$photocard->albump->slug,
                    'id'=>$photocard->id
                ] ;
                $group_id=$photocard->group_id;
           }
        }

        //delete file di server
        unlink($pathfind);
        asort($distances);

        $group=[];
        $albums = [];
        $members=[];
        if( $group_id!=0){
            $group= MGroup::where('id','=', $group_id)->first();
            $albums = MAlbum::where('group_id','=',$group->id)->where('tipe','=',0)->orderBy('order','desc')->get();
            $members = MMember::where('group_id','=',$group->id)->get();
        }
        return view('dreamcard.search',compact('distances','group','albums','members'));
	}


    public function detailPhoca($group,$album,$photocard_id=null)
    {
        $pic_front="";
        $pic_back="";
        $url="/photocard/".$group."/".$album."/".$photocard_id;
        $page_id=$photocard_id;
        if($tipe=0){
            //balik ke member
        }else{
            //balik ke album
        }
        $group_id=0;
        if($photocard_id!=null){
            $photocard = MPhotocard::findOrFail($photocard_id);
            $group_id = $photocard->group_id;
            if($photocard->pic_hd!=null){
                $pic_front=config('app.url')."/".config('app.str')."/".$photocard->pic_hd;
            }else{
                $pic_front=config('app.url')."/".config('app.str')."/".$photocard->pic_front;
            }
            if($photocard->pic_back!=null){
                $pic_back=config('app.url')."/".config('app.str')."/".$photocard->pic_back;
            }else{
                $pic_back=config('app.url')."/".config('app.str')."/images/default_back.jpg";
            }

            $otherPhotocard = MPhotocard::where('channel_id','=',$photocard->channel_id)->get();
        }
        $albums=[];
        $members=[];
        $countphoto=0;
        $countphotowhistlist=0;
        if($group_id!=0){
            $group= MGroup::where('id','=',$group_id)->first();
            $albums = MAlbum::where('group_id','=',$group->id)->where('tipe','=',0)->orderBy('order','desc')->get();
            $MdThums = MAlbum::where('group_id','=',$group->id)->where('tipe','=',1)->orderBy('order','desc')->get();
            $members = MMember::where('group_id','=',$group->id)->get();

            //cek berapa ada photocard dan whislist
            $isExist=null;
            $isExistWhislist =null;
            if(@auth('web')->user()->id!=0){
                $countphoto = TPhotocard::where('user_id','=',auth('web')->user()->id)->count();
                $countphotowhistlist = TphotocardWishlist::where('user_id','=',auth('web')->user()->id)->count();
                $isExist = TPhotocard::where('photocard_id', '=', $photocard->id)
                        ->where('user_id','=',auth('web')->user()->id)
                        ->first();
                $isExistWhislist = TphotocardWishlist::where('photocard_id', '=', $photocard->id)
                        ->where('user_id','=',auth('web')->user()->id)
                        ->first();
            }



        }
        return view('dreamcard.photocard',compact('photocard','pic_front','pic_back','page_id','url','albums','members','group','MdThums','countphoto','countphotowhistlist','isExist','isExistWhislist','otherPhotocard'));
    }
}
