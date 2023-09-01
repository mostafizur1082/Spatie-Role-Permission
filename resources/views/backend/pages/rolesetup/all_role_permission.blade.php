@extends('admin.admin_dashboard')

@section('admin')

<div class="page-content">
<nav class="page-breadcrumb"> 
		<ol class="breadcrumb">
				<a href="{{ route('add.role.permission') }}" class="btn btn-inverse-info" >Add Role & Permission</a>
        
			</ol> 
</nav>
				<div class="row">
					<div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h6 class="card-title">All Role Permission</h6>
               
                <div class="table-responsive">
                  <table id="dataTableExample" class="table">
                    <thead>
                      <tr>
                        <th>SL</th>
                        <th>Role Name</th>
                        <th>Permission</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    	@foreach($roles as $key => $role)
                      <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $role->name }}</td>
                        <td>
                          @foreach($role->permissions as $permission)
                          <span class="badge bg-danger">{{ $permission->name }}</span>
                          @endforeach
                        </td>
                        <td>
                        	<a href="{{ route('edit.role.permission', $role->id) }}" class="btn btn-inverse-warning">Edit</a>
                        	<a href="{{ route('delete.role.permission', $role->id) }}" class="btn btn-inverse-danger" id="delete">Delete</a>
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