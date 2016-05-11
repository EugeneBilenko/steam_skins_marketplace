<?php

namespace App\Http\Controllers\Api;

use App\Advanced\Transformers\FullItemsBaseTransformer;
use App\Http\Controllers\ApiController;
use App\Models\FullItemsBase;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class FullItemsBaseController extends ApiController
{
    protected $fullItemsBaseTransformer;

    public function __construct(FullItemsBaseTransformer $fullItemsBaseTransformer) {

        $this->fullItemsBaseTransformer = $fullItemsBaseTransformer;
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
        $fullItemsBase = FullItemsBase::paginate($limit);
        return $this->respondWithPagination($fullItemsBase, $this->fullItemsBaseTransformer->transformCollection($fullItemsBase->items()));

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
        $fullItem = new  FullItemsBase();
        $fullItem->save($request);
        if($fullItem->errors()) {
            return $this->setStatusCode(422)->respondWithError($fullItem->errors()->toArray());
        }

        return $this->respondCreated('Full Item Record Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {

        $fullItem = FullItemsBase::find($id);

        if(!$fullItem) {
            return $this->setStatusCode(422)->respondWithError('Full Item Record does not exist');
        }

        return $this->respond([
            'data' => $this->fullItemsBaseTransformer->transform($fullItem->toArray()),
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
        $fullItem = FullItemsBase::find($id);
        if(!$fullItem) {
            return $this->setStatusCode(422)->respondWithError('Full Item Record does not found');
        }

        $fullItem->save();
        if($fullItem->errors()) {
            return $this->setStatusCode(422)->respondWithError($fullItem->errors()->toArray());
        }

        return $this->respondCreated('Full Item Record Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $fullItem = FullItemsBase::find($id);
        if(!$fullItem) {
            return $this->setStatusCode(422)->respondWithError('Full Item Record does not found');
        }
        $fullItem->delete();
        return $this->respondCreated('Full Item Record Deleted');
    }
}
