
@extends('admin.layouts.contentLayoutMaster')
@section('title', 'Commission list')

@section('vendor-style')
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">

@endsection

@section('content')
@include('admin.components.navHeader.commission-nav-header')
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
                                <h4 class="card-title">commission List</h4>
                            </div>
                            <div class="card-datatable">
                                {{$dataTable->table()}}
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
  <script src="{{ asset(mix('vendors/js/extensions/sweetalert2.all.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap5.js')) }}"></script>

@endsection

@section('page-script')
<script src="{{ asset(mix('js/custom/custom.js')) }}"></script>

@endsection



