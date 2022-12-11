<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MChannel extends Model
{
      //
      protected $table = "m_channel";
      protected $fillable = [
          'id',
          'channel',
          'photo',
          'keterangan',
          'kategori_id',
          'created_at',
          'updated_at'
      ];
}
