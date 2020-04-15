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
      $book = Book::all();
      return $book;
    }

}
