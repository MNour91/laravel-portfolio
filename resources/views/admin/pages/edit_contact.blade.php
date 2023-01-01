@extends('admin.admin_master')

@section('admin')


    <div class="py-12">
       <div class="container">
           <div class="row">


            <div class='col-md-12'>
                <div class="card">

                    <div class="card-header">
                        Update Contact 
                    </div>

                    <div class="card-body">
                        <form action="{{ URL('contact/update/'.$contact->id) }}" method="POST">
                            @csrf
                            
                            <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">update Contact Address</label>
                            <input type="text" name="address" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value ="{{ $contact->address }}">
                                @error('address')
                                    <span class='text-danger'>{{ $message }}</span>
                               @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">update Contact Email</label>
                                <input type="text" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value ="{{ $contact->email }}">
                                    @error('email')
                                        <span class='text-danger'>{{ $message }}</span>
                                   @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">update Contact Phone</label>
                                    <input type="text" name="phone" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value ="{{ $contact->phone }}">
                                        @error('phone')
                                            <span class='text-danger'>{{ $message }}</span>
                                       @enderror
                                    </div>

                            <button type="submit" class="btn btn-primary m-3 col-6" style='color:black;'>Update Contact</button>
                        </form>
                    </div>

                </div>
            </div>





         </div>
    </div>


    </div>
@endsection

