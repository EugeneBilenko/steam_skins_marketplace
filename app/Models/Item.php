<?php

namespace App\Models;

use App\MainModel;
use Mockery\CountValidator\Exception;

class Item extends MainModel
{
    protected $table = "items";
    public $timestamps = true;
    protected $rules = [
        'name' => 'string',
        'user_id' => 'integer|required',
        'bot_id' => 'integer',
        'full_items_base_id' => 'integer|required',
        'unique_steam_key' => 'string|required',
        'unique_item_attr' => 'string',
        'status' => 'string',
        'price' => 'integer',
    ];
    protected $fillable = [
        'name',
        'user_id',
        'bot_id',
        'full_items_base_id',
        'unique_steam_key',
        'unique_item_attr',
        'status',
        'price',
    ];

    public function user() {

        return $this->belongsTo(User::class);
    }

    public function bot() {

        return $this->belongsTo(Bot::class);
    }

    public function template() {

        return $this->belongsTo(FullItemsBase::class);
    }

    public function billing() {

        return $this->hasMany(Billing::class);
    }

    public function setOwner(User $user) {

//        if($this->inventoredCount($user) >= Option::getOption('inventory_size')) {
//            throw new Exception('to mach');
//            return;
//        }


//        clm($this->inventoredCount($user));
//        clm("\n");
//        clm(Option::getOption('inventory_size'));

        $this->user()->associate($user);
        $this->save();
    }

    public function inventoredCount($user){

        return $this->where('user_id', '=', $user->id)->count();
    }

    public function setBot(Bot $bot) {

//        clm($bot);
        $this->bot()->associate($bot);
        $this->save();
    }

    public function setTemplate(FullItemsBase $template) {

        $this->template()->associate($template);
        $this->save();
    }

    public function setPrice($price) {

        if(!is_integer($price)){
            return false;
        }

        $this->price = $price;
        $this->save();
    }
}
