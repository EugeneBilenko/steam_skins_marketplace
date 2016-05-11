<?php

namespace App\Http\Controllers\Api;

use App\Advanced\Transformers\SteamAccountTransformer;
use App\Http\Controllers\ApiController;
use App\Models\SteamAccount;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class SteamAccountsController extends ApiController
{
    protected $billingsTransformer;

    public function __construct(SteamAccountTransformer $steamAccountTransformer) {

        $this->steamAccountTransformer = $steamAccountTransformer;
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
        $steamAccounts = SteamAccount::paginate($limit);
        return $this->respondWithPagination($steamAccounts, $this->steamAccountTransformer->transformCollection($steamAccounts->items()));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $steamAccount = new  SteamAccount;
        $steamAccount->save($request);
        if($steamAccount->errors()) {
            return $this->setStatusCode(422)->respondWithError($steamAccount->errors()->toArray());
        }

        return $this->respondCreated('SteamAccount Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {

        $steamAccount = SteamAccount::find($id);

        if(!$steamAccount) {
            return $this->setStatusCode(422)->respondWithError('SteamAccount does not exist');
        }

        return $this->respond([
            'data' => $this->steamAccountTransformer->transform($steamAccount->toArray()),
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

        $steamAccount = SteamAccount::find($id);
        if(!$steamAccount) {
            return $this->setStatusCode(422)->respondWithError('SteamAccount does not found');
        }

        $steamAccount->save($request);
        if($steamAccount->errors()) {
            return $this->setStatusCode(422)->respondWithError($steamAccount->errors()->toArray());
        }

        return $this->respondCreated('SteamAccount Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $steamAccount = SteamAccount::find($id);
        if(!$steamAccount) {
            return $this->setStatusCode(422)->respondWithError('SteamAccount does not found');
        }
        $steamAccount->delete();
        return $this->respondCreated('SteamAccount Deleted');
    }
}
