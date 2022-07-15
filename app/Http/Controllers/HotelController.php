<?php

namespace App\Http\Controllers;

use App\Http\Resources\HotelCollection;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Resources\HotelResource;
use Illuminate\Support\Facades\Storage;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $hotel = Hotel::all();

        return new HotelCollection($hotel);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        //return 'hello';
        
        $hotel = new Hotel();
       
        $imageName='';
       
        if($request->hasFile('images')){
            $images = $request->file('images');
            // dd($images);
            foreach($images as $image){
                $new_names = rand(). '.' .$image->getClientOriginalExtension() ;
                $image->move(public_path('/uploads/images'),$new_names);
                $imageName=$imageName.$new_names. " ,"; 
            }
            $imagedb=$imageName;
        } else{
                return response()->json('images is null');
            }


        //     $images = $request->file('image');
        //     if($request->hasFile('images')){
        //        $new_name = rand(). '.' .$images->getClientOriginalExtension();
        //        $images->move(public_path('/uploads/images'),$new_name);
   
        //       // dd($image);
        //        // return response()->json($new_name);
        //        //dd($profileimage);
        //    }else{
        //        return response()->json('images is null');
        //    }
        

        //upload one image

        
         if($request->hasFile('profile')){
            $profile = $request->file('profile');
            $new_name = rand(). '.' .$profile->getClientOriginalExtension();
            $profile->move(public_path('/images'),$new_name);

           // dd($image);
            // return response()->json($new_name);
            //dd($profileimage);
        }else{
            return response()->json('image is null');
        }

        //storage::url()

        $hotel->name = $request->input('name');
        $hotel->website = $request->input('website');
        $hotel->location = $request->input('location');
        $hotel->about = $request->input('about');
        $hotel->amenities = json_encode($request->input('amenities'));
        $hotel->profileimage= Storage::url($new_name);
        $hotel->hotelimages = Storage::url($imagedb) ;

        $hotel->save();
        // dd($hotel);
        return response()->json([
            'hotel' => new HotelResource($hotel),
            'profileimage' => $new_name,
            'images' => $imagedb
        ]);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
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
}
