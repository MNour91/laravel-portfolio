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
                        Home Contact
                    </div>

                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">sl no</th>
                            <th scope="col">Contact address</th>
                             <th scope="col">Contact Email</th>
                            <th scope="col">Contact Phone</th>
                            <th scope="col">created at</th>
                           <th scope="col">control</th>

                        </tr>
                        </thead>
                        <tbody>
                          @php($i=1)
                            @foreach ($contact as $row)


                        <tr>
                            <th scope="row">{{ $i++}}</th>
                            <td><div style="height:60px;overflow:auto;max-width:110px">{{ $row->address }}</div></td>
                            <td><div style="height:80px;overflow:auto;max-width:110px">{{ $row->email}}</div></td>
                            <td><div style="height:80px;overflow:auto;max-width:110px">{{ $row->phone }}</div></td>
                            
                            <td>
                                @if ($row->created_at == Null)
                                    <span class="text-danger">No DATE Set</span>
                                @else
                                {{ carbon\carbon::parse($row->created_at)->diffForHumans() }}
                                @endif
                            </td>
                            <td>
                                <a href="{{ url('contact/edit/'.$row->id)  }}" class="btn btn-info">Edit</a>
                                <a href="{{ url('contact/delete/'.$row->id)  }}" onclick="return confirm('Are you sure to delete ?')" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                        @endforeach

                        </tbody>
                    </table>
                 

                </div>
            </div>

            <div class='col-md-4'>
                <div class="card">

                    <div class="card-header">
                        ADD Contact
                    </div>

                    <div class="card-body">
                        <form action="{{ route('store.contact') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">contact Address</label>
                            <input type="text" name="address" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                @error('address')
                                    <span class='text-danger'>{{ $message }}</span>
                               @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">contact Email</label>
                                <input type="text" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    @error('email')
                                        <span class='text-danger'>{{ $message }}</span>
                                   @enderror
                            </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">About Long Description</label>
                                    <input type="text" name="phone" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                        @error('phone')
                                            <span class='text-danger'>{{ $message }}</span>
                                       @enderror
                                </div>
                            

                            <button type="submit" class="btn btn-primary" style='color:black;'>Add Contact</button>
                        </form>
                    </div>

                </div>
            </div>





         </div>
    </div>













    </div>
@endsection
