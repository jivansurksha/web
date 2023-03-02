
@extends('admin.layouts.contentLayoutMaster')
@section('title', 'User list')
@section('vendor-style')
  {{-- vendor css files --}}
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
@endsection

@section('page-style')
{{-- Page Css files --}}
<link rel="stylesheet" type="text/css" href="{{asset('css/base/plugins/forms/pickers/form-flat-pickr.css')}}">
@endsection


@section('content')
@include('admin.components.navHeader.user-nav-header')
<section id="basic-tabs-components">
    <div class="row match-height">
      <!-- Basic Tabs starts -->
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-body">
                    <!-- Responsive Datatable -->
                    <section id="responsive-datatable">
                        <div class="row">
                        <div class="col-12">
                            <div class="card">
                            <div class="card-header border-bottom">
                                <h4 class="card-title">User List</h4>
                            </div>
                            <div class="card-datatable">
                                {{-- datavale html render defaul --}}
                                {{-- {{$dataTable->table()}} --}}
                                <table id="users" class="table">
                                <thead>
                                    <tr>
                                    <th></th>

                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>User Name</th>
                                    <th>Gender</th>
                                    <th>User Type</th>
                                    <th>action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                    <th></th>

                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>User Name</th>
                                    <th>Gender</th>
                                    <th>User Type</th>
                                    <th>action</th>
                                    </tr>
                                </tfoot>
                                </table>
                                {{-- <table class="dt-responsive table">
                                <thead>
                                    <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Post</th>
                                    <th>City</th>
                                    <th>Date</th>
                                    <th>Salary</th>
                                    <th>Age</th>
                                    <th>Experience</th>
                                    <th>Status</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Post</th>
                                    <th>City</th>
                                    <th>Date</th>
                                    <th>Salary</th>
                                    <th>Age</th>
                                    <th>Experience</th>
                                    <th>Status</th>
                                    </tr>
                                </tfoot>
                                </table> --}}
                            </div>
                            </div>
                        </div>
                        </div>
                    </section>
                    <!--/ Responsive Datatable -->
                </div>
            </div>
        </div>
    </div>
</section>

@endsection


@section('vendor-script')
{{-- vendor files --}}
  <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap5.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
@endsection

@section('page-script')
<script src="{{ asset(mix('js/custom/custom.js')) }}"></script>
  {{-- Page js files --}}
  {{-- <script src="{{ asset(mix('js/scripts/tables/table-datatables-advanced.js')) }}"></script> --}}
@endsection

@push('scripts')
    <script>
        // {{$dataTable->scripts()}}
        usersdata();
    </script>
@endpush
