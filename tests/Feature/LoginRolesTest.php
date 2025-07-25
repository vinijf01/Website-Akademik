<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginRolesTest extends TestCase
{
    use DatabaseTransactions;

    public function test_admin_can_access_dashboard()
    {
        $admin = User::where('is_permission', 1)->first();
        $this->actingAs($admin)
            ->get('/admin/dashboard')
            ->assertStatus(200);
    }

    public function test_walas_can_access_dashboard()
    {
        $walas =  User::where('is_permission', 3)->first();
        $this->actingAs($walas)
            ->get('/walas/dashboard')
            ->assertStatus(200);
    }

    public function test_parent_can_access_dashboard()
    {
        $parent =  User::where('is_permission', 2)->first();
        $this->actingAs($parent)
            ->get('/parent/dashboard')
            ->assertStatus(200);
    }
}
