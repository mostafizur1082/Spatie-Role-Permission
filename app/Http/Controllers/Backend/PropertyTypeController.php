<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PropertyType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PropertyTypeController extends Controller
{
    public function AllProperty(){
        $properties = PropertyType::latest()->get();
        return view('backend.property.all',compact('properties'));
    }

    public function AddProperty(){
        return view('backend.property.add');
    }

    public function StoreProperty(Request $request){
        $request->validate([
            'name' => 'required|unique:property_types|max:200',
            'icon' => 'required',
        ]);

        PropertyType::insert([
            'name' => $request->name,
            'icon' => $request->icon,
        ]);

        $notification = array(
            'message' => 'Property insert successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.property')->with($notification);


    }

    public function EditProperty($id){
        $property = PropertyType::findOrFail($id);
        return view('backend.property.edit', compact('property'));
    }

    public function UpdateProperty(Request $request, $id){

         $request->validate([
            'name' => 'required|unique:property_types|max:200',
            'icon' => 'required',
        ]);

        PropertyType::findOrFail($id)->update([
            'name' => $request->name,
            'icon' => $request->icon,
        ]);

        $notification = array(
            'message' => 'Property Update successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.property')->with($notification);

    }

    public function DeleteProperty($id){
        PropertyType::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Property Delete successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
