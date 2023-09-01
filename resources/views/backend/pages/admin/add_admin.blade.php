@extends('admin.admin_dashboard')
@section('admin')


<div class="page-content">

      
        <div class="row profile-body">
         
          <!-- middle wrapper start -->
          <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
              <div class="col-md-12 grid-margin">
              	<div class="card">
                <div class="card-body">

			<h6 class="card-title">Add Admin</h6>

			<form id="myForm" class="forms-sample" method="post" action="{{ route('store.admin') }}" >
				@csrf

				<div class="form-group mb-3">
					<label for="name" class="form-label">Admin Name</label>
					<input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" >
					@error('name')
			    <span class="text-danger">{{ $message }}</span>
			    @enderror
				</div>


				<div class="form-group mb-3">
					<label for="username" class="form-label">Admin User Name</label>
					<input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" >
					@error('username')
			    <span class="text-danger">{{ $message }}</span>
			    @enderror  
				</div>


				<div class="form-group mb-3">
					<label for="email" class="form-label">Admin Email</label>
					<input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" >
					@error('email')
			    <span class="text-danger">{{ $message }}</span>
			    @enderror  
				</div>


				<div class="form-group mb-3">
					<label for="phone" class="form-label">Admin Phone</label>
					<input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" >
					@error('phone')
			    <span class="text-danger">{{ $message }}</span>
			    @enderror  
				</div>
				
				<div class="form-group mb-3">
					<label for="address" class="form-label">Admin Address</label>
					<input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" >
					@error('address')
			    <span class="text-danger">{{ $message }}</span>
			    @enderror  
				</div>


				<div class="form-group mb-3">
					<label for="password" class="form-label">Admin Password</label>
					<input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" >
					@error('password')
			    <span class="text-danger">{{ $message }}</span>
			    @enderror  
				</div>


				<div class="form-group mb-3">
					<label for="role" class="form-label">Role Name</label>
					<select name="role" id="role" class="form-select">
              <option selected="" disabled="">Select Role</option>
              @foreach($roles as $role)
              <option value="{{ $role->id }}"> {{ $role->name }}</option>
              @endforeach
          </select>  
				</div>
				


			<button type="submit" class="btn btn-primary me-2">Add Role</button>
			</form>

              </div>
              </div>
              </div>

              
            </div>
          </div>
          <!-- middle wrapper end -->
          <!-- right wrapper start -->
          
          <!-- right wrapper end -->
        </div>

			</div>


@endsection