<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LeadApiTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        // Crear un usuario de prueba
        $this->user = User::factory()->create();

        // Autenticar al usuario y obtener el token
        $token = $this->user->createToken('TestToken')->plainTextToken;

        // Establecer el token para las solicitudes
        $this->withHeader('Authorization', 'Bearer ' . $token);
    }

    public function test_can_create_lead()
    {
        $leadData = [
            'name' => 'Test Lead',
            'source' => 'Website',
            'owner' => $this->user->id,
            'created_by' => $this->user->id,
        ];

        $response = $this->postJson('/api/lead', $leadData);

        $response->assertStatus(201)
                 ->assertJsonPath('data.name', $leadData['name']);
    }

    public function test_can_get_all_leads()
    {
        $response = $this->getJson('/api/leads');

        $response->assertStatus(200);
    }
}
