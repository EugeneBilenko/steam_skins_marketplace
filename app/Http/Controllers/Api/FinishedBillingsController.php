<?php

namespace App\Http\Controllers\Api;

use App\Advanced\Transformers\FinishedBillingTransformer;
use App\Http\Controllers\ApiController;
use App\Models\FinishedBillings;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class FinishedBillingsController extends ApiController
{

    protected $finishedBillingTransformer;

    public function __construct(FinishedBillingTransformer $finishedBillingTransformer) {

        $this->finishedBillingTransformer = $finishedBillingTransformer;
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
        $fBillings = FinishedBillings::paginate($limit);
        return $this->respondWithPagination($fBillings, $this->finishedBillingTransformer->transformCollection($fBillings->items()));

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
        $fBilling = new  FinishedBillings();
        $fBilling->save($request);
        if($fBilling->errors()) {
            return $this->setStatusCode(422)->respondWithError($fBilling->errors()->toArray());
        }

        return $this->respondCreated('Finished Billing Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {

        $fBilling = FinishedBillings::find($id);

        if(!$fBilling) {
            return $this->setStatusCode(422)->respondWithError('Finished Billing does not exist');
        }

        return $this->respond([
            'data' => $this->finishedBillingTransformer->transform($fBilling->toArray()),
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
        $fBilling = FinishedBillings::find($id);
        if(!$fBilling) {
            return $this->setStatusCode(422)->respondWithError('Finished Billing does not found');
        }

        $fBilling->save();
        if($fBilling->errors()) {
            return $this->setStatusCode(422)->respondWithError($fBilling->errors()->toArray());
        }

        return $this->respondCreated('Finished Billing Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $fBilling = FinishedBillings::find($id);
        if(!$fBilling) {
            return $this->setStatusCode(422)->respondWithError('Finished Billing does not found');
        }
        $fBilling->delete();
        return $this->respondCreated('Finished Billing Deleted');
    }
}
