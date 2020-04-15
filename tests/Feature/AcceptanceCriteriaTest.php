<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;
class AcceptanceCriteriaTest extends TestCase
{

          /**
           * @test 1 of teh accpetance tests.
           *
           * @return void
           */
          public function acceptanceTest1()
          {
            $user = ['email' => 'user@email.com','password' => 'userpass'];
                 Auth::attempt($user);
                 $token = Auth::user()->createToken('nfce_client')->accessToken;
                 $headers = ['Authorization' => "Bearer $token"];
                 $response = $this->json('GET', 'api/book/filter?', ['author'=>'Robin Nixon'], $headers)
                     ->assertStatus(200)
                     ->assertJsonFragment(['978-1491918661'])
                    ->assertJsonFragment(['978-0596804848']);
                  }
          /**
          * @test 2 of teh accpetance tests.
           *
           * @return void
           */
          public function acceptanceTest2()
          {
            $user = ['email' => 'user@email.com','password' => 'userpass'];
                 Auth::attempt($user);
                 $token = Auth::user()->createToken('nfce_client')->accessToken;
                 $headers = ['Authorization' => "Bearer $token"];
                 $response = $this->json('GET', 'api/book/filter?', ['author'=>'Christopher Negus'], $headers)
                     ->assertStatus(200)
                     ->assertJsonFragment(['978-1118999875']);
          }
          /**
           * @test 3 of teh accpetance tests.
           *
           * @return void
           */
          public function acceptanceTest3()
          {
            $user = ['email' => 'user@email.com','password' => 'userpass'];
                 Auth::attempt($user);
                 $token = Auth::user()->createToken('nfce_client')->accessToken;
                 $headers = ['Authorization' => "Bearer $token"];
                 $response = $this->json('GET', 'api/categories', [], $headers)
                     ->assertStatus(200)
                     ->assertJsonFragment(['PHP'])
                     ->assertJsonFragment(['Javascript'])
                     ->assertJsonFragment(['Linux']);
          }
          /**
          * @test 4 of teh accpetance tests.
           *
           * @return void
           */
          public function acceptanceTest4()
          {
            $user = ['email' => 'user@email.com','password' => 'userpass'];
                 Auth::attempt($user);
                 $token = Auth::user()->createToken('nfce_client')->accessToken;
                 $headers = ['Authorization' => "Bearer $token"];
                 $response = $this->json('GET', 'api/book/filter?', ['category'=>'Linux'], $headers)
                     ->assertStatus(200)
                     ->assertJsonFragment(['978-0596804848'])
                     ->assertJsonFragment(['978-1118999875']);


          }
          /**
           * @test 5 of teh accpetance tests.
           *
           * @return void
           */
          public function acceptanceTest5()
          {
            $user = ['email' => 'user@email.com','password' => 'userpass'];
                 Auth::attempt($user);
                 $token = Auth::user()->createToken('nfce_client')->accessToken;
                 $headers = ['Authorization' => "Bearer $token"];
                 $response = $this->json('GET', 'api/book/filter?', ['category'=>'PHP'], $headers)
                     ->assertStatus(200)
                     ->assertJsonFragment(['978-1491918661']);
          }
          /**
         * @test 6 of teh accpetance tests.
           *
           * @return void
           */
          public function acceptanceTest6()
          {
            $user = ['email' => 'user@email.com','password' => 'userpass'];
                 Auth::attempt($user);
                 $token = Auth::user()->createToken('nfce_client')->accessToken;
                 $headers = ['Authorization' => "Bearer $token"];
                 $this->json('GET', 'api/book/filter?', ['author'=>'Robin Nixon','category'=>'PHP'], $headers)
                     ->assertStatus(200)
                     ->assertJsonFragment(['978-1491918661']);
          }
          /**
         * @test 7 of teh accpetance tests.
           *
           * @return void
           */
          public function acceptanceTest7()
          {
            $user = ['email' => 'user@email.com','password' => 'userpass'];
                 Auth::attempt($user);
                 $token = Auth::user()->createToken('nfce_client')->accessToken;
                 $headers = ['Authorization' => "Bearer $token"];
                 $this->json('POST', 'api/book/', ['ISBN'=> '978-1491905012',
                 'title'=>'Modern PHP: New Features and Good Practices',
                 'author'=>'Josh Lockhart',
                 'category'=>'PHP',
                 'price' => '18.99'], $headers)
                 ->assertStatus(201)
                 ->assertJsonFragment(['978-1491905012'])
                 ->assertJsonFragment(['Modern PHP: New Features and Good Practices'])
                 ->assertJsonFragment(['Josh Lockhart'])
                 ->assertJsonFragment(['PHP'])
                 ->assertJsonFragment(['18.99']);

          }

         /** * @test
        *
        * @return void
        */
       public function acceptanceTest8()
       {
         $user = ['email' => 'user@email.com','password' => 'userpass'];
         $testData = [];

              Auth::attempt($user);
              $token = Auth::user()->createToken('nfce_client')->accessToken;
              $headers = ['Authorization' => "Bearer $token"];
              $response = $this->json('POST', 'api/book/', ['ISBN'=> '978-INVALID-
                        ISBN-1491905012',
                        'title'=>'Modern PHP: New Features and Good Practices',
                        'author'=>'Josh Lockhart',
                        'category'=>'PHP',
                        'price' => '18.99'], $headers);

            $response->assertStatus(400)
                     ->assertJsonFragment(['Invalid ISBN']);
       }
}
