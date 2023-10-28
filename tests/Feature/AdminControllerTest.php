<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
   use RefreshDatabase;

    public function test_index_returns_view()
    {
        $response = $this->get(route('admins'));
        $response->assertStatus(200);
        $response->assertViewIs('Admins.admins');
    }
}
