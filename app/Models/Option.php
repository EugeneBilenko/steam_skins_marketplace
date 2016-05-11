<?php

namespace App\Models;

use App\MainModel;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\MessageBag;
use Mockery\CountValidator\Exception;

class Option extends MainModel {

    protected $table = "options";
    public $timestamps = true;
    protected $rules = [
        'key' => 'string|unique:options,id|required|max:255',
        'value' => 'required'
    ];

    protected $fillable = ['key','value'];

    public static function setOption($key, $value) {
        $option = self::where('key' ,'=', $key)->first();
        if($option) {
           return $option->update(['value'=>$value]);
        }

        self::$errors = self::$bag->add('error', 'Option not found');
        return self::errors();
    }

    public function createOption(array $params = []) {

        return parent::create($params);
    }

    public static function getOption($key) {

        if(empty($key) || !is_string($key)) {

            self::$errors = self::$bag->add('error', 'Invalid Key');
            return self::errors();
        }

        $result = self::where('key' , '=', $key)->first();
        if(isset($result->value)){
            return $result->value;
        }

        self::$errors = self::$bag->add('error', 'Option not found');
        return self::errors();

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
