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
                $logo = $group->logo;
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
                        'logo'          => $logo,
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
}
