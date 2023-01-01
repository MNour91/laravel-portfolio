@extends('admin.admin_master')
@section('admin')

<h1 class='m-auto'>Profile Update</h1>
<div class="card-body">
   
    <form method='POST' action='{{ route('profile.change') }}'class="form-pill">
        @csrf
        <div class="form-group">
            <label for="name">User Name</label>
            <input type="text" class="form-control" id="name" aria-describedby="emailHelp" placeholder="User Name" value="{{ $user->name }}" name='name'>

          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" placeholder="Enter your Email" value="{{ $user->email }}" name='email'>

          </div>
   
          
          <button type="submit" class="btn btn-primary">update</button>
       
    </form>
</div>


   

@endsection