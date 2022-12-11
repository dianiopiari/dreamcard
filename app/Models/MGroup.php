<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MGroup extends Model
{
      //
      protected $table = "m_group";
      protected $fillable = [
          'id',
          'group_name',
          'logo',
          'created_at',
          'updated_at'
      ];
}
