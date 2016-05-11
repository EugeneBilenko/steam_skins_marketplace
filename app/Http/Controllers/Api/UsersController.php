<?php

namespace App\Http\Controllers\Api;

use App\Advanced\Transformers\BillingTransformer;
use App\Advanced\Transformers\UserTransformer;
use App\Http\Controllers\ApiController;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class UsersController extends ApiController
{
    protected $userTransformer;

    public function __construct(UserTransformer $userTransformer) {

        $this->userTransformer = $userTransformer;
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
        $user = User::paginate($limit);

        return $this->respondWithPagination($user, $this->userTransformer->transformCollection($user->items()));

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
        $user = new  User;
        $user->save($request);
        if($user->errors()) {
            return $this->setStatusCode(422)->respondWithError($user->errors()->toArray());
        }

        return $this->respondCreated('User Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {

        $user = User::find($id);

        if(!$user) {
            return $this->setStatusCode(422)->respondWithError('User does not exist');
        }

        return $this->respond([
            'data' => $this->userTransformer->transform($user->toArray()),
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

        $user = User::find($id);
        if(!$user) {
            return $this->setStatusCode(422)->respondWithError('User does not found');
        }

        $user->save($request);
        if($user->errors()) {
            return $this->setStatusCode(422)->respondWithError($user->errors()->toArray());
        }

        return $this->respondCreated('User Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $user = User::find($id);
        if(!$user) {
            return $this->setStatusCode(422)->respondWithError('User does not found');
        }
        $user->delete();
        return $this->respondCreated('User Deleted');
    }
}
