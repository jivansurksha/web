
@extends('admin.layouts.contentLayoutMaster')

@section('title', 'Amenity')

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
@include('admin.components.navHeader.amenity-nav-header')
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

            @if (isset($data['amenity']))
            <form id="jquery-val-form" action="{{ route('amenity-update')}}" method="post">
                @csrf
                @method('patch')
                <div class="row">
                    <input type="hidden" id='id' name='id' value="{{$data['amenity']->id}}"/>
                    <div class="col-md-6 col-12">
                        <div class="mb-1">
                            <label class="form-label" for="name">Amenity Name</label>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="{{$data['amenity']->name}}"
                                class="form-control"
                                placeholder="Amenity Name"
                            />
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="mb-1">
                            <label class="form-label" for="type">Type</label>
                            <input
                            type="text"
                            class="form-control"
                            id="type"
                            name="type"
                            value="{{$data['amenity']->type}}"
                            placeholder="Amenity Type"
                            />
                        </div>
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="is_active">Is Active</label>
                        <select class="form-select" id="is_active" name="is_active">
                            <option value="1" {{$data['amenity']->is_active ==1 ? 'selected' :''}}>Active</option>
                            <option value="0" {{$data['amenity']->is_active ==0 ? 'selected' :''}}>In Active</option>

                        </select>
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="description">Description</label>
                        <textarea
                        type="text"
                        class="form-control"
                        id="description"
                        name="description"
                        placeholder="Description"
                        >{{$data['amenity']->description}}</textarea>
                    </div>
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

@endsection


