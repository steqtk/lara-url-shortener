<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $fillable = ['url', 'code_id'];

    public function code()
    {
        return $this->hasOne(Code::class, 'id');
    }
}
