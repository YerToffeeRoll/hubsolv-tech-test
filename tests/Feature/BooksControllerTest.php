<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;

class BooksControllerTest extends TestCase
{
    /**
     * Test .
     *
     * @return void
     */
     public function testLoginAndGetBooks()
     {
       $user = ['email' => 'user@email.com','password' => 'userpass'];
            Auth::attempt($user);
            $token = Auth::user()->createToken('nfce_client')->accessToken;
            $headers = ['Authorization' => "Bearer $token"];
            $this->json('GET', 'api/book', [], $headers)
                ->assertStatus(200)
                ->assertJsonStructure([
               'success' => ['books'],
       ]);
     }
}
