<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WelcomePageTest extends TestCase
{
    use RefreshDatabase;
    public function test_welcome_page_does_not_render_top_navbar(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertDontSee('Inicio', false);
    }
}
