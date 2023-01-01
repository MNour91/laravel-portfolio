@extends('admin.admin_master')

@section('admin')


    <div class="py-12">
       <div class="container">
           <div class="row">
               <div class='col-md-8'>
                <div class="card">
                   
                    <div class="card-header">
                        All Brand
                    </div>

                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">sl no</th>
                            <th scope="col">Brand Name</th>
                            <th scope="col">Brand Image</th>
                            <th scope="col">created at</th>
                           <th scope="col">control</th>

                        </tr>
                        </thead>
                        <tbody>
                            {{-- @php($i =1) --}}
                            @foreach ($brands as $brand)


                        <tr>
                            <th scope="row">{{ $brands->firstItem()+$loop->index }}</th>
                            <td>{{ $brand->brand_name }}</td>
                            <td><img src="{{ asset($brand->brand_img )}}" alt="brand" style='width:100px;height:50px;'></td>
                            <td>
                                @if ($brand->created_at == Null)
                                    <span class="text-danger">No DATE Set</span>
                                @else
                                {{ carbon\carbon::parse($brand->created_at)->diffForHumans() }}
                                @endif
                            </td>
                            <td>
                                <a href="{{ url('brand/edit/'.$brand->id)  }}" class="btn btn-info">Edit</a>
                                <a href="{{ url('brand/delete/'.$brand->id)  }}" onclick="return confirm('Are you sure to delete ?')" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                        @endforeach

                        </tbody>
                    </table>
                    {{ $brands->links() }}

                </div>
            </div>

            <div class='col-md-4'>
                <div class="card">

                    <div class="card-header">
                        ADD brand
                    </div>

                    <div class="card-body">
                        <form action="{{ route('store.brand') }}" method="POST" enctype='multipart/form-data'>
                            @csrf
                            <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">brand Name</label>
                            <input type="text" name="brand_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                @error('brand_name')
                                    <span class='text-danger'>{{ $message }}</span>
                               @enderror
                            </div>
                            <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">brand Image</label>
                            <input type="file" name="brand_img" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                @error('brand_img')
                                    <span class='text-danger'>{{ $message }}</span>
                               @enderror
                            </div>

                            <button type="submit" class="btn btn-primary" style='color:black;'>Add brand</button>
                        </form>
                    </div>

                </div>
            </div>





         </div>
    </div>













    </div>
@endsection
