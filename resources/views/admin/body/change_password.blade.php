@extends('admin.admin_master')
  
@section('admin')
    
<h1 class='m-auto'>Change Password</h1>
<div class="card-body">
   
    <form method='POST' action='{{ route('password.update') }}'class="form-pill">
        @csrf
        <div class="form-group">
            <label for="current_password">Current Password</label>
            <input type="password" class="form-control" id="current_password" aria-describedby="emailHelp" placeholder="Current Password" autocomplete="current-password" name='oldpassword'>
            @error('oldpassword')
                <span class="text-danger" >{{ $message }}</span>

            @enderror
          </div>
          <div class="form-group">
            <label for="password">New Password</label>
            <input type="password" class="form-control" id="password" placeholder="New Password" autocomplete="new-password" name='password'>
            @error('password')
            <span class="text-danger" >{{ $message }}</span>
            @enderror
          </div>
          <div class="form-group">
              <label for="password_confirmation">Confirm Password</label>
              <input type="password" class="form-control" id="password_confirmation" placeholder="New Password" autocomplete="new-password"  name='password_confirmation'>
              @error('password_confirmation')
              <span class="text-danger" >{{ $message }}</span>
             @enderror
            </div>
          
          <button type="submit" class="btn btn-primary">Save</button>
       
    </form>
</div>





@endsection