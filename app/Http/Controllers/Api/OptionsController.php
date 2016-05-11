<?php

namespace App\Http\Controllers\Api;


use App\Http\Requests;
use App\Models\Option;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\ApiController;
use App\Advanced\Transformers\OptionTransformer;

class OptionsController extends ApiController
{

    protected $optionTransformer;

    public function __construct(OptionTransformer $optionTransformer) {

        $this->optionTransformer = $optionTransformer;
//        $this->middleware('auth.basic');
//        $this->middleware('auth.basic', ['only' => ['store', 'update']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //?limit=10&page=1
    public function index() {

        $limit = Input::get('limit') ? : 10;
        $options = Option::paginate($limit);
        return $this->respondWithPagination($options, $this->optionTransformer->transformCollection($options->items()));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return $this->respond(['key' => '', 'value' => '']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

//        dd($request->key);
//        if(! Input::get('key') || ! Input::get('value')) {
//            return $this->setStatusCode(422)->respondWithError('Validation Failed');
//        }

        $option = new  Option;
        $result = $option->createOption($request->toArray());
//        dd($result);
        if(method_exists($result, 'messages')) {

            return $this->setStatusCode(422)->respondWithError($result->messages());
        }

        return $this->respondCreated('Option Created');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {

        $option = Option::find($id);

        if(!$option) {
            return $this->setStatusCode(422)->respondWithError('Option does not exist');
        }
        return $this->respond([
            'data' => $this->optionTransformer->transform($option->toArray()),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getValue($key) {

        $option = Option::getOption($key);

        if(method_exists($option, 'messages')) {
            return $this->setStatusCode(422)->respondWithError($option->messages());
        }
        return $this->respond([
            'data' => $option,
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {

//        if(! Input::get('key') || ! Input::get('value')) {
//            return $this->setStatusCode(422)->respondWithError('Validation Failed');
//        }

        $option = Option::find($id);
        if(!$option) {
            return $this->setStatusCode(422)->respondWithError('Option does not found');
        }
//        dd($option);
        $option->key = Input::get('key');
        $option->value = Input::get('value');
        $option->save();

//        dd($option->errors());

        if($option->errors()) {
            return $this->setStatusCode(422)->respondWithError($option->errors()->toArray());
        }

        return $this->respondCreated('Option Updated');

    }

    public function updateValue($key) {

//        if(! Input::get('key') || ! Input::get('value')) {
//            return $this->setStatusCode(422)->respondWithError('Validation Failed');
//        }
        $option = new Option;

        $result = $option->setOption($key, Input::get('value'));

        if(method_exists($result, 'messages')) {
            return $this->setStatusCode(422)->respondWithError($result->messages());
        }

//        if(!$option) {
//            return $this->respondInternalError('Option does not found');
//        }

        return $this->respondCreated('Option Updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $option = Option::find($id);
        if(!$option) {
            return $this->setStatusCode(422)->respondWithError('Option does not found');
        }
        $option->delete();
        return $this->respondCreated('Option Deleted');
    }
}
