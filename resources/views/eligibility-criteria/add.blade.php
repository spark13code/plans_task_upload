@extends('layout.layout')

@section('content')
            
<div class="main-panel">
          <div class="content-wrapper">
            <div class="row">
              <div class="col-sm-12">
              <div class="home-tab">

                <div class="d-sm-flex align-items-center justify-content-between border-bottom pb-2 mb-4">
                  
                <span class="fs-4 fw-bold">Add Eligible Criteria</span>

                <a href="{{ route('eligibility-criteria.list') }}" id="list-page" class="btn btn-primary text-white me-0"><i class="fa fa-arrow-left"></i> Go to list</a>
                   
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
                    <input type="hidden" name="id" @if(isset($data->id)) value="{{ $data->id }}" @endif>

                      <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" autocomplete="off" @if(isset($data->name)) value="{{ $data->name }}" @endif>
                      </div>
                      
                      <div class="form-group">
                        <label for="age_less_than">Age less than</label>
                        <input type="text" class="form-control" id="age_less_than" name="age_less_than" placeholder="Age Less Than" autocomplete="off" @if(isset($data->age_less_than)) value="{{ $data->age_less_than }}" @endif> 
                      </div>

                      <div class="form-group">
                        <label for="age_greater_than">Age Greater Than</label>
                        <input type="text" class="form-control" id="age_greater_than" name="age_greater_than" placeholder="Age Greater Than" autocomplete="off" @if(isset($data->age_greater_than)) value="{{ $data->age_less_than }}" @endif> 
                       
                      </div>

                      <div class="form-group">
                        <label for="last_login_days_ago">Last Login Days Ago</label>
                        <input class="form-control" name="last_login_days_ago" id="last_login_days_ago" placeholder="Last Login Days Ago" autocomplete="off" @if(isset($data->last_login_days_ago)) value="{{ $data->last_login_days_ago }}" @endif>
                      </div>

                      <div class="form-group">
                        <label for="income_less_than">Income Less Than</label>
                        <input class="form-control" name="income_less_than" id="income_less_than" placeholder="Income Less Than" autocomplete="off" @if(isset($data->income_less_than)) value="{{ $data->income_less_than }}" @endif >
                      </div>

                      <div class="form-group">
                        <label for="income_greater_than">Income Greater Than</label>
                        <input class="form-control" name="income_greater_than" id="income_greater_than" placeholder="Income Greater Than" autocomplete="off" @if(isset($data->income_greater_than)) value="{{ $data->income_greater_than }}" @endif >
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
                name: {
                    required: true,
                },
                age_less_than: {
                    required: true,
                    number: true,
                    min:1 
                },
                age_greater_than: {
                    required: true,
                    number: true,
                    min:1
                },
                last_login_days_ago: {
                    required: true,
                    number: true,
                    min:1
                },
                income_less_than: {
                    required: true,
                    number: true,
                    min:1
                },
                income_greater_than: {
                    required: true,
                    number: true,
                    min:1
                },
            },
            messages: {
                name: {
                    required: "Please enter name.",
                },
                age_less_than: {
                    required: "Please enter age less than",
                    number: "Please enter valid value",
                    min: "Please enter value greter than 1"
                },
                age_greater_than: {
                    required: "Please enter age greater than",
                    number: "Please enter valid value",
                    min: "Please enter value greter than 1"
                },
                last_login_days_ago: {
                    required: "Please enter last login days ago",
                    number: "Please enter valid value",
                    min: "Please enter value greter than 1"
                },
                income_less_than: {
                    required: "Please enter income less than",
                    number: "Please enter valid value",
                    min: "Please enter value greter than 1"
                },
                income_greater_than: {
                    required: "Please enter income greater than",
                    number: "Please enter valid value",
                    min: "Please enter value greter than 1"
                },
            },
            submitHandler: function (form) {
                $.ajax({
                url: '/insert-update-eligible-criteria', 
                type: 'POST',
                data: $(form).serialize(), // Serialize form data
                success: function (response) {
                    // Handle success response
                    $('.success-global').html('Eligible Criteria inserted successfully!');
                    window.location = "/eligibility-criteria";
                },
                error: function (error) {
                    // Handle error response
                    $('.error-global').html('An error occurred: ' + error.responseText);
                }
            });
            }
        });
    });
</script>
@endsection