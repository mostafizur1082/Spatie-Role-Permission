@extends('admin.admin_dashboard')
@section('admin')
   {{-- query cdn --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js">
</script>

<div class="page-content">

      
        <div class="row profile-body">
         
          <!-- middle wrapper start -->
          <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
              <div class="col-md-12 grid-margin">
              	<div class="card">
                <div class="card-body">

			<h6 class="card-title">Add Amenity</h6>

			<form id="myForm" class="forms-sample" method="post" action="{{ route('store.amenity') }}" >
				@csrf
				<div class="form-group mb-3">
					<label for="name" class="form-label">Amenity Name</label>
					<input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" >
					@error('name')
			    <span class="text-danger">{{ $message }}</span>
			    @enderror
			         
				</div>

				


			<button type="submit" class="btn btn-primary me-2">Add Amenity</button>
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



<script src="{{ asset('backend/assets') }}/js/code/validate.min.js"></script>

<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                name: {
                    required : true,
                }, 
                
            },
            messages :{
                name: {
                    required : 'Please Insert Amenitie Name',
                }, 
                 

            },
            errorElement : 'span', 
            errorPlacement: function (error,element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight : function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        });
    });
    
</script>


@endsection