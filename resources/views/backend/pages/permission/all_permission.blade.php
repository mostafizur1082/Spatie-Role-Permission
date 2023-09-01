@extends('admin.admin_dashboard')

@section('admin')

<div class="page-content">
<nav class="page-breadcrumb"> 
		<ol class="breadcrumb">
				<a href="{{ route('add.permission') }}" class="btn btn-inverse-info" >Add Permission</a>
        &nbsp;
        &nbsp;
        &nbsp;
        <a href="{{ route('import') }}" class="btn btn-inverse-warning" >Import</a>
        &nbsp;
        &nbsp;
        &nbsp;
        <a href="{{ route('import') }}" class="btn btn-inverse-danger" >Export</a>
        
			</ol> 
</nav>
				<div class="row">
					<div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h6 class="card-title">Permission Table</h6>
               
                <div class="table-responsive">
                  <table id="dataTableExample" class="table">
                    <thead>
                      <tr>
                        <th>SL</th>
                        <th>Permission Name</th>
                        <th>Group Name</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    	@foreach($permissions as $key => $permission)
                      <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $permission->name }}</td>
                        <td>{{ $permission->group_name }}</td>
                        <td>
                        	<a href="{{ route('edit.permission', $permission->id) }}" class="btn btn-inverse-warning">Edit</a>
                        	<a href="{{ route('delete.permission', $permission->id) }}" class="btn btn-inverse-danger" id="delete">Delete</a>
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