<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images=Image::with('album')->where('user_id',Auth::user()->id)->select()->get();

        return view('pages.images.index',compact('images'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $album=Album::find($id);
        if(isset($album)){
            return view('pages.images.create',compact('id'));
        }else{
            return redirect()->route('album')->with('error',__('messages.showerror'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        $this->validate($request,[
            'name'=>['required','Max:255'],
            'image'=>'required|image|mimes:jpeg,png,jpg,gif,svg',
            'album_id'=>'required|numeric|exists:albums,id'
        ]);

        $requestData=$request->all();
        $requestData['user_id']=Auth::user()->id;


        $image=$request->file('image');
        $file_extention=$image->getClientOriginalName();
        $file_name=\Str::random(20).$file_extention;
        $path='images/packageCover';
        $image->storeAs('public/image',$file_name);

        $requestData['image']=$file_name;


        Image::create($requestData);

        return redirect()->route('album')->with('success', __('messages.success'));

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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $image=Image::with('album')->find($id);
        // return $image->album->name;
        if(isset($image)&& $image->user_id == Auth::user()->id){
            $albums=Album::select()->get()->except($image->album->id);
            return view('pages.images.edit',compact('image','albums'));
        }else{
            return redirect()->route('image')->with('error', __('messages.showerror'));
        }
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
        // return $request;
        $this->validate($request,[
            'name'=>['required','Max:255'],
            'image'=>'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'album_id'=>'required|numeric|exists:albums,id'
        ]);

        $requestData=$request->all();
        $requestData['user_id']=Auth::user()->id;

if(isset($request->image)){

    $image=$request->file('image');
    $file_extention=$image->getClientOriginalName();
    $file_name=\Str::random(20).$file_extention;
    $path='images/packageCover';
    $image->storeAs('public/image',$file_name);
    $requestData['image']=$file_name;
}else{
    $requestData['image']=$request->old_image;
}


        Image::find($id)->update($requestData);

        return redirect()->route('album')->with('success', __('messages.success'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $image=Image::find($id);
            if(isset($image)&& $image->user_id == Auth::user()->id){
                $image->delete();
                return redirect()->back()->with('success', __('messages.success'));
            }else{
                return redirect()->back()->with('error', __('messages.showerror'));
            }
    }
}
