<?php

namespace App\Http\Controllers\Api;

use App\Advanced\Transformers\BillingTransformer;
use App\Http\Controllers\ApiController;
use App\Models\Billing;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;


class BillingsController extends ApiController
{
    protected $billingsTransformer;

    public function __construct(BillingTransformer $billingsTransformer) {

        $this->billingsTransformer = $billingsTransformer;
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
        $billings = Billing::paginate($limit);
        return $this->respondWithPagination($billings, $this->billingsTransformer->transformCollection($billings->items()));

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
        $billing = new  Billing;
        $billing->save($request);
        if($billing->errors()) {
            return $this->setStatusCode(422)->respondWithError($billing->errors()->toArray());
        }

        return $this->respondCreated('Billing Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {

        $billing = Billing::find($id);

        if(!$billing) {
            return $this->setStatusCode(422)->respondWithError('Billing does not exist');
        }

        return $this->respond([
            'data' => $this->billingsTransformer->transform($billing->toArray()),
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

        $billing = Billing::find($id);
        if(!$billing) {
            return $this->setStatusCode(422)->respondWithError('Billing does not found');
        }

        $billing->save($request);
        if($billing->errors()) {
            return $this->setStatusCode(422)->respondWithError($billing->errors()->toArray());
        }

        return $this->respondCreated('Billing Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $billing = Billing::find($id);
        if(!$billing) {
            return $this->setStatusCode(422)->respondWithError('Billing does not found');
        }
        $billing->delete();
        return $this->respondCreated('Billing Deleted');
    }
}
