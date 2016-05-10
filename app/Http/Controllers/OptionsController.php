<?php

namespace App\Http\Controllers;

use App\Models\Option;
use Illuminate\Http\Request;

use App\Http\Requests;

use  App\Advanced\Transformers\OptionTransformer;

//use Illuminate\Http\Request;

//use App\Http\Requests;
//use Symfony\Component\HttpFoundation\Response;

//use Illuminate\Http\Response;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;

class OptionsController extends ApiController
{

    protected $optionTransformer;

    public function __construct(OptionTransformer $optionTransformer){

        $this->optionTransformer = $optionTransformer;
//        $this->middleware('auth.basic');
//        $this->middleware('auth.basic', ['only' => ['store', 'store']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //?limit=10&page=1
    public function index()
    {

        $limit = Input::get('limit') ? : 10;
        $options = Option::paginate($limit);
        return $this->respondWithPagination($options, $this->optionTransformer->transformCollection($options->items()));

//        $allOptions = Option::listOptions();
//        return json_encode(['access' => 'true', 'options' => $allOptions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return json_encode(['access' => 'true', 'key' => '', 'value' => '']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(! Input::get('key') || ! Input::get('value')){
            return $this->setStatusCode(422)->respondWithError('Validation Failed');
        }

//        Lesson::create(Input::all());
//
//        return $this->respondCreated('Lesson Created');

        $option = new  Option;
        $result = $option->createOption($request->toArray());
//        $result = $option->setOption($request->toArray());
//        dd($result);
        if(method_exists($result, 'messages')){

//            $result = $result->errors();
            return $this->setStatusCode(422)->respondWithError($result->messages());
        }

        return $this->respondCreated('Option Created');
//        return json_encode(['access' => 'true', 'result' => $result]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $option = Option::find($id);
        if(!$option){
            return $this->respondNotFound('Option does not exist');
        }
        return $this->respond([
            'data' => $this->optionTransformer->transform($option->toArray()),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        if(! Input::get('key') || ! Input::get('value')){
            return $this->setStatusCode(422)->respondWithError('Validation Failed');
        }
        $option = new Option;

        $result = $option->setOption($request->toArray()['key'], $request->toArray()['value']);

        if(method_exists($result, 'messages')){
            return $this->setStatusCode(422)->respondWithError($result->messages());
        }

        if(!$option){
            return $this->respondNotFound('Option does not found');
        }



        return $this->respondCreated('Option Updated');

//        $result = Option::setOption($request);
//        if($result->errors()){
////            $result = $result->errors();
//            return $this->setStatusCode(422)->respondWithError($result->errors());
//        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
