<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AnnouncementControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_returns_view()
    {
        $response = $this->get(route('announcements'));
        $response->assertStatus(200);
        $response->assertViewIs('Announcements.announcements');
    }
}
