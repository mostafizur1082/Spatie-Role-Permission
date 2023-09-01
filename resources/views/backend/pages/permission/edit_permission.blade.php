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

			<h6 class="card-title">Update Permission</h6>

			<form class="forms-sample" method="post" action="{{ route('update.permission',$permission->id) }}">
				@csrf
				<div class="mb-3">
					<label for="name" class="form-label">Permission Name</label>
					<input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $permission->name }}">
			          @error('name')
			          <span class="text-danger">{{ $message }}</span>
			          @enderror
				</div>

				<div class="form-group mb-3">
                    <label for="group_name" class="form-label">Group Name</label>
                    <select name="group_name" id="group_name" class="form-select">
                        <option selected="" disabled="">Select Group</option>
                        <option value="type" {{ $permission->group_name == 'type' ? 'selected' : '' }}> Peoperty Type</option>
                        <option value="amenitie" {{ $permission->group_name == 'amenitie' ? 'selected' : '' }}> Amenitie Type</option>
                    </select>
                    
                     
                </div>


			<button type="submit" class="btn btn-primary me-2">Update Permission</button>
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



</script>


@endsection