@extends('master')

@section('content')
    <div class="container ">
        <div class="row mt-2">
            <div class="col-5">
                
                @if(session('insertsuccess'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>{{session('insertsuccess')}}</strong> 
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                 
                @if(session('updatesuccess'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>{{session('updatesuccess')}}</strong> 
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                {{-- @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif --}}

                <form method="post" action="{{ route('post#create')}}" class="m-4" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3 text-group">
                        <label for="title">Title</label>
                    <input type="text" name="postTitle" class="form-control @error ('postTitle')is-invalid @enderror" value="{{old('postTitle')}}" placeholder="Enter the title">
                    
                    @error('postTitle')
                      <div class="invalid-feedback">
                        {{$message}}
                      </div>
                    @enderror

                    </div>
                    <div class="mb-3 text-group">
                        <label for="description">description</label>
                    <textarea name="postDescription" id="" class="form-control @error ('postDescription')is-invalid @enderror" placeholder="Enter your description...">{{old('postDescription')}}</textarea>
                    @error('postDescription')
                      <div class="invalid-feedback">
                        {{$message}}
                      </div>
                    @enderror
                    
                    </div>

                  <div class="mb-3 text-group">
                      <label for="image">Image</label>

                      
                  <input type="file" name="postImage" class="form-control @error ('postImage')is-invalid @enderror " value="{{old('postImage')}}">
                  

                  @error('postImage')
                      <div class="invalid-feedback">
                        {{$message}}
                      </div>
                    @enderror
                  
                  
                  </div>

                    <div class="mb-3 text-group">
                        <label for="price">Price</label>
                    <input type="number" name="postPrice" class="form-control @error ('postPrice')is-invalid @enderror" value="{{old('postPrice')}}" placeholder="Enter the price">
                    
                    @error('postPrice')
                      <div class="invalid-feedback">
                        {{$message}}
                      </div>
                    @enderror
                    </div>

                    <div class="mb-3 text-group">
                        <label for="address">Address</label>
                    <input type="text" name="postAddress" class="form-control @error ('postAddress')is-invalid @enderror" value="{{old('postAddress')}}" placeholder="Enter the address">
                    
                    @error('postAddress')
                      <div class="invalid-feedback">
                        {{$message}}
                      </div>
                    @enderror
                    </div>

                    <div class="mb-3 text-group">
                        <label for="rating">Rating</label>   
                    <input type="number" min="0" max="5" name="postRating" class="form-control   @error ('postRating')is-invalid @enderror" value="{{old('postRating')}}" type="checkbox" placeholder="Rate 0 to 5">
                    
                    
                    @error('postRating')
                      <div class="invalid-feedback">
                        {{$message}}
                      </div>
                    @enderror
                    </div>
                    
                    

                    <div class="mt-3">
                        <input type="submit" value="create" class="btn btn-outline-danger" >
                    </div>
                </form>
            </div>
            <div class="col-7 mb-3">
                <div class="data-input">
                    <div class="row ">
                    <h3 class="mb-3 col-6">
                        Total - {{$posts->total()}}
                    </h3>
                    
                    <div class="col-6 d-flex">
                        <form action="{{ route('post#createPage')}}" method="get">
                             <div class=" d-flex">
                               <input type="text" class="form-control mb-3" placeholder="Search your text..." name="searchKey" value="{{ request('searchKey')}}">
                               <button class="btn btn-danger mb-3 " type="submit"><i class="fa-brands fa-searchengin "></i></button>
                             </div>
                        </form>
                    </div>
                    
                    </div>
                    @if(count($posts)!=0)
                        @foreach($posts as $item)
                    <div class="shadow p-3 ">
                        <div class="row">
                        <h4 class="col-7">{{ $item['title']}}</h4>
                        <h6 class="col-5">{{$item->created_at->format('d-F')}}</h6>
                        </div>
                        <p class="text-muted">{{ Str::words($item['description'],10,'...')}}</p>

                        <small><i class="fa-solid fa-money-check-dollar text-primary"></i> {{$item->price}}$  /</small>

                        <small><i class="fa-solid fa-city text-danger"></i> {{$item->address}}  /</small>

                        <small><i class="fa-solid fa-star text-warning"></i> {{$item->rating}}</small>

                        <div class="text-end mt-3">
                           <a href="{{ url('post/delete/'.$item['id'])}}">
                            <button class="btn btn-outline-success"> <i class=" fa-sharp fa-solid fa-eraser"></i>Delete
                            </button>
                           </a>
                           <a href="{{ route('post#updatePage',$item['id'])}}">
                            <button class="btn btn-outline-danger">
                                <i class="fa-solid fa-arrow-rotate-right"></i>See More
                                </button>
                           </a>
                        </div>
                    </div>
                    @endforeach
                    @else
                        <h3 class="text-danger text-center mt-5">There is no data...😢 </h3>
                    @endif
                </div>
                
            </div>
            {{ $posts->appends(request()->query())->links() }}
        </div>
    </div>
@endsection