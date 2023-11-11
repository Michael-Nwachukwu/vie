<?php

namespace App\Http\Controllers;

use App\Models\Listings;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use phpDocumentor\Reflection\DocBlock\Tag;

class ListingsController extends Controller
{
    public function index(){
        // if you do not want to import the request tag you can use the request function
        // dd(request('tag'));
        // dd($request); import Request and $request var in the function parameter
        return view('index', [
            // this is assigning the db contnets to a var details using get
            // 'details' => Listings::latest()->filter(request(['tag', 'search']))->get()

            // then to use pagination to split contnents just add pagination instead of get
            'details' => Listings::latest()->filter(request(['tag', 'search']))->paginate(6)
        ]);
    }

    public function show(Listings $details){
        return view('show', [
            'one_job' => $details
        ]);
    }

    public function create(){
        return view('create');
    }

    public function store(Request $request){
        // dd($request->all());
        // dd($request->file('logo'));//to check the image uploaded
        
        $formFields = $request->validate([
            'title' => 'required', 
            'company' => ['required', Rule::unique('Listings', 'company')], 
            'location' => 'required', 
            'website' => 'required', 
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        // if the user uploads an image(request->hasfile('logo') then assign the request file to the formfields colums logo and store in the public folder)

        // $file = $request->file('logo');

        if( $request->hasFile('logo') ){
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
            // $file = $request->file('logo');
            // $file->move(base_path('\storage\app\public\logos'), $file->getClientOriginalName());
        }

        $formFields['user_id'] = auth()->id();

        Listings::create($formFields);

        // Session::flash('message', 'Successful');
        // or
        return redirect('/')->with('message', 'successful');
    }

    // display edit job form view
    public function edit(Listings $listings){
        return view('edit', ['listings' => $listings]);  
    }

    // update a job listing
    public function update(Request $request, Listings $listings){
        // if user id is not = to the current user abort with message unauthorized action
        if($listings->user_id != auth()->id()){
            abort(403, 'Unauthorized Action');
        }
        
        $formFields = $request->validate([
            'title' => 'required', 
            'company' => 'required',
            'location' => 'required', 
            'website' => 'required', 
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        // if the user uploads an image(request->hasfile('logo') then assign the request file to the formfields colums logo and store in the public folder)

        // $file = $request->file('logo');


        if( $request->hasFile('logo') ){
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
            // $file = $request->file('logo');
            // $file->move(base_path('\storage\app\public\logos'), $file->getClientOriginalName());
        }else{

        }

        $listings->update($formFields);

        // Session::flash('message', 'Successful');
        // or
        // return redirect('/')->with('message', 'successful');

        // return back()->with('message', 'Job Updated Successfully!');
        // or
        return redirect('/jobdetail/' . $listings->id)->with('message', 'Job Updated Successful!');


    }

    // delete a listing function
    public function destroy(Listings $listings){

        if($listings->user_id != auth()->id()){
            abort(403, 'Unauthorized Action');
        }

        $listings->delete();
        return redirect('/')->with('message', 'Job Deleted Successful!');

    }

    // show manage page view
    public function manage(){
        return view('users.manage', ['listings' => auth()->user()->listings()->get()]);
    }
}
