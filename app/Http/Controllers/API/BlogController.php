<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function blogs(){
        $data = Blog::all();
        
        if ($data->count() > 0) {
            $responseCode = 200;
            $response = [
                'message' => "There are ". $data->count() . " Blogs Found.",
                'status' => 1,
                'data' => $data
            ];
        } else {
            $responseCode = 404;
            $response = [
                'message' => 'No Blog Found.',
                'status' => 0,
            ];
        }
        return response()->json($response, $responseCode);
    }
    public function show($id){
        $data = Blog::find($id);
        
        if ($data->count() > 0) {
            $responseCode = 200;
            $response = [
                'message' => "Blogs Details.",
                'status' => 1,
                'data' => $data
            ];
        } else {
            $responseCode = 404;
            $response = [
                'message' => 'No Blog Found.',
                'status' => 0,
            ];
        }
        return response()->json($response, $responseCode);
    }
}
