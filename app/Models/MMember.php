<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MMember extends Model
{
      //
      protected $table = "m_member";
      protected $fillable = [
          'id',
          'group_id',
          'member_name',
          'photo',
          'position',
          'slug',
          'created_at',
          'updated_at'
      ];

      public function groupm()
      {
          return $this->hasOne(MGroup::class, 'id', 'group_id');
      }
}
