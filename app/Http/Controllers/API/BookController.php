<?php

namespace App\Http\Controllers\API;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Book;
use Illuminate\Support\Facades\Auth;
use Validator;

class BookController extends Controller
{
public $successStatus = 200;

    /**
     * index api
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){

      //ger user object
      $books = Book::all();
      //create a success payload and create a valid api token
      $success['books'] = $books ;
      //return a successful json response
      return response()->json(['success' => $success], $this-> successStatus);
    }

    /**
      * Store a newly created book.
      *
      * @return Response
      */
     public function store()
     {
    }


    /**
      * Uopdate a book.
      *
      * @return Response
      */
     public function update()
     {
     }


    /**
    * Remove a book
    *
    * @param  int  $id
    * @return Response
    */
    public function destroy()
    {

    }


    /**
    * Remove a book
    *
    * @param  int  $id
    * @return Response
    */
    public function filter()
    {

    }
}
