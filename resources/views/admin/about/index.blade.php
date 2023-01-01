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
                        All about
                    </div>

                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">sl no</th>
                            <th scope="col">About Title</th>
                             <th scope="col">about Description</th>
                            <th scope="col">about Image</th>
                            <th scope="col">created at</th>
                           <th scope="col">control</th>

                        </tr>
                        </thead>
                        <tbody>
                          @php($i=1)
                            @foreach ($about as $row)


                        <tr>
                            <th scope="row">{{ $i++}}</th>
                            <td><div style="height:60px;overflow:auto;max-width:110px">{{ $row->title }}</div></td>
                            <td><div style="height:80px;overflow:auto;max-width:110px">{{ $row->short_description }}</div></td>
                            <td><div style="height:80px;overflow:auto;max-width:110px">{{ $row->long_description }}</div></td>
                            
                            <td>
                                @if ($row->created_at == Null)
                                    <span class="text-danger">No DATE Set</span>
                                @else
                                {{ carbon\carbon::parse($row->created_at)->diffForHumans() }}
                                @endif
                            </td>
                            <td>
                                <a href="{{ url('about/edit/'.$row->id)  }}" class="btn btn-info">Edit</a>
                                <a href="{{ url('about/delete/'.$row->id)  }}" onclick="return confirm('Are you sure to delete ?')" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                        @endforeach

                        </tbody>
                    </table>
                    {{-- {{ $about->links() }} --}}

                </div>
            </div>

            <div class='col-md-4'>
                <div class="card">

                    <div class="card-header">
                        ADD about
                    </div>

                    <div class="card-body">
                        <form action="{{ route('store.about') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">about Title</label>
                            <input type="text" name="title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                @error('title')
                                    <span class='text-danger'>{{ $message }}</span>
                               @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">About Short Description</label>
                                <textarea name="sdescription" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"></textarea>
                                    @error('sdescription')
                                        <span class='text-danger'>{{ $message }}</span>
                                   @enderror
                            </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">About Long Description</label>
                                    <textarea name="ldescription" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"></textarea>
                                        @error('ldescription')
                                            <span class='text-danger'>{{ $message }}</span>
                                       @enderror
                                </div>
                            

                            <button type="submit" class="btn btn-primary" style='color:black;'>Add about</button>
                        </form>
                    </div>

                </div>
            </div>





         </div>
    </div>













    </div>
@endsection
