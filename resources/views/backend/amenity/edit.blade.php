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

			<h6 class="card-title">Update Amenity</h6>

			<form class="forms-sample" method="post" action="{{ route('update.amenity',$amenity->id) }}">
				@csrf
				<div class="mb-3">
					<label for="name" class="form-label">Amenity Name</label>
					<input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $amenity->name }}">
			          @error('name')
			          <span class="text-danger">{{ $message }}</span>
			          @enderror
				</div>


			<button type="submit" class="btn btn-primary me-2">Update Amenity</button>
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