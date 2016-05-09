<?php

namespace Datase\Factories\Help;

use App\Models\User;

class ItemsExtract {

    public static $itemsExample;
    public static $itemsTemplatesExample;
    public static $offset = 0;

    public static function getExamplesData() {
        $data = file_get_contents('itemsExample.json');
        list(self::$itemsExample, self::$itemsTemplatesExample) = self::parseJson($data);
        return ['items' => self::$itemsExample, 'templates' => self::$itemsTemplatesExample];
    }

    public static function parseJson($data) {

        $items = $itemsTemplates = [];
        $data = json_decode($data, true);
        if(json_last_error() !== JSON_ERROR_NONE){
            throw new \Mockery\CountValidator\Exception('invalid json data');
        }
        $items = $data['rgInventory'];
        $itemsTemplates = [];
        foreach($items as $item){
            $itemsTemplates[$item['id']] = $data['rgDescriptions'][$item['classid'] . '_' . $item['instanceid']];
        }
        return [$items, $itemsTemplates];
    }

    public static function createExamples(User $user, $count = 1, $offset = 0) {

        self::getExamplesData();
        $numberForOffset = $numberForCount =0;
//        if(self::$offset > $offset){
//            $offset = self::$offset;
//        }
        $aoItems = [];
        foreach(self::$itemsExample as $id => $item) {
            if ($numberForOffset <  $offset) {
                $numberForOffset++;
                continue;
            }
            if($numberForCount < $count){

                $oItem = new \App\Models\Item();
                $oItemTemplate = \App\Models\FullItemsBase::create(self::$itemsTemplatesExample[$id]);
                $oItem->user_id = $user->id;
                $oItem->full_items_base_id = $oItemTemplate->id;
                $oItem->unique_steam_key = $item['id'] . "_" . $item['classid'] . "_" . $item['instanceid'];
                $oItem->inventory_position = $item->pos;
                $oItem->status = 'new';
                $aoItems[] = $oItem;

                $numberForCount++;
            }
        }
//        self::$offset = self::$offset + $offset + $numberForCount;
        return $aoItems;
    }
}