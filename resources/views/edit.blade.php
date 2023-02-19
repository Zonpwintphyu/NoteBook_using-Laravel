@extends('master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-9 offset-2 mt-3">
                <div class="my-3">
                    <a href="{{ route('post#updatePage' , $post['id'])}}" class="text-decoration-none text-black">
                        <i class="fa-regular fa-circle-left"></i>  back
                    </a>
                </div>
                <div >
                {{-- <h3 class=" text-center">{{ $post[0]['title']}}</h3>
                <p>
                    {{ $post[0]['description']}}
                </p> --}}

                <form action="{{route('post#update',$post['id'])}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <label for="Title">Title</label>
                    <input type="hidden" name="postId" value="{{ $post['id']}}">
                    <input type="text" class="form-control mb-3 @error ('postTitle')is-invalid @enderror"
                    value="{{old('postTitle',$post['title'])}}" name="postTitle"  placeholder="Enter your post title...">
                    @error('postTitle')
                      <div class="invalid-feedback">
                        {{$message}}
                      </div>
                    @enderror

                    <label for="description">Description</label>
                    <textarea name="postDescription" id="" class="form-control @error ('postDescription')is-invalid @enderror" placeholder="Enter your post description...">{{old('postDescription',$post['description'])}}</textarea>
                    @error('postDescription')
                      <div class="invalid-feedback">
                        {{$message}}
                      </div>
                    @enderror

                    <div class="mb-3 text-group">
                      <label for="image">Image</label>

                      <div>
                        @if($post ['image'] == null)
                            <img src="{{ asset('404.jpg')}}" class="img-thumbnail my-4 shadow-sm">
                        @else
                            <img src="{{ asset('storage/'.$post['image'])}}" class="img-thumbnail my-4 shadow-sm">
                        @endif
                    </div>

                  <input type="file" name="postImage" class="form-control @error ('postImage')is-invalid @enderror " value="{{old('postImage')}}">

                  @error('postImage')
                      <div class="invalid-feedback">
                        {{$message}}
                      </div>
                    @enderror

                  </div>

                    <div class="mb-3 text-group">
                        <label for="price">Price</label>
                    <input type="number" name="postPrice" class="form-control @error ('postPrice')is-invalid @enderror" value="{{old('postPrice',$post['price'])}}" placeholder="Enter the price">
                    
                    @error('postPrice')
                      <div class="invalid-feedback">
                        {{$message}}
                      </div>
                    @enderror
                    </div>

                    <div class="mb-3 text-group">
                        <label for="address">Address</label>
                    <input type="text" name="postAddress" class="form-control @error ('postAddress')is-invalid @enderror" value="{{old('postAddress',$post['address'])}}" placeholder="Enter the address">
                    
                    @error('postAddress')
                      <div class="invalid-feedback">
                        {{$message}}
                      </div>
                    @enderror
                    </div>

                    <div class="mb-3 text-group">
                        <label for="rating">Rating</label>   
                    <input type="number" min="0" max="5" name="postRating" class="form-control   @error ('postRating')is-invalid @enderror" value="{{old('postRating',$post['rating'])}}" type="checkbox" placeholder="Rate 0 to 5">
                    
                    
                    @error('postRating')
                      <div class="invalid-feedback">
                        {{$message}}
                      </div>
                    @enderror
                    </div>

                    {{-- <h6 class="my-3">
                    {{$post['created_at']->format('d-F-Y | n:i a')}}
                    </h6> --}}
                    <div class="d-flex">
                      <div class="m-3 btn btn-dark "> <i class="fa-solid fa-calendar-days"></i>
                      {{$post['created_at']->format('d-F-Y')}}</div>
      
                      <div class="m-3 btn btn-dark "> <i class="fa-solid fa-stopwatch"></i>
                      {{$post['created_at']->format('n:i:s a')}}</div>
                  </div>

                    <div class="row">
                        <div class="col-3 offset-9 mt-2">
                            <button type="submit" class="btn btn-outline-warning text-black" >Update</button>
                        </div>
                    </div>
                </form>
                </div>
            </div>
            
        </div>
    </div>
@endsection