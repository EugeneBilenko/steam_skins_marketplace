<?php

namespace App\Models\User;

use App\MainModel;
use App\Models\User;

class Credit extends MainModel
{
    protected $table = 'user_credits';
    protected $rules = [
        'user_id' => 'integer|unique:user_credits|required',
        'credits' => 'integer'
    ];

    protected $fillable = ['user_id','credits'];

    public $timestamps = true;

    public function user() {

        return $this->belongsTo(User::class);
    }
}