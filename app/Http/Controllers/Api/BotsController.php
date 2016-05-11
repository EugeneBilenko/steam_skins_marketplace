<?php

namespace App\Http\Controllers\Api;

use App\Advanced\Transformers\BotTransformer;
use App\Http\Controllers\ApiController;
use App\Models\Bot;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class BotsController extends ApiController
{
    protected $botTransformer;

    public function __construct(BotTransformer $botTransformer) {

        $this->botTransformer = $botTransformer;
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
        $bots = Bot::paginate($limit);
        return $this->respondWithPagination($bots, $this->botTransformer->transformCollection($bots->items()));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $bot = new  Bot;
        $bot->save($request);
        if($bot->errors()) {
            return $this->setStatusCode(422)->respondWithError($bot->errors()->toArray());
        }

        return $this->respondCreated('Bot Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $bot = Bot::find($id);

        if(!$bot) {
            return $this->setStatusCode(422)->respondWithError('Bot does not exist');
        }

        return $this->respond([
            'data' => $this->botTransformer->transform($bot->toArray()),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {

        $bot = Bot::find($id);
        if(!$bot) {
            return $this->setStatusCode(422)->respondWithError('Bot does not found');
        }

        $bot->save();
        if($bot->errors()) {
            return $this->setStatusCode(422)->respondWithError($bot->errors()->toArray());
        }

        return $this->respondCreated('Bot Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $bot = Bot::find($id);
        if(!$bot) {
            return $this->setStatusCode(422)->respondWithError('Bot does not found');
        }
        $bot->delete();
        return $this->respondCreated('Bot Deleted');
    }
}
