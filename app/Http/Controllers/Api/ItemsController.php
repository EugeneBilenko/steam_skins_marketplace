<?php

namespace App\Http\Controllers\Api;

use App\Advanced\Transformers\ItemTransformer;
use App\Http\Controllers\ApiController;
use App\Models\Item;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ItemsController extends ApiController
{
    protected $itemTransformer;

    public function __construct(ItemTransformer $itemTransformer) {

        $this->itemTransformer = $itemTransformer;
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
        $itemsBase = Item::paginate($limit);
        return $this->respondWithPagination($itemsBase, $this->itemTransformer->transformCollection($itemsBase->items()));

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
        $item = new  Item();
        $item->save($request);
        if($item->errors()) {
            return $this->setStatusCode(422)->respondWithError($item->errors()->toArray());
        }

        return $this->respondCreated('Item Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {

        $item = Item::find($id);

        if(!$item) {
            return $this->setStatusCode(422)->respondWithError('Item does not exist');
        }

        return $this->respond([
            'data' => $this->itemTransformer->transform($item->toArray()),
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
        $item = Item::find($id);
        if(!$item) {
            return $this->setStatusCode(422)->respondWithError('Item does not found');
        }

        $item->save();
        if($item->errors()) {
            return $this->setStatusCode(422)->respondWithError($item->errors()->toArray());
        }

        return $this->respondCreated('Item Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $item = Item::find($id);
        if(!$item) {
            return $this->setStatusCode(422)->respondWithError('Item does not found');
        }
        $item->delete();
        return $this->respondCreated('Item Deleted');
    }
}
