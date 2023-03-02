
@extends('admin.layouts.contentLayoutMaster')

@section('title', 'Register User')

@section('vendor-style')
  {{-- Vendor Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
@endsection

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-flat-pickr.css')) }}">
@endsection

@section('content')
@include('admin.components.navHeader.user-nav-header')
<section class="bs-validation">
    <div class="row">
      <!-- jQuery Validation -->
      <div class="col-md-12 col-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Update</h4>
          </div>
          <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (isset($data['user']))
                <form id="jquery-val-form" action="{{ route('update')}}" method="post">
                    @csrf
                    @method('patch')
                    <div class="row">
                        <input type="hidden" id='id' name='id' value="{{$data['user']->id}}"/>
                        <div class="mb-1">
                            <label class="form-label" for="user_name">Email</label>
                            <input
                              type="email"
                              id="user_name"
                              name="user_name"
                              class="form-control"
                              value="{{$data['user']->user_name}}"
                              placeholder="john.doe@email.com"
                            />
                          </div>
                        <div class="col-md-6 col-12">
                            <div class="mb-1">
                              <label class="form-label" for="first-name-column">First Name</label>
                              <input
                                type="text"
                                class="form-control"
                                id="first_name"
                                name="first_name"
                                value="{{$data['user']->first_name}}"
                                placeholder="John Doe"
                              />
                            </div>
                          </div>
                          <div class="col-md-6 col-12">
                            <div class="mb-1">
                              <label class="form-label" for="last-name-column">Last Name</label>
                              <input
                                type="text"
                                class="form-control"
                                id="last_name"
                                name="last_name"
                                value="{{$data['user']->last_name}}"
                                placeholder="John Doe"
                              />
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="mb-1">
                              <label class="form-label" for="state">State</label>
                                <select class="form-select select2" id="state" name="state">
                                <option value="">Select Type</option>
                                @foreach ($data['state'] as $state)
                                    <option value="{{$state->id}}" {{$state->id == $data['user']->state_id ? 'selected' : ''}}>{{$state->name}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="mb-1">
                              <label class="form-label" for="city">City</label>
                              <select class="form-select select2" id="city" name="city">
                                <option value="">Select Type</option>
                                    @foreach ($data['city'] as $city)
                                        <option value="{{$city->id}}" {{$city->id == $data['user']->city_id ? 'selected' : ''}}>{{$city->name}}</option>
                                    @endforeach
                                </select>
                              {{-- <input
                                type="text"
                                id="city"
                                class="form-control"
                                value="{{$data['user']->city !=null ? $data['user']->city->name :''}}"
                                placeholder="City Name"
                                name="city"
                              /> --}}
                            </div>
                          </div>

                    </div>

                  {{-- <div class="mb-1">
                    <label class="form-label" for="select-state">User Type</label>
                    <select class="form-select select2" id="select-state" name="select-state">
                      <option value="">Select Type</option>
                      <option value="usa">Employee</option>
                      <option value="uk">UK</option>
                      <option value="france">France</option>
                      <option value="australia">Australia</option>
                      <option value="spain">Spain</option>
                    </select>
                  </div> --}}
                  <div class="mb-1">
                    <label class="d-block form-label">Gender</label>
                    <div class="form-check my-50">
                      <input type="radio" id="gender1" name="gender" value="M" class="form-check-input" {{$data['user']->gender=='M' ? 'checked':''}}/>
                      <label class="form-check-label" for="gender1">Male</label>
                    </div>
                    <div class="form-check">
                      <input type="radio" id="gender2" name="gender" value="F" class="form-check-input" {{$data['user']->gender=='F' ? 'checked':''}} />
                      <label class="form-check-label" for="gender2">Female</label>
                    </div>
                  </div>


                  <button type="submit" class="btn btn-primary" name="submit" value="Submit">Update</button>
                </form>
            @endif

          </div>
        </div>
      </div>
      <!-- /jQuery Validation -->
    </div>
  </section>


@endsection

@section('vendor-script')
  <!-- vendor files -->
  <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
@endsection
@section('page-script')
  <!-- Page js files -->
  <script src="{{ asset(mix('js/scripts/forms/form-validation.js')) }}"></script>
  <script>
      @if(Session::has('message'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
  		toastr.success("{{ session('message') }}");
  @endif

  @if(Session::has('error'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
  		toastr.error("{{ session('error') }}");
  @endif

  @if(Session::has('info'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
  		toastr.info("{{ session('info') }}");
  @endif

  @if(Session::has('warning'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
  		toastr.warning("{{ session('warning') }}");
  @endif
    </script>
@endsection


