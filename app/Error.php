<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Error extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'order', 'description', 'amount'
    ];
}
