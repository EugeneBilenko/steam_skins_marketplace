<?php

namespace App\Models\User;

use App\MainModel;
use App\Models\User;

class Transaction extends MainModel
{
    protected $table = "user_transactions";
    public $timestamps = true;
    protected $rules = [
        'user_id' => 'integer|required',
        'action' => 'string|required',
        'credits' => 'integer|required',
        'money' => 'integer',//required

    ];

    protected $fillable = ['user_id','action','credits', 'money'];


    public function user() {
        return $this->belongsTo(User::class);
    }
}