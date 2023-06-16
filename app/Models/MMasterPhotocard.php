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

        public function mgroup()
        {
            return $this->hasOne(MGroup::class, 'id', 'group_id');
        }

        public function mchannel()
        {
            return $this->hasOne(MChannel::class, 'id', 'channel_id');
        }

        public function malbump()
        {
            return $this->hasOne(MAlbum::class, 'id', 'album_id');
        }
}
