<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Store;
use Laravel\Passport\Passport;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StoreTest extends TestCase
{
    //use RefreshDatabase;

    private $store;
    public function setup():void
    {
        
        parent::setup();
        $user = User::factory()->create();
        $pass  = Passport::actingAs($user, 'api');
        $this->store = Store::factory()->create();
    }

    public function test_check_store_api_route()
    {
        $response = $this->getJson(route('store.index'));
        $response->assertStatus(200);
    }

    public function test_get_all_store()
    {
        
        $response = $this->getJson(route('store.index'));
        
        $response->assertStatus(200);
        //$this->assertEquals(1,$response->json()['total']);
    }

    public function test_get_single_store_by_id()
    {
        $response = $this->getJson(route('store.show', $this->store->id));        

        $response->assertStatus(200);
        $this->assertEquals($response->json()['store_manager_name'], $this->store->store_manager_name );

    }

    public function test_create_single_store()
    {
        
        //action
        $response = $this->postJson(route('store.store'),[

            'store_address'    => $this->store->store_address,
            'store_manager_name'  => $this->store->store_manager_name
        
        ]);        

        //assertions
        $response->assertCreated();
        $this->assertEquals($response->json()['store_manager_name'], $this->store->store_manager_name );

    }


    public function test_update_single_store()
    {
        
        //action
        $response = $this->patchJson(route('store.update',$this->store->id),[
            'store_manager_name' => 'Updated store manager name'
        ]);
        //assertions
        $response->assertOk();
        $this->assertDatabaseHas('stores', ['id' => $this->store->id,'store_manager_name' => 'Updated store manager name']);

    }



}
