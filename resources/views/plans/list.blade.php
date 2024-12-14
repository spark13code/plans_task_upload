@extends('layout.layout')

@section('content')
            
<div class="main-panel">
          <div class="content-wrapper">
            <div class="row">
              <div class="col-sm-12">
              <div class="home-tab">

                <div class="d-sm-flex align-items-center justify-content-between border-bottom pb-2 mb-4">
                  
                <span class="fs-4 fw-bold">Plans</span>

                <a href="{{ route('plan.add') }}" class="btn btn-primary text-white me-0"><i class="icon-plus"></i> Add Plan</a>
                   
                </div>


            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                   
                    <div class="table-responsive">
                      <table class="table table-hover" id="plan-table">
                        <thead>
                          <tr>
                            <th>Plan Name</th>
                            <th>Plan Price</th>
                            <th>Plan Description</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>


              </div>
                  </div>
                </div>
              </div>
              </div>

@endsection

@section('js')
<script>
    $(document).ready(function () {
    $('#plan-table').DataTable({
        processing: true, // Show processing indicator
        serverSide: true, // Enable server-side processing
        ajax: {
            url: '/get-plans', // Endpoint to fetch data
            type: 'GET'
        },
        columns: [
            { data: 'plan_name', name: 'plan_name' },
            { data: 'plan_price', name: 'plan_price' },
            { data: 'plan_description', name: 'plan_description' },
            { data: 'action', name: 'action', orderable: false, searchable: false } // Action column
        ]
    });
});
</script>
@endsection