<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MAlbum extends Model
{
      //
      protected $table = "m_album";
      protected $fillable = [
          'id',
          'group_id',
          'album',
          'tahun',
          'photo',
          'order',
          'created_at',
          'updated_at'
      ];

      public function groupk()
    {
        return $this->hasOne(MGroup::class, 'id', 'group_id');
    }

    public function listversi()
    {
        //$app_root = env('APP_ROUTE', '/uploads');
        return $this->hasMany(MChannel::class,'album_id')
        ->select('id','channel','keterangan',
            DB::raw("if(kategori_id=0,'Album Inclusions', if(kategori_id=1,'pob','cc')) as kategori_id")
        );
    }

    public function versichannel()
    {
        return $this->hasMany(MChannel::class, 'album_id');
    }

}
