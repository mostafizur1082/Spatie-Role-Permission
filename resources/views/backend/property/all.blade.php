@extends('admin.admin_dashboard')

@section('admin')

<div class="page-content">
<nav class="page-breadcrumb"> 
		<ol class="breadcrumb">
				<a href="{{ route('add.property') }}" class="btn btn-inverse-info" >Add Property</a>
			</ol> 
</nav>
				<div class="row">
					<div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h6 class="card-title">Data Table</h6>
                <p class="text-muted mb-3">Read the <a href="https://datatables.net/" target="_blank"> Official DataTables Documentation </a>for a full list of instructions and other options.</p>
                <div class="table-responsive">
                  <table id="dataTableExample" class="table">
                    <thead>
                      <tr>
                        <th>SL</th>
                        <th>Property Name</th>
                        <th>Property Icon</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    	@foreach($properties as $key => $property)
                      <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $property->name }}</td>
                        <td>{{ $property->icon }}</td>
                        <td>
                          @if(Auth::user()->can('edit.property'))
                        	<a href="{{ route('edit.property', $property->id) }}" class="btn btn-inverse-warning">Edit</a>
                          @endif
                          @if(Auth::user()->can('delete.property'))
                        	<a href="{{ route('delete.property', $property->id) }}" class="btn btn-inverse-danger" id="delete">Delete</a>
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