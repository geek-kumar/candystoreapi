<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Customer;
use Laravel\Passport\Passport;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CustomerTest extends TestCase
{
    //use RefreshDatabase;

    private $customer;
    public function setup():void
    {
        
        parent::setup();
        $user = User::factory()->create();
        $pass  = Passport::actingAs($user, 'api');
        $this->customer = Customer::factory()->create();
    }

    public function test_customer_api_route()
    {
        $response = $this->getJson(route('customer.index'));
        $response->assertStatus(200);
    }

    public function test_get_all_customer()
    {
        
        $response = $this->getJson(route('customer.index'));
        
        $response->assertStatus(200);
        //$this->assertEquals(1,$response->json()['total']);
    }

    public function test_get_single_inventory_by_id()
    {
        $response = $this->getJson(route('customer.show', $this->customer->id));        

        $response->assertStatus(200);
        $this->assertEquals($response->json()['customer_name'], 
        $this->customer->customer_name );

    }

    public function test_create_single_customer()
    {
        
        //action
        $response = $this->postJson(route('customer.store'),[

            'customer_name'  => $this->customer->customer_name
        
        ]);        

        //assertions
        $response->assertCreated();
        $this->assertEquals($response->json()['customer_name'],
         $this->customer->customer_name );

    }


    public function test_update_single_customer()
    {
        
        //action
        $response = $this->patchJson(route('customer.update',$this->customer->id),[
            'customer_name' => 'Updated customer name'
        ]);
        //assertions
        $response->assertOk();
        $this->assertDatabaseHas('customers', ['id' => $this->customer->id,'customer_name' => 'Updated customer name']);

    }


}
