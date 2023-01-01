@extends('admin.admin_master')

@section('admin')


    <div class="py-12">
       <div class="container">
           <div class="row">


            <div class='col-md-8'>
                <div class="card">

                    <div class="card-header">
                        Update Slider 
                    </div>

                    <div class="card-body">
                        <form action="{{ URL('slider/update/'.$sliders->id) }}" method="POST" enctype='multipart/form-data'>
                            @csrf
                            <input type="hidden" name="old_img" value="{{ $sliders->image }}">
                            <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">update slider Title</label>
                            <input type="text" name="title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value ="{{ $sliders->title }}">
                                @error('title')
                                    <span class='text-danger'>{{ $message }}</span>
                               @enderror
                            </div>
                            <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">update slider Discription</label>
                            <textarea name="description" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" cols="60" rows="5">{{ $sliders->description }}</textarea>
                                @error('description')
                                    <span class='text-danger'>{{ $message }}</span>
                               @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">update slider Image</label>
                                <input type="file" name="image" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" >
                                    @error('image')
                                        <span class='text-danger'>{{ $message }}</span>
                                   @enderror
                                </div>
                                <div class ="form-group">
                                    <img class="img-fluid" src="{{ asset($sliders->image) }}" alt="img" style='width:300px;height:200px'>
                                </div>

                            <button type="submit" class="btn btn-primary m-3 col-6" style='color:black;'>Update Slider</button>
                        </form>
                    </div>

                </div>
            </div>





         </div>
    </div>


    </div>
@endsection

