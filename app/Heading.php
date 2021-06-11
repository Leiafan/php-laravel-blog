<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Heading extends Model
{

    public $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function articles () {
        return $this->belongsToMany('App/Article');
    }
}
