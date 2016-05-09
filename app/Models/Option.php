<?php

namespace App\Models;

use App\MainModel;
use Illuminate\Support\Facades\Config;
use Mockery\CountValidator\Exception;

class Option extends MainModel {

    protected $table = "options";
    public $timestamps = true;
    protected $rules = [
        'key' => 'string|unique:options|required|max:255',
        'value' => 'required'
    ];
    protected $fillable = ['key','value'];

    public function setOption(array $params = []) {

        return parent::firstOrCreate($params);
    }

    public static function getOption($key) {

        if(empty($key) || !is_string($key)) {

            throw new Exception('\Exception');
        }

        $result = self::where('key' , '=', $key)->first();
        if(isset($result->value)){
            return $result->value;
        }
        return false;
    }

//    public static function getOptions($key) {
//
//        if(empty($key) || !is_string($key)) {
//
//            throw new Exception('\Exception');
//        }
//
//        $result = self::where('key' , '=', $key)->first();
//        if(isset($result->value)){
//            return $result->value;
//        }
//        return false;
//    }

    public function removeOption($key) {

        if(empty($key) || !is_string($key)) {
            throw new Exception('\Exception');
        }
        self::where('key' , '=', $key)->delete();
    }

    public static function resetOptions() {

        self::truncate();
        self::setDefaultOptions();
    }

    private static function setDefaultOptions() {

        $defaults = [];
        $config = Config::get('options')['default'];
        foreach($config as $key => $value) {
            $defaults[] = [
                'key' => $key,
                'value' => $value
            ];
        }
        self::insert($defaults);
    }

    public function scopeListOptions($query, $take = 10, $skip = 0) {

        return $query->take($take)->skip($skip)->get();
    }

}
