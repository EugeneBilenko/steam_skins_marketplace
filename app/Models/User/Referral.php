<?php

namespace App\Models\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
    protected $table = 'user_referrals';
    public $timestamps = true;
    protected $rules = [
        'user_id' => 'integer|required',
        'referral_id' => 'integer|required',
    ];

    protected $fillable = ['user_id','referral_id'];


    public function codeOwner() {

        return $this->belongsTo(User::class);
    }

    public function codeUsedBy() {

        return $this->belongsTo(User::class);
    }

}
