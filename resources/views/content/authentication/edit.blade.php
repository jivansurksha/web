
@extends('layouts/contentLayoutMaster')

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

<section class="bs-validation">
    <div class="row">
      <!-- jQuery Validation -->
      <div class="col-md-12 col-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Create User</h4>
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
            <form id="jquery-val-form" action="{{ route('register-user-save')}}" method="post">
                @csrf
              <div class="mb-1">
                <label class="form-label" for="first_name">First Name</label>
                <input
                  type="text"
                  class="form-control"
                  id="first_name"
                  name="first_name"
                  placeholder="John Doe"
                />
              </div>
              <div class="mb-1">
                <label class="form-label" for="last_name">Last Name</label>
                <input
                  type="text"
                  class="form-control"
                  id="last_name"
                  name="last_name"
                  placeholder="John Doe"
                />
              </div>
              <div class="mb-1">
                <label class="form-label" for="user_name">Email</label>
                <input
                  type="email"
                  id="user_name"
                  name="user_name"
                  class="form-control"
                  placeholder="john.doe@email.com"
                />
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
                  <input type="radio" id="gender1" name="gender" value="M" class="form-check-input" />
                  <label class="form-check-label" for="gender1">Male</label>
                </div>
                <div class="form-check">
                  <input type="radio" id="gender2" name="gender" value="F" class="form-check-input" />
                  <label class="form-check-label" for="gender2">Female</label>
                </div>
              </div>

              <div class="mb-1">
                <label class="form-label" for="select-state">State</label>
                <select class="form-select select2" id="select-state" name="select-state">
                  <option value="">Select State</option>
                  <option value="usa">USA</option>
                  <option value="uk">UK</option>
                  <option value="france">France</option>
                  <option value="australia">Australia</option>
                  <option value="spain">Spain</option>
                </select>
              </div>

              <div class="mb-1">
                <label class="form-label" for="password">Password</label>
                <input
                  type="password"
                  id="password"
                  name="password"
                  class="form-control"
                  placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                />
              </div>
              <div class="mb-1">
                <label class="form-label" for="confirm-password">Confirm Password</label>
                <input
                  type="password"
                  id="confirm-password"
                  name="confirm-password"
                  class="form-control"
                  placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                />
              </div>

              <button type="submit" class="btn btn-primary" name="submit" value="Submit">Submit</button>
            </form>
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


