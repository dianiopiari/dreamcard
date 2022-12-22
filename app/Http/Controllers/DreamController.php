<?php

namespace App\Http\Controllers;

use App\Models\MAlbum;
use App\Models\MChannel;
use App\Models\MGroup;
use App\Models\MMember;
use App\Models\MPhotocard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
                $categori_id=0;
                $style4="1";
                $limit=0;
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
                    //dd(array($channel));
                    $vipot_columns[$key] = [
                        'channel'=> $channel->channel,
                        'photo'=>$photocards
                    ];
            }
        }else{
            return view('dreamcard.notfound');
        }
        return view('dreamcard.album',compact('vipot_columns','albums','group','slug','album','style1','style2','style3','style4','style5','style6','limit'));
    }


    public function listMember($group_slug,$slug=null)
    {
        $group= MGroup::where('slug','=',$group_slug)->first();
        if($slug!=null){
            $member = MMember::where('slug','=',$slug)->first();
        }else{
            $member = MMember::first();
        }
        $members = MMember::where('group_id','=',$group->id)->get();
        if($group!=null){
            $albums= MAlbum::where('group_id','=',$group->id)->orderBy('order','desc')->get();
            $photocards = MPhotocard::where('group_id','=',$group->id)
                                    ->where('member_id','=',$member->id);
            $vipot_columns=[];
            foreach ($albums as $key => $album) {
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
        return view('dreamcard.member',compact('vipot_columns','members','group','slug'));
    }

    public function detailPhotocard($photocard_id=null)
    {
        if($photocard_id!=null){
            $photord = MPhotocard::where('id','=',$photocard_id)->first();
            $trade="";
            if($photord!=null){
                $pic_front="";
                $pic_back="";
                if($photord->pic_hd!=null){
                    $pic_front=config('app.url')."/".config('app.str')."/".$photord->pic_hd;
                }else{
                    $pic_front=config('app.url')."/".config('app.str')."/".$photord->pic_front;
                }
                if($photord->pic_back!=null){
                    $pic_back=config('app.url')."/".config('app.str')."/".$photord->pic_back;
                }else{
                    $pic_back=config('app.url')."/".config('app.str')."/images/default_back.jpg";
                }
                $photocard_detail ="<div class='carousel-item active'>";
                $photocard_detail .= "<img class='img-fluid card-img-top' src='".$pic_front."' style='height: 100%;'>";
                $photocard_detail .="</div>";
                $photocard_detail .="<div class='carousel-item'>";
                $photocard_detail .= "<img class='img-fluid card-img-top' src='".$pic_back."' style='height: 100%;'>";
                $photocard_detail .="</div>";
                $info=$photord->credit;
                $wts ="<a href='#' onClick='Data.addPhotocard(".$photord->id.")' type='button' class='btn btn-info'><i class='fa fa-shopping-cart' aria-hidden='true'></i>&nbsp; WTS &nbsp; </a>&nbsp;&nbsp;";
                $wts .="<a href='#' onClick='Data.addPhotocardwtb(".$photord->id.")' type='button' class='btn btn-warning'><i class='feather mr-2 icon-camera'></i>WTB</a>&nbsp;&nbsp;<br>";
                // $trade ="<a href='#' onClick='Data.addPhotocardtrhave(".$photord->id.")' type='button' class='btn btn-success'><i class='fa fa-shopping-cart' aria-hidden='true'></i>&nbsp; Trade Have</a>&nbsp;&nbsp;";
                // $trade .="<a href='#' onClick='Data.addPhotocardtrwant(".$photord->id.")' type='button' class='btn btn-danger'><i class='feather mr-2 icon-camera'></i>Trade Want</a>&nbsp;&nbsp;";
            }else{
                $photocard_detail ="";
                $info="-";
                $wts="";
                $trade="";
            }
        }else{
            $photocard_detail ="";
            $info="-";
        }
        return response()->json(["photocard_detail"=>$photocard_detail,"info"=>$info,"wts"=>$wts,"trade"=>$trade]);
    }

    public function addToCart($id)
    {
        $photocard = MPhotocard::findOrFail($id);
        $channel = MChannel::findOrFail($photocard->channel_id);
        $album = MAlbum::findOrFail($photocard->album_id);
        $group = MGroup::findOrFail($photocard->group_id);
        $member = MMember::findOrFail($photocard->member_id);
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "group_id"=>$group->id,
                "group"=>$group->group_name,
                "channel"=>$channel->channel,
                "album_id"=>$album->id,
                "album"=>$album->album,
                "member_id"=>$member->id,
                "member"=>$member->member_name,
                "quantity" => 1,
                "id"=>$photocard->id,
                "name"=>$photocard->memberp->member_name,
                "pic_front" => $photocard->pic_front,
                "pic_back" => $photocard->pic_back
            ];
        }
        //$result = $cart.group((item) => item.type);
        // $group = array();
        // foreach ( $cart as $value ) {
        //     $group[$value['id']][] = $value;
        // }

        session()->put('cart', $cart);
        //dd(session('cart'));
        $countphoto=count((array) session('cart'));
        return response()->json(["countphoto"=>$countphoto]);
        //return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }

    public function removeall(Request $request)
    {
        $request->session()->forget('cart');
        session()->flash('success', 'Product removed successfully');
    }

    public function cart()
    {

        //session()->flush();
        //tambahkan pembuatan hastag
        // @foreach(session('cart') as $id => $details)
        $hastag=[];
        $album=[];
        $member=[];
        $group=[];
        $cart = session()->get('cart', []);
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
        foreach ($cart  as $key => $groups) {
            $group[$groups['group_id']]=[
                "group" => $groups['group']
            ];
        }
        $hastag=[
            "tipe" =>"#WTS",
            "photo" =>"#Photocard",
            "group" =>$group,
            "album" =>$album,
            "member"=>$member
        ];
        //dd($hastag);
        //return view('dreamcard.tphotocard');
        return view('dreamcard.tphotocard',compact('hastag'));
    }


    public function addToCartWtb($id)
    {
        $photocard = MPhotocard::findOrFail($id);

        $cart = session()->get('cartwtb', []);

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

        session()->put('cartwtb', $cart);
        $countphoto=count((array) session('cartwtb'));
        return response()->json(["countphoto"=>$countphoto]);
    }

    public function cartwtb()
    {
        return view('dreamcard.tphotocardwtb');
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
}
