
@extends('admin.layouts.contentLayoutMaster')

@section('title', 'Hospital')

@section('vendor-style')
  {{-- Vendor Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/wizard/bs-stepper.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/file-uploaders/dropzone.min.css')) }}">
@endsection

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-wizard.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-file-uploader.css')) }}">
@endsection

@section('content')
@include('admin.components.navHeader.hospital-nav-header')
<section class="bs-validation">
    <div class="row">
      <!-- jQuery Validation -->
      <div class="col-md-12 col-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Create</h4>
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
            <section class="horizontal-wizard">
                <div class="bs-stepper horizontal-wizard-example">
                  <div class="bs-stepper-header" role="tablist">
                    <div class="step" data-target="#account-details" role="tab" id="account-details-trigger">
                      <button type="button" class="step-trigger">
                        <span class="bs-stepper-box">1</span>
                        <span class="bs-stepper-label">
                          <span class="bs-stepper-title">Owner Details</span>
                          <span class="bs-stepper-subtitle">Add Personal Info </span>
                        </span>
                      </button>
                    </div>
                    <div class="line">
                      <i data-feather="chevron-right" class="font-medium-2"></i>
                    </div>
                    <div class="step" data-target="#personal-info" role="tab" id="personal-info-trigger">
                      <button type="button" class="step-trigger">
                        <span class="bs-stepper-box">2</span>
                        <span class="bs-stepper-label">
                          <span class="bs-stepper-title">Hospital Info</span>
                          <span class="bs-stepper-subtitle">Setup Hospital Details</span>
                        </span>
                      </button>
                    </div>
                    <div class="line">
                        <i data-feather="chevron-right" class="font-medium-2"></i>
                      </div>
                    <div class="step" data-target="#images" role="tab" id="upload-images-trigger">
                        <button type="button" class="step-trigger">
                            <span class="bs-stepper-box">2</span>
                            <span class="bs-stepper-label">
                            <span class="bs-stepper-title">Upload Images</span>
                            <span class="bs-stepper-subtitle">Upload Hospital Images</span>
                            </span>
                        </button>
                    </div>
                  </div>
                    <div class="bs-stepper-content">
                        <div id="account-details" class="content" role="tabpanel" aria-labelledby="account-details-trigger">
                        <div class="content-header">
                            <h5 class="mb-0">Owner Details</h5>

                        </div>
                        <form>
                            <div class="row">
                            <div class="mb-1 col-md-6">
                                <label class="form-label" for="username">First Name</label>
                                <input type="text" name="first_name" id="first_name" class="form-control" placeholder="First Name" />
                            </div>
                            <div class="mb-1 col-md-6">
                                <label class="form-label" for="email">Last Name</label>
                                <input
                                type="text"
                                name="last_name"
                                id="last_name"
                                class="form-control"
                                placeholder="Last Name"
                                aria-label=""
                                />
                            </div>
                            </div>
                            <div class="row">
                                <div class="mb-1 col-md-6">
                                <label class="form-label" for="username">Username</label>
                                <input type="text" name="user_name" id="user_name" class="form-control" placeholder="User Name" />
                                </div>
                                <div class="mb-1 col-md-6">
                                <label class="form-label" for="email">Email</label>
                                <input
                                    type="email"
                                    name="email"
                                    id="email"
                                    class="form-control"
                                    placeholder="john.doe@email.com"
                                    aria-label="john.doe"
                                />
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-1 col-md-6">
                                <label class="form-label" for="mobile">Mobile</label>
                                <input type="number" name="mobile" id="mobile" class="form-control" placeholder="Mobile" />
                                </div>
                                <div class="mb-1 col-md-6">
                                    <label class="form-label" for="select-state">State</label>
                                    <select class="form-select select2" id="state_id" name="state_id">
                                        <option value="">Select Type</option>
                                        @foreach ($data['state'] as $state)
                                        <option value="{{$state->id}}">{{$state->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-1 col-md-6">
                                    <label class="form-label" for="select-city">City</label>
                                    <select class="form-select select2" id="city_id" name="city_id">
                                        <option value="">Select Type</option>
                                        @foreach ($data['city'] as $city)
                                        <option value="{{$city->id}}">{{$city->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-1 col-md-6">
                                <label class="form-label" for="email">Pin Code</label>
                                <input type="number" name="postcode" id="postcode" class="form-control" placeholder="Pin Code" />
                                </div>
                            </div>
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

                            <div class="row">
                            <div class="mb-1 form-password-toggle col-md-6">
                                <label class="form-label" for="password">Password</label>
                                <input
                                type="password"
                                name="password"
                                id="password"
                                class="form-control"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                />
                            </div>
                            <div class="mb-1 form-password-toggle col-md-6">
                                <label class="form-label" for="confirm-password">Confirm Password</label>
                                <input
                                type="password"
                                name="confirm-password"
                                id="confirm-password"
                                class="form-control"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                />
                            </div>
                            </div>
                        </form>
                            <div class="d-flex justify-content-between">
                                <button class="btn btn-outline-secondary btn-prev" disabled>
                                <i data-feather="arrow-left" class="align-middle me-sm-25 me-0"></i>
                                <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                </button>
                                <button class="btn btn-primary btn-next">
                                <span class="align-middle d-sm-inline-block d-none">Next</span>
                                <i data-feather="arrow-right" class="align-middle ms-sm-25 ms-0"></i>
                                </button>
                            </div>
                        </div>
                        <div id="personal-info" class="content" role="tabpanel" aria-labelledby="personal-info-trigger">
                            <div class="content-header">
                                <h5 class="mb-0">Hospital Info</h5>
                                {{-- <small>Enter Your Personal Info.</small> --}}
                            </div>
                            <form>
                                <div class="row">
                                    <div class="mb-1 col-md-6">
                                        <label class="form-label" for="org_name">Hospital Name</label>
                                        <input type="text" name="profile_org_name" id="profile_org_name" class="form-control" placeholder="Hospital Name" />
                                    </div>
                                    <div class="mb-1 col-md-6">
                                        <label class="form-label" for="reg_number">Registration Number</label>
                                        <input type="text" name="profile_reg_number" id="profile_reg_number" class="form-control" placeholder="Registration Number" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-1 col-md-6">
                                    <label class="form-label" for="contact_person">Contact Person</label>
                                    <input type="text" name="profile_contact_person" id="profile_contact_person" class="form-control" placeholder="Contact Person" />
                                    </div>
                                    <div class="mb-1 col-md-6">
                                    <label class="form-label" for="phone">Phone Number</label>
                                    <input type="number" name="profile_phone" id="profile_phone" class="form-control" placeholder="Phone Number" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-1 col-md-6">
                                    <label class="form-label" for="email">Email</label>
                                    <input type="email" name="profile_email" id="profile_email" class="form-control" placeholder="Email" />
                                    </div>
                                    <div class="mb-1 col-md-6">
                                    <label class="form-label" for="alt_number">Alternate Number</label>
                                    <input type="number" name="profile_alt_number" id="profile_alt_number" class="form-control" placeholder="Alternate Number" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-1 col-md-6">
                                    <label class="form-label" for="type">Type</label>
                                        <select class="select2 w-100" id="profile_type" name="profile_type">
                                            <option label=""></option>
                                            <option value="1">Indivisual</option>
                                            <option value="2">LLP</option>
                                            <option value="3">OPC</option>
                                            <option value="4">Propietorship</option>
                                            <option value="5">Partnership</option>
                                            <option value="6">Pvt. Ltd.</option>
                                            <option value="7">Ltd.</option>
                                            <option value="8">Other</option>
                                        </select>
                                    </div>
                                    <div class="mb-1 col-md-6">
                                        <label class="form-label" for="speciality">Speciality </label>
                                        <input type="text" name="profile_speciality" id="profile_speciality" class="form-control" placeholder="Speciality " />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-1 col-md-6">
                                        <label class="form-label" for="feature_id">Feature</label>
                                        <select class="select2 w-100" name="profile_feature_id[]" id="profile_feature_id" multiple>
                                            <option value="">Select Type</option>
                                            @foreach ($data['feature'] as $feature)
                                                <option value="{{$feature->id}}">{{$feature->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-1 col-md-6">
                                        <label class="form-label" for="amenity_id">Amenity</label>
                                        <select class="select2 w-100" name="profile_amenity_id[]" id="profile_amenity_id" multiple>
                                            @foreach ($data['amenity'] as $amenity)
                                                <option value="{{$amenity->id}}">{{$amenity->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-1 col-md-6">
                                    <label class="form-label" for="address">Address</label>
                                    <input
                                        type="text"
                                        id="profile_address"
                                        name="profile_address"
                                        class="form-control"
                                        placeholder="98  Borough bridge Road, Birmingham"
                                    />
                                    </div>

                                    <div class="mb-1 col-md-6">
                                        <label class="form-label" for="city1">State</label>
                                        <select class="form-select select2" id="profile_state_id" name="profile_state_id">
                                            <option value="">Select Type</option>
                                            @foreach ($data['state'] as $state)
                                            <option value="{{$state->id}}">{{$state->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-1 col-md-6">
                                        <label class="form-label" for="select-city">City</label>
                                        <select class="form-select select2" id="profile_city_id" name="profile_city_id">
                                            <option value="">Select Type</option>
                                            @foreach ($data['city'] as $city)
                                            <option value="{{$city->id}}">{{$city->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-1 col-md-6">
                                        <label class="form-label" for="email">Pin Code</label>
                                        <input type="number" name="profile_postcode" id="profile_postcode" class="form-control" placeholder="Pin Code" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-1 col-md-6">
                                        <label class="form-label" for="latitude">Latitude</label>
                                        <input type="text" name="profile_latitude" id="profile_latitude" class="form-control" placeholder="25.334445" />
                                    </div>
                                    <div class="mb-1 col-md-6">
                                        <label class="form-label" for="longitude">Longitude</label>
                                        <input type="text" name="profile_longitude" id="profile_longitude" class="form-control" placeholder="24.567890" />
                                    </div>
                                </div>
                            </form>
                            <div class="d-flex justify-content-between">
                                <button class="btn btn-primary btn-prev">
                                    <i data-feather="arrow-left" class="align-middle me-sm-25 me-0"></i>
                                    <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                    </button>
                                <button class="btn btn-primary btn-next">
                                  <span class="align-middle d-sm-inline-block d-none">Next</span>
                                  <i data-feather="arrow-right" class="align-middle ms-sm-25 ms-0"></i>
                                </button>
                            </div>

                        </div>
                        <div id="images" class="content" role="tabpanel" aria-labelledby="upload-images-trigger">
                            <div class="content-header">
                              <h5 class="mb-0">Upload Hospital Images</h5>
                            </div>
                            <form enctype="multipart/form-data">



                                <div class="row">
                                <div class="mb-1 form-password-toggle col-md-6">
                                    <label class="form-label" for="password">images</label>
                                    <input
                                    type="file"
                                    name="hospital_images"
                                    id="hospital_images"
                                    multiple
                                    class="form-control"

                                    />
                                </div>
                                <div class="mb-1 form-password-toggle col-md-6">
                                    <label class="form-label" for="password">imagestype</label>
                                    <input
                                    type="text"
                                    name="imagestype"
                                    id="imagestype"

                                    class="form-control"

                                    />
                                </div>

                                </div>
                            </form>

                            <div class="d-flex justify-content-between">
                                <button class="btn btn-primary btn-prev">
                                <i data-feather="arrow-left" class="align-middle me-sm-25 me-0"></i>
                                <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                </button>
                                <button class="btn btn-success btn-submit">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>

              </section>


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
  <script src="{{ asset(mix('vendors/js/forms/wizard/bs-stepper.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/file-uploaders/dropzone.min.js')) }}"></script>

@endsection
@section('page-script')
  <!-- Page js files -->
  <script src="{{ asset(mix('js/scripts/forms/form-validation.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/forms/form-wizard.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/forms/form-file-uploader.js')) }}"></script>
@endsection


