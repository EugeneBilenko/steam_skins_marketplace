<?php

namespace App\Http\Controllers;

use App\Models\Billing;
use App\Models\Item;
use Illuminate\Http\Request;

use App\Http\Requests;

class BillingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $billings = Billing::all();
        return view('billing.index', compact('billings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return $this->store($request, new Billing());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Billing $billing)
    {
//
//        $this->validate($request, [
//            'body' => 'required|unique:notes|min:3'
//        ]);
        dd($request->all());

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $billing = Billing::find($id);
        $items = Item::all();

        return view('billing.store', compact('billing', 'items'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Billing $billing){

        return view('notes.edit', compact('note'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  Billing $billing) {

        $billing->update($request->all());
//        $note->update(['body' => $request->body]);
        return back();

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Billing $billing)
    {


        $billing->delete();
        return back();
    }

}
