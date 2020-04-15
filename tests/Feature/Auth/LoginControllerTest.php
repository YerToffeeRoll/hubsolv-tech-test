<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;

class LoginControllerTest extends TestCase
{
    public function testLoginError()
    {
        $this->json('POST', 'api/login')
            ->assertStatus(401)
            ->assertJson(['error'=>'Unauthorised']);

    }

    public function testUserLoginSuccessfully()
    {
        $user = ['email' => 'user@email.com', 'password' => 'userpass'];
        $this->json('POST', 'api/login', $user)
            ->assertStatus(200)
            ->assertJsonStructure([
                      'success'=>[
                        'token',
                        'user' => [
                            'id',
                            'name',
                            'email',
                            'created_at',
                            'updated_at'
                        ]
                  ],
            ]);
    }
