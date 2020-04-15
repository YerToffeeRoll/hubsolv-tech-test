<?php
namespace Tests\Feature\Auth;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;

class RegisterControllerTest extends TestCase
{
    public function testRegisterSuccessfully()
    {
        $register = [
            'name' => 'UserTest',
            'email' => 'user@test.com',
            'password' => 'testpass',
            'c_password' => 'testpass',
        ];

        $this->json('POST', 'api/register', $register)
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

    public function testRequireNameEmailAndPassword()
    {
        $this->json('POST', 'api/register')
            ->assertStatus(422)
            ->assertJson([
                'error' => [
                    'name' => ['The name field is required.'],
                    'email' => ['The email field is required.'],
                    'password' => ['The password field is required.'],
                ]
            ]);
    }

    public function testRequirePasswordConfirmation()
    {
        $register = [
            'name' => 'User',
            'email' => 'user@test.com',
            'password' => 'userpass',
            'c_password' => 'userpass_123'
        ];

        $this->json('POST', 'api/register', $register)
            ->assertStatus(422)
            ->assertJson([
                "error"=> [
                    "c_password" => [
                        "The c password and password must match."
                    ]
                ]
            ]);
    }
}
