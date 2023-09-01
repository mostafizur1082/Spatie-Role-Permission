@extends('admin.admin_dashboard')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<style type="text/css">

.form-check-label{
text-transform: capitalize;
}	
	
</style>

<div class="page-content">

      
        <div class="row profile-body">
         
          <!-- middle wrapper start -->
          <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
              <div class="col-md-12 grid-margin">
              	<div class="card">
                <div class="card-body">

			<h6 class="card-title">Add Role in Permission</h6>

			<form id="myForm" class="forms-sample" method="post" action="{{ route('role.permission.store') }}" >
				@csrf
				<div class="form-group mb-3">
					<label for="role_id" class="form-label">Role Name</label>
					<select name="role_id" id="role_id" class="form-select">
              <option selected="" disabled="">Select Role</option>
              @foreach($roles as $role)
              <option value="{{ $role->id }}"> {{ $role->name }}</option>
              @endforeach
          </select>
			         
				</div>

				<div class="form-check mb-2">
            <input type="checkbox" class="form-check-input" id="checkDefaultmain">
						<label class="form-check-label" for="checkDefaultmain">
							Permission All
						</label>
					</div>

				
<hr>

@foreach($permission_groups as $group)

				<div class="row">
					<div class="col-md-3">
						<div class="form-check mb-2">
            <input type="checkbox" class="form-check-input" id="checkDefault">

						<label class="form-check-label" for="checkDefault">
							{{ $group->group_name }}
						</label>

						</div>
					</div>

@php

$permissions = App\Models\User::getPermissionByGroupName($group->group_name);

@endphp

					<div class="col-md-9">
						@foreach($permissions as $permission)
						<div class="form-check mb-2">
            <input type="checkbox" class="form-check-input" id="checkDefault{{ $permission->id }}" name="permission[]" value="{{ $permission->id }}">

						<label class="form-check-label" for="checkDefault{{ $permission->id }}">
							{{ $permission->name }}
						</label>

						</div>
						@endforeach
						<br>
					</div>
				</div>
				
@endforeach

			<button type="submit" class="btn btn-primary me-2">Save Changes</button>
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


		<script class="text/javascript">
			$('#checkDefaultmain').click(function(){
				if ($(this).is(':checked')){
					$('input[type = checkbox]').prop('checked',true);
				}else{
					$('input[type = checkbox]').prop('checked',false);
				}
			});
		</script>


@endsection