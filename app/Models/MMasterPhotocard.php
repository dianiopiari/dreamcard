<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MMasterPhotocard extends Model
{
      //
      protected $table = "m_photocard_master";
      protected $fillable = [
          'id',
          'group_id',
          'channel_id',
          'album_id',
          'created_at',
          'updated_at',
          'credit'
      ];

      public function photocards()
        {
            return $this->hasMany(MPhotocard::class, 'master_id');
        }
}
