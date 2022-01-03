<?php

namespace Tests\Feature;

use App\Models\Building;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApartmentControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function test_create_page_can_view_only_authenticated_user()
    {
        $building = Building::factory()->create();

        $response = $this->get(route('apartments.create', $building));

        $response->assertRedirect(route('login'));
    }
}
