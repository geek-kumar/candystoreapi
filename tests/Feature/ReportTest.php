<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Laravel\Passport\Passport;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReportTest extends TestCase
{
    //use RefreshDatabase;

    private $reports;

    public function setup():void
    {
        
        parent::setup();
        $user = User::factory()->create();
        $pass  = Passport::actingAs($user, 'api');
    }
    
    public function test_report_api_route()
    {
        $response = $this->getJson(route('report.index'));
        $response->assertOk();
    }
}
