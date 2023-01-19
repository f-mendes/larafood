<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    /**
     * Register Client without the password.
     *
     * @return void
     */
    public function testRegisterClientWithouPassword()
    {   
        $payload = [
            'name' => 'Felipe Mendes',
            'email' => 'felipe@mail.com'
        ];
        $response = $this->postJson('/api/auth/client', $payload);

        $response->assertStatus(422)
            ->assertExactJson([
                'message' => 'The given data was invalid.',
                'errors' => [
                    'password' => [trans('validation.required', ['attribute' => 'password'])]
                ]
            ]);
    }


     /**
     * Register a new client
     *
     * @return void
     */
    public function testRegisterNewClient()
    {   
        $payload = [
            'name' => 'Felipe Mendes',
            'email' => 'felipe@mail.com',
            'password' => '123456'
        ];
        $response = $this->postJson('/api/auth/client', $payload);

        $response->assertStatus(201)
            ->assertExactJson([
                'data' => [
                    'name' => $payload['name'],
                    'email' => $payload['email']
                ]
            ]);
    }
}
