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

			<h6 class="card-title">Add Role</h6>

			<form id="myForm" class="forms-sample" method="post" action="{{ route('store.role') }}" >
				@csrf
				<div class="form-group mb-3">
					<label for="name" class="form-label">Role Name</label>
					<input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" >
					@error('name')
			    <span class="text-danger">{{ $message }}</span>
			    @enderror
			         
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