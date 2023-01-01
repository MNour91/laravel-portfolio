@extends('admin.admin_master')

@section('admin')


    <div class="py-12">
       <div class="container">
           <div class="row">


            <div class='col-md-12'>
                <div class="card">

                    <div class="card-header">
                        Update About 
                    </div>

                    <div class="card-body">
                        <form action="{{ URL('about/update/'.$about->id) }}" method="POST" enctype='multipart/form-data'>
                            @csrf
                            
                            <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">update About Title</label>
                            <input type="text" name="title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value ="{{ $about->title }}">
                                @error('title')
                                    <span class='text-danger'>{{ $message }}</span>
                               @enderror
                            </div>
                            <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">update About Short Discription</label>
                            <textarea name="sdescription" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" cols="60" rows="5">{{ $about->short_description }}</textarea>
                                @error('sdescription')
                                    <span class='text-danger'>{{ $message }}</span>
                               @enderror
                            </div>
                            <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">update About Long Discription</label>
                            <textarea name="ldescription" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" cols="60" rows="5">{{ $about->long_description }}</textarea>
                                @error('ldescription')
                                    <span class='text-danger'>{{ $message }}</span>
                               @enderror
                          </div>
                                

                            <button type="submit" class="btn btn-primary m-3 col-6" style='color:black;'>Update About</button>
                        </form>
                    </div>

                </div>
            </div>





         </div>
    </div>


    </div>
@endsection

