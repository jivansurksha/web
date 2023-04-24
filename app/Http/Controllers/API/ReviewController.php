<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Notifications\BookingNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reviews = Review::with('hospital','creator')->get();

        return ok($reviews);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $review = new Review();
        $data['created_by'] = $request->created_by;
        $review = $review->create($data);

        return created($review,"Review save successfully!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $review =  Review::where('id',$id)->with('hospital','creator')->get();
        return ok($review);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $review =  Review::find($request->id);
        $data = $request->all();
        $review->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function showReviewByHospital($profile_id)
    {
        $review =  Review::where('profile_id',$profile_id)->with('hospital','creator')->get();
        return ok($review);
    }

    public function showReviewByUser($user_id)
    {
        $review =  Review::where('created_by',$user_id)->with('hospital','creator')->get();
        return ok($review);
    }
}
