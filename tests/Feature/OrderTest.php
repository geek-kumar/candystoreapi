<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Order;
use Laravel\Passport\Passport;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderTest extends TestCase
{
    //use RefreshDatabase;

    private $order;

    public function setup():void
    { 
        parent::setup();
        $user = User::factory()->create();
        $pass  = Passport::actingAs($user, 'api');
        $this->order = Order::factory()->create();
    }

    public function test_check_order_api_route()
    {
        $response = $this->getJson(route('order.index'));

        $response->assertStatus(200);
    }

    public function test_get_all_order()
    {
        
        $response = $this->getJson(route('order.index'));
        
        $response->assertStatus(200);
        //$this->assertEquals(1,$response->json()['total']);
    }

    public function test_get_single_order_by_id()
    {
        $response = $this->getJson(route('order.show', $this->order->id));        

        $response->assertStatus(200);
        $this->assertEquals($response->json()['customer_id'], $this->order->customer_id );

    }

    public function test_create_single_order()
    {
        
        //action
        $response = $this->postJson(route('order.store'),[

            'customer_id'   => $this->order->customer_id,
            'inventory_id'  => $this->order->inventory_id,
            'store_id'      => $this->order->store_id,
            'quantity'      => $this->order->quantity,
            'status'        => $this->order->status
        
        ]);        

        //assertions
        $response->assertCreated();
        $this->assertEquals($response->json()['customer_id'], $this->order->customer_id );

    }


    public function test_update_single_order()
    {
        
        //action
        $response = $this->patchJson(route('order.update',$this->order->id),[
            'customer_id' => 1
        ]);
        //assertions
        $response->assertOk();
        $this->assertDatabaseHas('orders', ['id' => $this->order->id,'customer_id' => 1]);

    }

}
