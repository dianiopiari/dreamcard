<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MPhotocard extends Model
{
      //
      protected $table = "m_photocard";
      protected $fillable = [
          'id',
          'group_id',
          'member_id',
          'channel_id',
          'album_id',
          'pic_front',
          'pic_back',
          'pic_hd',
          'credit',
          'created_at',
          'updated_at'
      ];

      public function groupp()
      {
          return $this->hasOne(MGroup::class, 'id', 'group_id');
      }

      public function memberp()
      {
          return $this->hasOne(MMember::class, 'id', 'member_id');
      }

      public function channelp()
      {
          return $this->hasOne(MChannel::class, 'id', 'channel_id');
      }
}
