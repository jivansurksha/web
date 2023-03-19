org_name
@extends('admin.layouts.contentLayoutMaster')

@section('title', 'Commission')

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
@include('admin.components.navHeader.commission-nav-header')
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
            @if (isset($data['commission']))
                <form id="jquery-val-form" action="{{ route('commission-update')}}" method="post">
                    @csrf
                    @method('patch')
                    <div class="row">
                        <input type="hidden" id='id' name='id' value="{{$data['commission']->id}}"/>
                        <div class="mb-1 col-md-6 col-12">
                            <label class="form-label" for="select-state">Hospital Name</label>
                            <select class="form-select select2" id="profile_id" name="profile_id">
                                <option value="">Select Type</option>
                                @foreach ($data['hospitals'] as $hospital)
                                    <option value="{{$hospital->id}}" {{$hospital->id == $data['commission']->profile_id ? 'selected' : ''}}>{{$hospital->org_name}}</option>

                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="mb-1">
                                <label class="form-label" for="type">Percentage %</label>
                                <input
                                type="text"
                                class="form-control"
                                id="percentage"
                                name="percentage"
                                value="{{$data['commission']->percentage}}"
                                placeholder="10 "
                                />
                            </div>
                        </div>
                    </div>
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="type">Is Flat Rate</label>
                                    <select class="form-select" id="is_flat_rate" name="is_flat_rate">
                                        <option value="">Select Type</option>
                                        <option value="1" {{$data['commission']->is_flat_rate ==1 ? 'selected' :''}}>Yes</option>
                                        <option value="0" {{$data['commission']->is_flat_rate ==0 ? 'selected' :''}}>No</option>
                                    </select>
                                </div>
                            </div>
                            <div id="flateRate" style="display:none;">
                                <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="type">Flat Rate</label>
                                        <input
                                        type="text"
                                        class="form-control"
                                        id="percentage"
                                        name="percentage"
                                        value="{{$data['commission']->flat_rate}}"
                                        placeholder="10 "
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="mb-1">
                            <label class="form-label" for="is_active">Is Active</label>
                            <select class="form-select" id="is_active" name="is_active">
                                <option value="1" {{$data['commission']->is_active ==1 ? 'selected' :''}}>Active</option>
                                <option value="0" {{$data['commission']->is_active ==0 ? 'selected' :''}}>In Active</option>

                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
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
     //commission flat rate active

     $('#is_flat_rate').on('change', function (e) {
        var optionSelected = $("option:selected", this);
        var valueSelected = this.value;
        if(valueSelected==1){
            $('#flateRate').css('display','block');
        }else{
            $('#flateRate').css('display','none');
        }
    });
    </script>
@endsection


