<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MAlbum;
use App\Models\MChannel;
use App\Models\MGroup;
use App\Models\MMember;
use App\Models\MPhotocard;
use App\Models\TPhotocard;
use App\Models\TphotocardWishlist;
use Illuminate\Support\Facades\DB;
use Jenssegers\ImageHash\ImageHash;
use Jenssegers\ImageHash\Implementations\DifferenceHash;
use PhpParser\Node\Stmt\Foreach_;


class DreamController extends Controller
{
    public function listPerGroup($slug)
    {

        try {

            $group= MGroup::where('slug','=',$slug)->first();
            if($group!=null){
                $members = MMember::where('group_id','=',$group->id)->get();
                $albums = MAlbum::where('group_id','=',$group->id)->where('tipe','=',0)->orderBy('order','desc')->get();
                $albumsThum = MAlbum::join('m_photocard','m_photocard.album_id','=','m_album.id')
                                ->select('m_album.id','m_album.slug','m_album.photo','m_album.album','m_album.tahun',DB::raw('COUNT(m_photocard.id) as jumlah_phoca'))
                                ->where('m_album.group_id','=',$group->id)
                                ->where('m_album.tipe','=',0)
                                ->groupBy('m_album.id','m_album.slug','m_album.photo','m_album.album','m_album.tahun')
                                ->orderBy('m_album.order','desc')
                                ->get();
                $MdThums = MAlbum::join('m_photocard','m_photocard.album_id','=','m_album.id')
                                ->select('m_album.id','m_album.slug','m_album.photo','m_album.album','m_album.tahun',DB::raw('COUNT(m_photocard.id) as jumlah_phoca'))
                                ->where('m_album.group_id','=',$group->id)
                                ->where('m_album.tipe','=',1)
                                ->groupBy('m_album.id','m_album.slug','m_album.photo','m_album.album','m_album.tahun')
                                ->orderBy('m_album.order','desc')
                                ->get();

                $response   = [
                    'success'   => true,
                    'status'    => 'success',
                    'message'   => 'The request was successful',
                    'code'      => 200,
                    'result'    => [
                        'groupDetail'   => $group,
                        'members'       => $members,
                        'albums'        => $albums,
                        'albumsThum'    => $albumsThum,
                        'mdThums'       => $MdThums,
                    ]
                ];
            }else{
                $response = [
                    'success'  => false,
                    'status'    => 'error',
                    'message'   => 'Group not found.',
                    'code'      => 500
                ]; 
            }
            
        
        } catch (Exception $e) {
            $response = [
                'success'  => false,
                'status'    => 'error',
                'message'   => $e->getMessage(),
                'code'      => 500
            ]; 
        }

        return response()->json($response);
    }

    public function listMember($group_slug,$slug,$cek=null)
    {
        try {
            $group= MGroup::where('slug','=',$group_slug)->first();
            $member = MMember::where('slug','=',$slug)->first();
            if($group!=null){
                $albums = MAlbum::where('group_id','=',$group->id)->where('tipe','=',0)->orderBy('order','desc')->get();
                $MdThums = MAlbum::where('group_id','=',$group->id)->where('tipe','=',1)->orderBy('order','desc')->get();
                $allalbums = MAlbum::where('m_album.group_id','=',$group->id)
                            ->select("m_album.*")
                            ->join('m_photocard','m_photocard.album_id','=','m_album.id')
                            ->where('m_photocard.member_id','=',$member->id)
                            ->orderBy('order','desc')
                            ->distinct()
                            ->get();
                foreach ($allalbums as $key => $album) {
                    $photocards = MPhotocard::join('m_channel','m_channel.id','=','m_photocard.channel_id')
                                ->select("m_photocard.*")
                                ->where('m_photocard.group_id','=',$group->id)
                                ->where('m_photocard.album_id','=',$album->id)
                                ->where('m_photocard.member_id','=',$member->id)->count();
                    $allalbums['count'] = $photocards;
                }
                //cek dengan koleksi
                // $myphotocards=array();
                // if(@auth('web')->user()->id!=0){
                //     if($cek!=null){
                //         $myphotocard = TPhotocard::join('m_photocard','m_photocard.id','=','t_photocard.photocard_id')
                //                                 ->join('m_channel','m_photocard.channel_id','=','m_channel.id')
                //                                 ->join('m_album','m_photocard.album_id','=','m_album.id')
                //                                 ->join('m_member','m_photocard.member_id','=','m_member.id')
                //                                 ->join('m_group','m_photocard.group_id','=','m_group.id')
                //                                         ->select('m_photocard.id')
                //                                         ->where('t_photocard.user_id','=',@auth('web')->user()->id)->get();
                //         foreach ($myphotocard as $key => $value) {
                //             $myphotocards[]= $value->id;
                //         }
                //     }
                // }

                // //menampilkan sesuai dengan masterdata
                // $vipot_columns=[];
                // foreach ($allalbums as $key => $album) {
                //     $channels = MChannel::where('m_channel.album_id','=',$album->id)
                //                         ->where('m_photocard.member_id','=',$member->id)
                //                         ->select('kategori_id',DB::raw('if(kategori_id=0,"Album Inclusions",if(kategori_id=1,"Fansign/POB","Other Photocard")) as channel'))
                //                         ->join('m_photocard','m_photocard.channel_id','=','m_channel.id')
                //                         ->groupBy('m_channel.kategori_id')->get();
                //     $vipot_cat_photo=[];
                //     foreach ($channels as $keyc => $channel) {
                //         $photocards = MPhotocard::join('m_channel','m_channel.id','=','m_photocard.channel_id')
                //                 ->select("m_photocard.*")
                //                 ->where('m_photocard.group_id','=',$group->id)
                //                 ->where('m_photocard.album_id','=',$album->id)
                //                 ->where('m_channel.kategori_id','=',$channel->kategori_id)
                //                 ->where('m_photocard.member_id','=',$member->id)->get();
                //                 $vipot_cat_photo[$keyc]=[
                //                     "cat" => $channel,
                //                     "photo"=>  $photocards
                //                 ];
                //     }
                //     $vipot_columns[$key] = [
                //         'album'=> $album->album,
                //         'photo'=>$vipot_cat_photo
                //     ];
                // }

                $response   = [
                    'success'   => true,
                    'status'    => 'success',
                    'message'   => 'The request was successful',
                    'code'      => 200,
                    'result'    => [
                        'groupMember'   => $group,
                        'memberData'    => $member,
                        'allAlbumsThum' => $allalbums,
                    ]
                ];
            }else{
                $response = [
                    'success'  => false,
                    'status'    => 'error',
                    'message'   => $e->getMessage(),
                    'code'      => 500
                ]; 
            }
            // $countphoto=0;
            // $countphotowhistlist=0;
            // if(@auth('web')->user()->id!=0){
            //     $countphoto = TPhotocard::where('user_id','=',auth('web')->user()->id)->count();
            //     $countphotowhistlist = TphotocardWishlist::where('user_id','=',auth('web')->user()->id)->count();
            // }
            
        } catch (Exception $e) {
            $response = [
                'success'  => false,
                'status'    => 'error',
                'message'   => $e->getMessage(),
                'code'      => 500
            ]; 
        }

        return response()->json($response);
    }
}
