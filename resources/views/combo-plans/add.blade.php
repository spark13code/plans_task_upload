@extends('layout.layout')

@section('content')
            
<div class="main-panel">
          <div class="content-wrapper">
            <div class="row">
              <div class="col-sm-12">
              <div class="home-tab">

                <div class="d-sm-flex align-items-center justify-content-between border-bottom pb-2 mb-4">
                  
                <span class="fs-4 fw-bold">Add Combo Plan</span>

                <a href="{{ route('plans.list') }}" id="list-page" class="btn btn-primary text-white me-0"><i class="fa fa-arrow-left"></i> Go to list</a>
                   
                </div>

                <!-- Main Content -->

                <div class="mb-3">
                <span class="error-global error"></span>
                <span class="success-global success"></span>
                </div>

                <div class="col-md-12 grid-margin stretch-card">

                <div class="card">
                  <div class="card-body">
                    
                    <form class="forms-sample" id="plan-form">
                    @csrf
                    <input type="hidden" name="id" id="id" @if(isset($data->id)) value="{{ $data->id }}" @endif>

                      <div class="form-group">
                        <label for="plan_name">Plan Name</label>
                        <input type="text" class="form-control" id="plan_name" name="plan_name" placeholder="Plan Name" autocomplete="off" @if(isset($data->name)) value="{{ $data->name }}" @endif>
                      </div>
                      
                      <div class="form-group">
                        <label for="plan_price">Plan Price</label>
                        <input type="text" class="form-control" id="plan_price" name="plan_price" placeholder="Plan Price" autocomplete="off" @if(isset($data->price)) value="{{ $data->price }}" @endif>
                      </div>


                      <div class="table-responsive">
                      <table class="table table-hover" id="plan-table">
                        <thead>
                          <tr>
                            <th>select</th>
                            <th>Plan Name</th>
                            <th>Plan Price</th>
                          </tr>
                        </thead>
                        <tbody>
                        </tbody>
                      </table>
                    </div>

                      

                      <button type="submit" class="btn btn-primary text-white me-2">Submit</button>
                      <button class="btn btn-light">Cancel</button>
                    </form>
                  </div>
                </div>
              </div>

                <!--END : Main Content -->

                
              </div>
                  </div>
                </div>
              </div>
              </div>

@endsection


@section('js')

<script>
    $(document).ready(function () {
        
        $('#plan-form').validate({
            rules: {
                plan_name: {
                    required: true,
                },
                plan_price: {
                    required: true,
                    number: true 
                },
                plans: {
                    required: true,
                }
            },
            messages: {
                plan_name: {
                    required: "Please enter plan name.",
                },
                plan_price: {
                    required: "Please enter plan price.",
                    number: "Please enter valid price."
                },
                plans: {
                    required: "Please select plan.",
                }
            },
            submitHandler: function (form) {
                $.ajax({
                url: '/insert-update-combo-plan', 
                type: 'POST',
                data: $(form).serialize(), // Serialize form data
                success: function (response) {
                    // Handle success response
                    $('.success-global').html('Plan inserted successfully!');
                    window.location = "/combo-plans";
                },
                error: function (error) {
                    // Handle error response
                    $('.error-global').html('An error occurred: ' + error.responseText);
                }
            });
            }
        });
   
        let id = $('#id').val();

    $('#plan-table').DataTable({
        processing: true, // Show processing indicator
        serverSide: true, // Enable server-side processing
        ajax: {
            url: '/get-plans-for-combo/'+id, // Endpoint to fetch data
            type: 'GET'
        },
        columns: [
            { data: 'action', name: 'action', orderable: false, searchable: false }, // Action column
            { data: 'plan_name', name: 'plan_name' },
            { data: 'plan_price', name: 'plan_price' },
        ]
    });
});
</script>
@endsection