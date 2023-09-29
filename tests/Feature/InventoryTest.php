<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Inventory;
use Laravel\Passport\Passport;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InventoryTest extends TestCase
{
    //use RefreshDatabase;

    private $inventory;

    public function setup():void
    {
        
        parent::setup();
        $user = User::factory()->create();
        $pass  = Passport::actingAs($user, 'api');
        $this->inventory = Inventory::factory()->create();
    }

    public function test_check_inventory_api_route()
    {
        $response = $this->getJson(route('inventory.index'));
        $response->assertOk();
    }

    public function test_get_all_inventory()
    {
        
        //$inventory = Inventory::factory()->count(1)->create();
        
         //action
        $response = $this->getJson(route('inventory.index'));
        
        //assertions
        $response->assertStatus(200);
       // $this->assertEquals(1,$response->json()['total']);

    }

    public function test_get_single_inventory_by_id()
    {
        $response = $this->getJson(route('inventory.show', $this->inventory->id));        

        $response->assertStatus(200);
        $this->assertEquals($response->json()['inventory_name'], $this->inventory->inventory_name );

    }

    public function test_create_single_inventory()
    {
        
        //action
        $response = $this->postJson(route('inventory.store'),[

            'inventory_name'    => $this->inventory->inventory_name,
            'manufacture_date'  => $this->inventory->manufacture_date,
            'available_quantity'=> $this->inventory->available_quantity
        
        ]);        

        //assertions
        $response->assertCreated();
        $this->assertEquals($response->json()['inventory_name'], $this->inventory->inventory_name );

    }


    public function test_update_single_inventory()
    {
        
        //action
        $response = $this->patchJson(route('inventory.update',$this->inventory->id),[
            'inventory_name' => 'Updated data'
        ]);
        //assertions
        $response->assertOk();
        $this->assertDatabaseHas('inventories', ['id' => $this->inventory->id,'inventory_name' => 'Updated data']);

    }


}
