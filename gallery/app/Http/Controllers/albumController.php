<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class albumController extends Controller
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
        $albums=Album::select()->where('user_id',Auth::user()->id)->get();
        return view('pages.album.index',compact('albums'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.album.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>['required','Max:255',
            Rule::unique('albums')->ignore($request->id)],
        ]);

        $requestData=$request->all();
        $requestData['user_id']=Auth::user()->id;
        Album::create($requestData);

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
        $images=Image::select()->where('album_id',$id)->where('user_id',Auth::user()->id)->get();
        if(isset($images)){
            // return $images;
            return view('pages.images.index',compact('images','id'));
        }else{
            return redirect()->route('album')->with('error', __('messages.showerror'));
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $album=Album::find($id);
        if(isset($album)&& $album->user_id == Auth::user()->id){
            return view('pages.album.edit',compact('album'));
        }else{
            return redirect()->route('album')->with('error', __('messages.showerror'));
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
            $this->validate($request,[
                'name'=>['required','Max:255',
                Rule::unique('albums')->ignore($request->id)],
            ]);
            $album=Album::find($id);
            if(isset($album)&& $album->user_id == Auth::user()->id){
                $requestData=$request->all();
                $album->update($requestData);
                return redirect()->route('album')->with('success', __('messages.success'));
            }else{
                return redirect()->route('album')->with('error', __('messages.showerror'));
            }
        }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $album=Album::find($id);
        $images=Image::select()->where('album_id',$id);
        if(isset($images)){
            if($images->count()>0 &&Auth::user()->id==$album->user->id){
                return redirect()->route('album')->with('error', __('messages.deleteerror'));
            }else{
                if(isset($album)&& $album->user_id == Auth::user()->id){
                    $album->delete();
                    return redirect()->route('album')->with('success', __('messages.success'));
                }else{
                    return redirect()->route('album')->with('error', __('messages.showerror'));
                }
            }
        }

    }
    public function destroyAll($id){
        $album=Album::find($id);
        $images=Image::select()->where('album_id',$id);
        if(isset($album)&& $album->user_id == Auth::user()->id){
        $images->delete();
        return redirect()->route('album')->with('success', __('messages.success'));
        }else{
            return redirect()->route('album')->with('error', __('messages.showerror'));
        }

    }

}
