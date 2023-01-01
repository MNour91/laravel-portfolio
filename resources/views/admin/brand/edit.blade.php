@extends('admin.admin_master')

@section('admin')


    <div class="py-12">
       <div class="container">
           <div class="row">


            <div class='col-md-8'>
                <div class="card">

                    <div class="card-header">
                        Update Brand Name
                    </div>

                    <div class="card-body">
                        <form action="{{ URL('brand/update/'.$brands->id) }}" method="POST" enctype='multipart/form-data'>
                            @csrf
                            <input type="hidden" name="old_img" value="{{ $brands->brand_img }}">
                            <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">update Brand Name</label>
                            <input type="text" name="brand_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value ="{{ $brands->brand_name }}">
                                @error('brand_name')
                                    <span class='text-danger'>{{ $message }}</span>
                               @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">update Brand img</label>
                                <input type="file" name="brand_img" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" >
                                    @error('brand_img')
                                        <span class='text-danger'>{{ $message }}</span>
                                   @enderror
                                </div>
                                <div class ="form-group">
                                    <img class="img-fluid" src="{{ asset($brands->brand_img) }}" alt="img" style='width:400px;height:200px'>
                                </div>

                            <button type="submit" class="btn btn-primary m-3 col-6" style='color:black;'>Update Brand</button>
                        </form>
                    </div>

                </div>
            </div>





         </div>
    </div>


    </div>
@endsection

