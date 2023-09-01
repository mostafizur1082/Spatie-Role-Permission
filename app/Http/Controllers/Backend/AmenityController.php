<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Amenity;
use Illuminate\Http\Request;

class AmenityController extends Controller
{
    public function AllAmenity(){
        $amenities = Amenity::latest()->get();
        return view('backend.amenity.all',compact('amenities'));
    }

    public function AddAmenity(){
        return view('backend.amenity.add');
    }

    public function StoreAmenity(Request $request){
        $request->validate([
            'name' => 'required|unique:amenities|max:200',
        ]);

        Amenity::insert([
            'name' => $request->name,
        ]);

        $notification = array(
            'message' => 'Amenity insert successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.amenity')->with($notification);


    }

    public function EditAmenity($id){
        $amenity = Amenity::findOrFail($id);
        return view('backend.amenity.edit', compact('amenity'));
    }

    public function UpdateAmenity(Request $request, $id){

         $request->validate([
            'name' => 'required|unique:amenities|max:200',
        ]);

        Amenity::findOrFail($id)->update([
            'name' => $request->name,
        ]);

        $notification = array(
            'message' => 'Amenity Update successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.amenity')->with($notification);

    }

    public function DeleteAmenity($id){
        Amenity::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Amenity Delete successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
