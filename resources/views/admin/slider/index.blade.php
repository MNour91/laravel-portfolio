@extends('admin.admin_master')

@section('admin')


    <div class="py-12">
       <div class="container">
           <div class="row">
               <div class='col-md-8'>
                <div class="card">
                    @if (session('success'))
                     <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>{{ session('success') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                    @endif
                    <div class="card-header">
                        All slider
                    </div>

                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">sl no</th>
                            <th scope="col">slider Title</th>
                             <th scope="col">slider Description</th>
                            <th scope="col">slider Image</th>
                            <th scope="col">created at</th>
                           <th scope="col">control</th>

                        </tr>
                        </thead>
                        <tbody>
                          
                            @foreach ($sliders as $slider)


                        <tr>
                            <th scope="row">{{ $sliders->firstItem()+$loop->index }}</th>
                            <td><div style="height:60px;overflow:auto;max-width:110px">{{ $slider->title }}</div></td>
                            <td><div style="height:60px;overflow:auto;max-width:110px">{{ $slider->description }}</div></td>
                            <td><img src="{{ asset($slider->image )}}" alt="slider" style='width:100px;height:50px;'></td>
                            <td>
                                @if ($slider->created_at == Null)
                                    <span class="text-danger">No DATE Set</span>
                                @else
                                {{ carbon\carbon::parse($slider->created_at)->diffForHumans() }}
                                @endif
                            </td>
                            <td>
                                <a href="{{ url('slider/edit/'.$slider->id)  }}" class="btn btn-info">Edit</a>
                                <a href="{{ url('slider/delete/'.$slider->id)  }}" onclick="return confirm('Are you sure to delete ?')" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                        @endforeach

                        </tbody>
                    </table>
                    {{ $sliders->links() }}

                </div>
            </div>

            <div class='col-md-4'>
                <div class="card">

                    <div class="card-header">
                        ADD Slider
                    </div>

                    <div class="card-body">
                        <form action="{{ route('store.slider') }}" method="POST" enctype='multipart/form-data'>
                            @csrf
                            <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Slider Title</label>
                            <input type="text" name="title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                @error('title')
                                    <span class='text-danger'>{{ $message }}</span>
                               @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Slider Description</label>
                                <textarea name="description" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"></textarea>
                                    @error('description')
                                        <span class='text-danger'>{{ $message }}</span>
                                   @enderror
                                </div>
                            <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Slider Image</label>
                            <input type="file" name="image" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                @error('image')
                                    <span class='text-danger'>{{ $message }}</span>
                               @enderror
                            </div>

                            <button type="submit" class="btn btn-primary" style='color:black;'>Add Slider</button>
                        </form>
                    </div>

                </div>
            </div>





         </div>
    </div>













    </div>
@endsection
