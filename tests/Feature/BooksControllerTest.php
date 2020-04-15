<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;

class BooksControllerTest extends TestCase
{
    /**
     * Test login and get books
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


     /**
      * Test filtering of the API by author .
      *
      * @return void
      */
      public function testLoginAndFilterBooksByAuthor()
      {
        $user = ['email' => 'user@email.com','password' => 'userpass'];
             Auth::attempt($user);
             $token = Auth::user()->createToken('nfce_client')->accessToken;
             $headers = ['Authorization' => "Bearer $token"];
             $this->json('GET', 'api/book/filter?', ['author'=>'Robin Nixon'], $headers)
                 ->assertStatus(200)
                 ->assertJsonStructure([
                'success' => ['books'],
        ]);
      }

      /**
       * Test filtering of the api by categry .
       *
       * @return void
       */
       public function testLoginAndFilterBooksByCategory()
       {
         $user = ['email' => 'user@email.com','password' => 'userpass'];
              Auth::attempt($user);
              $token = Auth::user()->createToken('nfce_client')->accessToken;
              $headers = ['Authorization' => "Bearer $token"];
              $this->json('GET', 'api/book/filter?', ['category'=>'Linux'], $headers)
                  ->assertStatus(200)
                  ->assertJsonStructure([
                 'success' => ['books'],
         ]);
       }


       /**
        * Test filtering of the api by categry .
        *
        * @return void
        */
        public function testLoginAndFilterBooksByAuthorAndCategory()
        {
          $user = ['email' => 'user@email.com','password' => 'userpass'];
               Auth::attempt($user);
               $token = Auth::user()->createToken('nfce_client')->accessToken;
               $headers = ['Authorization' => "Bearer $token"];
               $this->json('GET', 'api/book/filter?', ['author'=>'Robin Nixon','category'=>'PHP'], $headers)
                   ->assertStatus(200)
                   ->assertJsonStructure([
                  'success' => ['books'],
          ]);
        }


        /**
         * Test filtering of the api by categry .
         *
         * @return void
         */
         public function testLoginAndCreateBook()
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
                ->assertJsonStructure([
                    'success'=>[
                          'book' => [
                              'ISBN',
                              'title',
                              'author',
                              'category',
                              'price',
                              'updated_at',
                              'created_at',
                              'id',
                          ]
                        ],
                      ]);

         }


         /**
          * Test filtering of the api by categry .
          *
          * @return void
          */
          public function testLoginAndCreateBookISBNValidation()
          {
            $user = ['email' => 'user@email.com','password' => 'userpass'];
                 Auth::attempt($user);
                 $token = Auth::user()->createToken('nfce_client')->accessToken;
                 $headers = ['Authorization' => "Bearer $token"];
                 $this->json('POST', 'api/book/', ['ISBN'=> '978-INVALID-
                 ISBN-1491905012',
                 'title'=>'Modern PHP: New Features and Good Practices',
                 'author'=>'Josh Lockhart',
                 'category'=>'PHP',
                 'price' => '18.99'], $headers)
                 ->assertStatus(400)
                 ->assertJsonStructure([
                     'error'=>[
                           'ISBN'
                         ],
                       ]);

          }
}
