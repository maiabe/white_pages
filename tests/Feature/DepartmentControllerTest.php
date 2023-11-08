<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DepartmentControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_returns_view()
    {
        $response = $this->get(route('department_listings'));
        $response->assertStatus(200);
        $response->assertViewIs('Departments.department_listings');
    }
}
