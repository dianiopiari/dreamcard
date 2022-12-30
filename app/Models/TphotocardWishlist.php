<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TphotocardWishlist extends Model
{
      //
      protected $table = "t_photocard_whislist";
      protected $fillable = [
          'id',
          'photocard_id',
          'user_id',
          'created_at',
          'updated_at'
      ];
}
