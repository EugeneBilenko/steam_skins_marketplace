<?php

namespace App\Models;

use App\Models\User\Credit;
use App\Models\User\Transaction;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;

//use Illuminate\Validation\Validator;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $timestamps = true;
    protected static $rules = [
        'name' => 'string|required',
        'email' => 'string|required',
        'password' => 'string|required',
        'role' => 'string|required',
        'rankXP' => 'integer',
        'referral_code' => 'string',
        'api_key' => 'string',
        'steam_account_id' => 'integer|unique:users,steam_account_id,id',
        'remember_token' => 'string',
    ];

    public static $errors;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'rankXP',
        'referral_code',
        'api_key',
        'steam_account_id',
        'remember_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function validate($data) {

//        clm($data);

        // make a new validator object
        $v = Validator::make($data, self::$rules);
        // check for failure
        if ($v->fails()) {
            // set errors and return false
            self::$errors = $v->errors();
            return false;
        }
        // validation pass

        return true;
    }

    public static function errors() {
        return self::$errors;
    }

    public static function getRules() {
        return static::$rules;
    }

    public static function create(array $params = []) {

        if (static::validate($params)) {
            return parent::create($params);
        } else {
            return self::errors();
        }
    }

    public function firstOrCreate(array $params) {

        if (self::validate($params)) {
            return parent::firstOrCreate($params);
        } else {
            return self::errors();
        }
    }

    public function save(array $params = []) {

        if (self::validate(self::getAttributes())) {
            return parent::save();
        } else {
            return self::errors();
        }
    }

    //relations

    public function steamAccount() {

        return $this->belongsTo(SteamAccount::class);
    }

    public function items() {

        return $this->hasMany(Item::class);
    }

    public function credit() {

        return $this->hasOne(Credit::class);
    }

    public function getCreditsBalance() {

        return $this->credit()->getResults()->credits;
    }

    public function addCredits($value) {
        $this->credit()->increment('credits', $value);
    }

    public function takeCredits($value) {
        $this->credit()->decrement('credits', $value);
    }

    public function makeTransaction(Transaction $transaction) {

        if($transaction->action == 'buy') {
            $this->addCredits($transaction->credits);
        }elseif($transaction->action == 'cashout') {
            $this->takeCredits($transaction->credits);
        }
    }

    public function getRank() {

        $xp = $this->rankXP;
        $need = Option::getOption('first_rank') ? : Config::get('options')['default']['first_rank']; //first level
        $coefficient = Option::getOption('coefficient') ? : Config::get('options')['default']['coefficient']; // customizable progression
        for( $rank = 1;  $need <= $xp; $rank++ ){
            $need = $need + $need*$coefficient;
        }
        return $rank;
    }

    public function addRankXP($xp) {
        $this->increment('rankXP', $xp);
    }

    public function takeRankXP($xp) {
        $this->decrement('rankXP', $xp);
    }

}