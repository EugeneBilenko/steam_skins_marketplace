<?php

namespace App\Models;

use App\MainModel;


class Billing extends MainModel
{
    protected $table = "billings";
    public $timestamps = true;
    protected $rules = [
        'user_id' => 'integer|required',
        'status' => 'string|required',
        'item_id' => 'integer|required',

    ];

    protected $fillable = ['user_id','status','item_id'];

    public function item() {

        return $this->belongsTo(Item::class);
    }
}