@extends('admin.admin_master')

@section('admin')


    <div class="py-12">
       <div class="container">
           <div class="row">
               <div class='col-md-12'>
                <div class="card">
                    @if (session('success'))
                     <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>{{ session('success') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                    @endif
                    <div class="card-header">
                        Home Contact Message
                    </div>

                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">sl no</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Subject</th>
                            <th scope="col">Message</th>
                            <th scope="col">created at</th>
                           <th scope="col">control</th>

                        </tr>
                        </thead>
                        <tbody>
                          @php($i=1)
                            @foreach ($messages as $row)


                        <tr>
                            <th scope="row">{{ $i++}}</th>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->email}}</td>
                            <td>{{ $row->subject }}</td>
                            <td><div style="height:60px;overflow:auto;max-width:240px">{{ $row->message}}</div></td>
                            <td>
                                @if ($row->created_at == Null)
                                    <span class="text-danger">No DATE Set</span>
                                @else
                                {{ carbon\carbon::parse($row->created_at)->diffForHumans() }}
                                @endif
                            </td>
                            <td>
                                
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{ $row->id }}">
                                   Show 
                                </button>
                                
                                <!-- Modal -->
                                <div style='color:#000' class="modal fade" id="exampleModal{{ $row->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">{{ $row->subject }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                        <div class="modal-body">
                                            {{ $row->message }}
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                    </div>
                                </div>


                                <a href="{{ url('message/delete/'.$row->id)  }}" onclick="return confirm('Are you sure to delete ?')" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                        @endforeach

                        </tbody>
                    </table>
                    {{ $messages->links() }}

                </div>
            </div>


         </div>
    </div>













    </div>
@endsection
