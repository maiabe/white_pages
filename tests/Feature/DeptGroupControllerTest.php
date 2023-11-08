<?php

namespace Tests\Feature;

use App\Models\Campus;
use App\Models\DeptGroup;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
class DeptGroupControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_returns_view()
    {
        $data = DeptGroup::all();
        $campusData = Campus::distinct()->pluck('campus_code');
        $response = $this->get(route('dept_groups'));
        $response->assertStatus(200);
        $response->assertViewIs('DeptGroups.dept_groups');
        $response->assertViewHas('data', $data);
        $response->assertViewHas('campusData', $campusData);
    }
//    public function test_add_dept_group()
//    {
//        $validData = [
//            'dept_grp' => '123456',
//            'dept_grp_name' => 'New Department Group',
//            'campus_code' => 'uhm',
//        ];
//        $response = $this->post(route('dept_groups.store'), $validData);
//        $this->assertDatabaseHas('dept_group', $validData);
//    }

}
