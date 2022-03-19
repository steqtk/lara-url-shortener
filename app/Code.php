<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    protected $fillable = ['code', 'active'];

    public function link()
    {
        return $this->hasOne(Link::class);
    }
}
