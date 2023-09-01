@extends('admin.admin_dashboard')

@section('admin')

<div class="page-content">
<nav class="page-breadcrumb"> 
		<ol class="breadcrumb">
				<a href="{{ route('add.amenity') }}" class="btn btn-inverse-info" >Add Amenity</a>
			</ol> 
</nav>
				<div class="row">
					<div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h6 class="card-title">Amenity Table</h6>
               
                <div class="table-responsive">
                  <table id="dataTableExample" class="table">
                    <thead>
                      <tr>
                        <th>SL</th>
                        <th>Amenity Name</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    	@foreach($amenities as $key => $amenity)
                      <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $amenity->name }}</td>
                        <td>
                           @if(Auth::user()->can('edit.amenity'))
                        	<a href="{{ route('edit.amenity', $amenity->id) }}" class="btn btn-inverse-warning">Edit</a>
                          @endif
                           @if(Auth::user()->can('delete.amenity'))
                        	<a href="{{ route('delete.amenity', $amenity->id) }}" class="btn btn-inverse-danger" id="delete">Delete</a>
                          @endif
                        </td>
                      </tr>
                      @endforeach


                    </tbody>
                  </table>
                </div>
              </div>
            </div>
					</div>
				</div>

			</div>

@endsection