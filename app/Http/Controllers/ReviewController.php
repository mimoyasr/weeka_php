<?php

namespace App\Http\Controllers;


use App\Review;
use App\User;
use Illuminate\Http\Request;
use App\Http\Resources\ReviewResource;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    private $user;

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->user = User::find(2);
    }

    public function store(Request $request)
    {
        $data = $request->except('id','user_id');
        $validation = $this->_validation($data);
        if ($validation !== true) {
            return $validation;
        }
        $data['user_id'] = $this->user->id;
        $review = Review::create($data);
        return new ReviewResource($review);
    }

    public function show(Review $review)
    {
        return new ReviewResource($review);
    }

    public function update(Request $request, Review $review)
    {
        $data = $request->except('id','user_id');
        $validation = $this->_validation($data);
        if ($validation !== true) {
            return $validation;
        }
        $review->update($data);
        return new ReviewResource($review);
    }

    public function destroy(Review $review)
    {
        return json_encode(['status' => $review->delete()]);
    }

    private function _validation($data)
    {
        $validator = Validator::make($data, [
            'meal_id' => 'required|exists:meals,id',
            'rate' => 'required|integer|between:1,5',
            'comment' => 'min:3|string|max:100',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        } else {
            return true;
        }
    }
}
