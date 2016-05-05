<?php
if (!function_exists('pp')) {

    function pp($data) {

        echo "<pre>";print_r($data);echo '</pre>';
    }

}
if (!function_exists('clm')) {

    function clm($result) {

//        if(is_object($result) && method_exists($result,'messages') && !empty($result->messages())){
//                fwrite(STDERR, print_r($result->messages(), true ));
                fwrite(STDERR, print_r($result, true ));
//        }
    }

}