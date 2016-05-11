<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

//use \Illuminate\Container\Container as Container;
//use \Illuminate\Support\Facades\Facade as Facade;

class OptionTest extends TestCase {

    use DatabaseTransactions;


    public function addOptions($num = 10) {

        return factory(App\Models\Option::class, $num)->create();

    }

    /** @test */

    public function factory_adding_options() {

        $result = $this->addOptions(10);
        $this->assertEquals(10, count($result));
    }

    /** @test */

    public function we_can_not_create_new_options_with_invalid_data(){

        $option = new \App\Models\Option;
        $results = [];
        $failed_add = 0;

        $results[] = $option->firstOrCreate(['key'=>'first_test_key', 'value'=> '']);
        $results[] = $option->create(['key'=>'first_test_key2', 'value'=> '']);

        foreach($results as $result){
            if(method_exists($result,'messages') && !empty($result->messages())){
//                fwrite(STDERR, var_dump($result->messages()));
                $failed_add++;
            }
        }

        $this->assertCount($failed_add, $results);

    }


    public function test_options_validator(){

        $option = new \App\Models\Option;

        $failed_add = 0;

        $test_options = [
            //empty value
            0 => [
                'key'=>'0_test_key',
            ],
            //empty key
            1 => [
                'value'=> '1_test_value'
            ],
            //invalid key type
            2 => [
                'key' => 3,
                'value' => '2_test_value'
            ]
        ];

//        $this->setExpectedException('Exception');

        foreach($test_options as $test_option){
            $result = $option->create($test_option);
            if(method_exists($result,'messages') && !empty($result->messages())){
//                fwrite(STDERR, var_dump($result->messages()));
                $failed_add++;
            }
        }

        $this->assertCount($failed_add, $test_options);

    }

    /** @test */

    public function set_and_get_site_options(){

        $option = new \App\Models\Option;
        $test_options = [
            0 => [
                'key'=> 'test_text',
                'value' => 'Lorem ipsum dolor sit amet, consectetur odio sit amet justo. Proin sit amet nunc in magna rhoncus malesuada in sit amet mi. Interdum et malesuada fames ac ante ipsum primis in faucibus. Duis non dictum justo. Nam elit orci, ullamcorper vitae erat id, scelerisque suscipit odio. Vestibulum maximus, tellus eget viverra consequat, tell'
            ],
            1 => [
                'key'=> 'test_integer',
                'value' => 1
            ],
            2 => [
                'key'=> 'test_bool',
                'value' => true
            ]

        ];

        foreach($test_options as $test_option){
           $result = $option->setOption($test_option['key'], $test_option['value']);
            if(method_exists($result,'messages') && !empty($result->messages())){
//                fwrite(STDERR, var_dump($result->messages()));
            }
        }

        $result = [];

        foreach($test_options as $test_option){
            $result[] = $option->getOption($test_option['key']);
            if(method_exists($result,'messages') && !empty($result->messages())){
//                fwrite(STDERR, var_dump($result->messages()));
                array_pop($result);
            } elseif(!end($result)) {
                array_pop($result);
            }
        }

        $this->assertEquals(count($test_options), count($result));

    }

    /** @test */

    public function it_fetches_custom_options() {

        $created = $this->addOptions(20);
        $list = \App\Models\Option::listOptions(20,0);
        $this->assertEquals(count($list), count($created));

    }

    /** @test */

    public function remove_option() {

        $option = new \App\Models\Option;
        $option->create(['key' => 'test_foo', 'value' => 'test_bar']);
        $foo = $option->getOption('test_foo');
//        fwrite(STDERR, var_dump($foo));
        $this->assertEquals('test_bar', $foo);
        $option->removeOption('test_foo');
        $foo = $option->getOption('test_foo');
        $this->dontSeeInDatabase('options', [
            'key' => 'test_foo',
        ]);
//        $this->assertFalse($foo);
    }

    /** @test */

    public function reset_all_options() {

        $diff = 0;
        $defaults = \Illuminate\Support\Facades\Config::get('options')['default'];
        $option = new \App\Models\Option;
        $option->resetOptions();
        $list = \App\Models\Option::all()->pluck('key');
        foreach($list as $key) {
            if(!isset($defaults[$key])) {
                $diff++;
            }
        }

//      fwrite(STDERR, var_dump($diff));
        $this->assertEquals(0, $diff);

        \App\Models\Option::truncate();
        $option->resetOptions();

    }

}