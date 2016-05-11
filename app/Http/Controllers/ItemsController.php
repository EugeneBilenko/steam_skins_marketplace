<?php

namespace App\Http\Controllers;


use App\Models\Item;
use App\Models\User;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\FullItemsBase;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        return view('welcome');
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

    public function createItemsExamples() {
        $user = factory(User::class)->create();


        list($itemsExample, $itemsTemplatesExample) = $this->getExamplesData();
        foreach($itemsExample as $id => $item) {
            $oTemplate = new FullItemsBase();
            $oTemplate->market_price = 999;
            $result = $oTemplate->create($itemsTemplatesExample[$id]);
            $oItem = new Item();
            $oItem->user_id = $user->id;
            $oItem->full_items_base_id = $result->id;
            $oItem->unique_steam_key = $id . '_' . $oTemplate->classid . '_' . $oTemplate->instanceid;
            $oItem->save();
        }
    }

    public function getExamplesData() {

        $data = file_get_contents('http://steamcommunity.com/id/samalexcs/inventory/json/730/2');
        list($itemsExample, $itemsTemplatesExample) = $this->parseJson($data);

        return [$itemsExample, $itemsTemplatesExample];
    }

    public function parseJson($data) {

        $items = $itemsTemplates = [];
        $data = json_decode($data, true);
        if(json_last_error() !== JSON_ERROR_NONE) {
            throw new \Mockery\CountValidator\Exception('invalid json data');
        }
        $items = $data['rgInventory'];
        $itemsTemplates = [];
        foreach($items as $item) {
            $itemsTemplates[$item['id']] = $data['rgDescriptions'][$item['classid'] . '_' . $item['instanceid']];
            $itemsTemplates[$item['id']]['market_price'] = "999";
            $itemsTemplates[$item['id']]['actions'] = '';
            $itemsTemplates[$item['id']]['descriptions'] = '';
            $itemsTemplates[$item['id']]['market_actions'] = '';
            $itemsTemplates[$item['id']]['tags'] = '';

        }
        return [$items, $itemsTemplates];
    }

}