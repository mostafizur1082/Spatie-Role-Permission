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

			<h6 class="card-title">Edit Role in Permission</h6>

			<form id="myForm" class="forms-sample" method="post" action="{{ route('update.role.permission',$role->id) }}">
				@csrf
				<div class="form-group mb-3">
					<label for="role_id" class="form-label">Role Name</label>
					<input type="text" class="form-control" id="name" name="name" value="{{ $role->name }}">
			         
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

@php
$permissions = App\Models\User::getPermissionByGroupName($group->group_name);
@endphp

						<div class="form-check mb-2">
           <input type="checkbox" class="form-check-input" id="checkDefault"
           {{ App\Models\User::roleHaspermissions($role,$permissions) ? 'checked' : '' }}>

						<label class="form-check-label" for="checkDefault">
							{{ $group->group_name }}
						</label>

						</div>
					</div>



					<div class="col-md-9">
						@foreach($permissions as $permission)
						<div class="form-check mb-2">
            <input type="checkbox" class="form-check-input" id="checkDefault{{ $permission->id }}" name="permission[]" value="{{ $permission->id }}" {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>

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