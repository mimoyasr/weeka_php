<?php

namespace App\Http\Controllers;

use App\Review;
use Illuminate\Http\Request;
use App\Http\Resources\ReviewResource;

class ReviewController extends Controller
{
   

    public function store(Request $request)
    {
       $data=$request->all();
       $review=Review::create($data);
       return new ReviewResource($review);
    }

  
    public function show(Review $review)
    {
       return new ReviewResource($review);
    }

  


    public function update(Request $request, Review $review)
    {
        $data=$request->all();
        $review ->update($data);
        return new ReviewResource($review);
    }


    public function destroy(Review $review)
    {
       return json_encode(['status'=> $review->delete()]);
    }
}
