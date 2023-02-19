<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
class PostController extends Controller
{
    //customer create page
    public function create(){
        // $posts = Post::orderBy('created_at' , 'desc')->paginate(2);
        // dd($posts);
        // $posts = Post::where('id','<','5')->get();
        // dd($posts);
        $posts = Post::when(request('searchKey'),function($query){
            $key = request('searchKey');
            $query->orWhere('title','like','%'.$key.'%')->orWhere('description','like','%'.$key.'%');
        })->orderBy('created_at','desc')->paginate(2);
        return view('create',compact('posts'));
    }
    //post create
    public function postCreate(Request $request){

        $this -> postValidationCheck($request);
        $data = $this->getPostData($request);//array

    if($request->hasFile('postImage')){
        $fileName = uniqid(). "_Zon Zon_"  .$request->file('postImage')->getClientOriginalName();
        $request->file('postImage')->storeAs('public',$fileName);
        $data['image'] = $fileName;
    }
        // dd($data);
       
        Post::create($data);
        return redirect()->route('post#createPage')->with(['insertsuccess' => "Your creation Succeed."]);
    }

    

    //post delete
    public function postDelete($id){
        //first way
        Post::where('id', $id)->delete();
        return back();
    }
    //direct update page
    public function updatePage($id){
        $post = Post::where('id', $id)->first();
        return view('update',compact('post'));
    }

    //edit page
    public function editPage($id){
        $post = Post::where('id', $id)->first();
        return view('edit',compact('post'));
    }

    //update post
    public function update(Request $request){
        $this -> postValidationCheck($request);
        $updateData = $this->getPostData($request);
        $id = $request->postId;
        if($request->hasFile('postImage')){

            //delete
            $oldImageName = Post::select('image')->where('id',$request->postId)->first()->toArray();
            $oldImageName = $oldImageName['image'];

            if($oldImageName != null){
                Storage::delete('public/'.$oldImageName);
            }
            
            $fileName = uniqid(). "_Zon Zon_"  .$request->file('postImage')->getClientOriginalName();
            $request->file('postImage')->storeAs('public',$fileName);
            $updateData['image'] = $fileName;
        }
        Post::where('id', $id)->update($updateData);
        return redirect()->route('post#home')->with(['updatesuccess' => "Your Update Succeed."]);
    }

    
    //get post data
    private function getPostData($request){
        $response = [

            'title' => $request->postTitle,
            'description' => $request->postDescription,
            'price' => $request->postPrice,
            'address' => $request->postAddress,
            'rating' => $request->postRating

        ];

        return $response;

    }

    //post validation check
    private function postValidationCheck($request){
        $validationRules = [
            'postTitle' => 'required|min:5|unique:posts,title,'.$request->postId,
            'postDescription' => 'required|min:5',
            'postPrice' => 'required',
            'postAddress' => 'required',
            'postRating'=>'required',
            'postImage' => 'mimes:jpg,jepg,png|file|'
        ];
        
        $validationMessage = [
            'postTitle.required'=> 'You need to fill post title',
            'postDescription.required'=> 'You need to fill post description',
            'postPrice.required'=> 'You need to fill post price',
            'postAddress.required'=> 'You need to fill post address',
            'postRating.required'=> 'You need to choose post rating',
            'postImage.mimes'=>'You need to choose jpg,jepg and png types'


        ];

        Validator::make($request->all(),$validationRules,$validationMessage)->validate();
    }
}
