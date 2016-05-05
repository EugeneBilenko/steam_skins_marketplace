<?php

namespace App\Models\User;

use App\MainModel;
use App\Models\User;

class Ticket extends MainModel
{
    protected $table = 'user_referrals';
    public $timestamps = true;
    protected $rules = [
        'user_id' => 'integer|required',
        'body' => 'string|required',
        'status' => 'string|required',
        'attachment' => 'string',
        'email' => 'string',
    ];

    protected $fillable = ['user_id','body','status', 'attachment', 'email'];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
