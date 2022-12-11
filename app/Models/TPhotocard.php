<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TPhotocard extends Model
{
      //
      protected $table = "t_photocard";
      protected $fillable = [
          'id',
          'photocard_id',
          'user_id',
          'STATUS',
          'created_at',
          'updated_at'
      ];
}
