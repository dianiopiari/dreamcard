<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\MPhotocard;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Jenssegers\ImageHash\ImageHash;
use Jenssegers\ImageHash\Implementations\DifferenceHash;

class ProsesPhotoController extends Controller
{
    public function index(Content $content)
    {
        return Admin::content(function (Content $content) {
            // optional
            $content->header('Pencarian');
            // optional
            $content->description('pencarian photocard');
            // add breadcrumb since v1.5.7
            $content->breadcrumb(
                ['text' => 'Dashboard', 'url' => '/admin'],
                ['text' => 'User management', 'url' => '/admin/users'],
                ['text' => 'Edit user']
            );
            $html="<a href='".config('app.url')."/admin/proses' type='button' class='btn btn-info'><i class='fa fa-shopping-cart' aria-hidden='true'></i>&nbsp; Proses &nbsp; </a>&nbsp;&nbsp;";
            $content->body($html);
        });
    }

    public function proses()
    {
        // $path = config('app.str_adm')."\\"."images/Screenshot_3.jpg";
        // if(config('app.str_adm')!="production"){
        //     $path = str_replace("\\","/",$path );
        // }
        // return $path;

        $photocards = MPhotocard::limit(1);
        $hash ="";
        $path="";
        foreach ($photocards as $key => $photocard) {
            # code...
            $dataphoto = MPhotocard::findOrFail($photocard->id);
                $path = config('app.str_adm')."\\".$dataphoto->pic_front;
                if(config('app.str_adm')!="production"){
                    $path = str_replace("\\","/",$path );
                }
                if (file_exists($path)) {
                    $hasher = new ImageHash(new DifferenceHash());
                    $hash = $hasher->hash($path);
                    //dd($hash);
                    $dataphoto->update([
                        'hash_img'     => $hash->toBits()
                    ]);
                }
                //dd($path);
        }
        return "Berhasil ".$hash."- path ".$path;
    }
}
