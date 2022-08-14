<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_login()
    {
        $user = User::factory()->create();
        $client = $this->withHeaders($this->getHeader());

        $data = [];

        $response = $client->post(route('api.auth.login'), $data);
        $response->assertStatus(422);
        $response->assertJsonValidationErrorFor('email');
        $response->assertJsonValidationErrorFor('password');

        $data = [
            'email' => 'test',
            'password' => 'asdf',
        ];

        $response = $client->post(route('api.auth.login'), $data);
        $response->assertStatus(422);
        $response->assertJsonValidationErrorFor('email');

        $data['email'] = 'test@test.com';
        $response = $client->post(route('api.auth.login'), $data);
        $response->assertStatus(400);
        $response->assertJsonPath('data.code', 'credential_not_match');

        $data = [
            'email' => $user->email,
            'password' => 'password',
        ];

        $response = $client->post(route('api.auth.login'), $data);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                'user' => [
                    'id', 'name', 'email',
                ],
                'authorization' => [
                    'token', 'type',
                ],
            ],
        ]);
    }
}
