<?php

namespace App\Http\Controllers\API;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Book;
use Illuminate\Support\Facades\Auth;
use Validator;
use DB;

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
     * index api
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request){

        //lets build up a query
        $books = DB::table('books');

        //lets filter by the author
        if ($request->has('author')) {
            $books->where('author', 'LIKE',  '%' .$request->author. '%' );
        }

        //lets filter by the category of a book
        if ($request->has('category')) {
            $books->where('category', 'LIKE',  '%' .$request->category. '%' );
        }

        //create a success payload and create a valid api token
        $success['books'] = $books->get();
        //return a successful json response
        return response()->json(['success' => $success], $this-> successStatus);

      }
    /**
      * Store a newly created book.
      *
      * @return Response
      */
     public function store(Request $request){
       //we can use laravel validator functionality for -
       //validating our register
         $validator = Validator::make($request->all(), [
             'ISBN' => 'required|alpha_dash',
             'title' => 'required',
             'author' => 'required',
             'category' => 'required',
             'price' => 'required',
           ],
           ['ISBN.alpha_dash'    => 'Invalid ISBN',]
          );

       //if the validator fails return error payload
         if ($validator->fails()) {
                   return response()->json(['error'=>$validator->errors()], 400);
               }

         //get the request data
         $input = $request->all();

         //create a new user and api token
         $input = $request->all();
         $book = Book::create($input);
         $success['book'] =  $book;

       // return a successful payload
       return response()->json(['success'=>$success], 201);
     }

     /**
       * Store a newly created book.
       *
       * @return Response
       */
      public function categories(Request $request){
        //get the all the unique rows for categories
        $categories = Book::select('category')->groupBy('category')->get()->toArray();


        $all = '';
        //create one big string
        foreach($categories as $category){
          $all .= implode(',',$category).',';
        }

        //here we have some jiggery pokery to clean up the strings
        $cat_array = explode(',',str_replace(' ', '',substr($all, 0, -1)));
        //assign to a key
        $success['categories'] = array_unique($cat_array);

        return response()->json(['success'=>$success], 200);
      }


}
