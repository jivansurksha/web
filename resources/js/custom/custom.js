
// function usersdata ()
// {

    var dt_responsive_table = $("#users");
    // var assetPath = '../../app-assets/';
    dt_responsive_table.DataTable({
        processing: true,
        serverSide: true,
      ajax:"user",
      data: {
        _token: $('input[name="_token"]').val()
        },
      columns: [
        // { data: 'responsive_id'},
        {data: 'id', name: 'id',
            orderable: false,
            searchable: false,
        },
        {data: 'first_name', name: 'first_name'},
        { data: 'last_name',name: 'last_name' },
        { data: 'user_name',name: 'user_name' },
        { data: 'gender', name: 'gender' },
        { data: 'user_type',name: 'user_type' },
        { data: 'action',name: 'action' }
      ],
      columnDefs: [
        {
          className: 'control',
          orderable: false,
          targets: 0
        },
        {
          // Label
          targets: -1,
          render: function (data, type, full, meta) {
            console.log(data);
            var $status_number = full['status'];
            var $status = {
              1: { title: 'Current', class: 'badge-light-primary' },
              2: { title: 'Professional', class: ' badge-light-success' },
              3: { title: 'Rejected', class: ' badge-light-danger' },
              4: { title: 'Resigned', class: ' badge-light-warning' },
              5: { title: 'Applied', class: ' badge-light-info' }
            };
            if (typeof $status[$status_number] === 'undefined') {
              return data;
            }
            return (
              '<span class="badge rounded-pill ' +
              $status[$status_number].class +
              '">' +
              $status[$status_number].title +
              '</span>'
            );
          }
        }
      ],
      dom: '<"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
      responsive: {
        details: {
          display: $.fn.dataTable.Responsive.display.modal({
            header: function (row) {
              var data = row.data();
              return 'Details of ' + data['full_name'];
            }
          }),
          type: 'column',
          renderer: function (api, rowIdx, columns) {
            var data = $.map(columns, function (col, i) {
              return col.title !== '' // ? Do not show row in modal popup if title is blank (for check box)
                ? '<tr data-dt-row="' +
                    col.rowIdx +
                    '" data-dt-column="' +
                    col.columnIndex +
                    '">' +
                    '<td>' +
                    col.title +
                    ':' +
                    '</td> ' +
                    '<td>' +
                    col.data +
                    '</td>' +
                    '</tr>'
                : '';
            }).join('');

            return data ? $('<table class="table"/>').append('<tbody>' + data + '</tbody>') : false;
          }
        }
      },
      language: {
        paginate: {
          // remove previous & next text from pagination
          previous: '&nbsp;',
          next: '&nbsp;'
        }
      }
    });

    // var dt_ajax_table = $('.datatables-ajax'),
    // dt_filter_table = $('.dt-column-search'),
    // dt_adv_filter_table = $('.dt-advanced-search'),
    // dt_responsive_table = $('.dt-responsive'),
    // assetPath = '../../';
    // var dt_responsive = dt_responsive_table.DataTable({
    //     ajax: assetPath + 'data/table-datatable.json',
    //     columns: [
    //       { data: 'responsive_id' },
    //       { data: 'full_name' },
    //       { data: 'email' },
    //       { data: 'post' },
    //       { data: 'city' },
    //       { data: 'start_date' },
    //       { data: 'salary' },
    //       { data: 'age' },
    //       { data: 'experience' },
    //       { data: 'status' }
    //     ],
    //     columnDefs: [
    //       {
    //         className: 'control',
    //         orderable: false,
    //         targets: 0
    //       },
    //       {
    //         // Label
    //         targets: -1,
    //         render: function (data, type, full, meta) {
    //             console.log(data);
    //           var $status_number = full['status'];
    //           var $status = {
    //             1: { title: 'Current', class: 'badge-light-primary' },
    //             2: { title: 'Professional', class: ' badge-light-success' },
    //             3: { title: 'Rejected', class: ' badge-light-danger' },
    //             4: { title: 'Resigned', class: ' badge-light-warning' },
    //             5: { title: 'Applied', class: ' badge-light-info' }
    //           };
    //           if (typeof $status[$status_number] === 'undefined') {
    //             return data;
    //           }
    //           return (
    //             '<span class="badge rounded-pill ' +
    //             $status[$status_number].class +
    //             '">' +
    //             $status[$status_number].title +
    //             '</span>'
    //           );
    //         }
    //       }
    //     ],
    //     dom: '<"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
    //     responsive: {
    //       details: {
    //         display: $.fn.dataTable.Responsive.display.modal({
    //           header: function (row) {
    //             var data = row.data();
    //             return 'Details of ' + data['full_name'];
    //           }
    //         }),
    //         type: 'column',
    //         renderer: function (api, rowIdx, columns) {
    //           var data = $.map(columns, function (col, i) {
    //             return col.title !== '' // ? Do not show row in modal popup if title is blank (for check box)
    //               ? '<tr data-dt-row="' +
    //                   col.rowIdx +
    //                   '" data-dt-column="' +
    //                   col.columnIndex +
    //                   '">' +
    //                   '<td>' +
    //                   col.title +
    //                   ':' +
    //                   '</td> ' +
    //                   '<td>' +
    //                   col.data +
    //                   '</td>' +
    //                   '</tr>'
    //               : '';
    //           }).join('');

    //           return data ? $('<table class="table"/>').append('<tbody>' + data + '</tbody>') : false;
    //         }
    //       }
    //     },
    //     language: {
    //       paginate: {
    //         // remove previous & next text from pagination
    //         previous: '&nbsp;',
    //         next: '&nbsp;'
    //       }
    //     }
    //   });



    $("#hospitals-table").DataTable({
        processing: true,
        serverSide: true,
        ajax:"hospital",
        data: {
            _token: $('input[name="_token"]').val()
            },
        columns: [
            // { data: 'responsive_id'},
            {data: 'id', name: 'id',
                orderable: false,
                searchable: false,
            },
            { data: 'name', name: 'name'},
            { data: 'type',name: 'type' },
            { data: 'description',name: 'description' },
            { data: 'is_active',name: 'is_active' },
            { data: 'created_at',name: 'created_at' },
            { data: 'updated_at', name: 'updated_at' },
            { data: 'action',name: 'action' }
        ],
        columnDefs: [
            {
            className: 'control',
            orderable: false,
            targets: 0
            }

        ],
        language: {
            paginate: {
            // remove previous & next text from pagination
            previous: '&nbsp;',
            next: '&nbsp;'
            }
        }
    });


    //amenity
    $("#amenity-table").DataTable({
        processing: true,
        serverSide: true,
      ajax:"amenity",
      data: {
        _token: $('input[name="_token"]').val()
        },
      columns: [
        // { data: 'responsive_id'},
        {data: 'id', name: 'id',
            orderable: false,
            searchable: false,
        },
        { data: 'name', name: 'name'},
        { data: 'type',name: 'type' },
        { data: 'description',name: 'description' },
        { data: 'is_active',name: 'is_active' },
        { data: 'created_at',name: 'created_at' },
        { data: 'updated_at', name: 'updated_at' },
        { data: 'action',name: 'action' }
      ],
      columnDefs: [
        {
          className: 'control',
          orderable: false,
          targets: 0
        }

      ],
      language: {
        paginate: {
          // remove previous & next text from pagination
          previous: '&nbsp;',
          next: '&nbsp;'
        }
      }
    });

    //Feature
    $("#feature-table").DataTable({
        processing: true,
        serverSide: true,
        ajax:"feature",
        data: {
        _token: $('input[name="_token"]').val()
        },
        columns: [
        // { data: 'responsive_id'},
        {data: 'id', name: 'id',
            orderable: false,
            searchable: false,
        },
        { data: 'name', name: 'name'},
        { data: 'type',name: 'type' },
        { data: 'description',name: 'description' },
        { data: 'is_active',name: 'is_active' },
        { data: 'created_at',name: 'created_at' },
        { data: 'updated_at', name: 'updated_at' },
        { data: 'action',name: 'action' }
        ],
        columnDefs: [
        {
            className: 'control',
            orderable: false,
            targets: 0
        }

        ],
        language: {
        paginate: {
            // remove previous & next text from pagination
            previous: '&nbsp;',
            next: '&nbsp;'
        }
        }
    });


    //amenity
    $("#commission-table").DataTable({
        processing: true,
        serverSide: true,
      ajax:"commission",
      data: {
        _token: $('input[name="_token"]').val()
        },
      columns: [
        // { data: 'responsive_id'},
        {data: 'id', name: 'id',
            orderable: false,
            searchable: false,
        },
        { data: 'profile_id', name: 'profile_id'},
        { data: 'percentage', name: 'percentage'},
        { data: 'flat_rate', name: 'flat_rate'},
        // { data: 'Hospital Name', name: 'Hospital Name'},
        // { data: 'Commission Percentage',name: 'Commission Percentage' },
        // { data: 'Commission Flat Rate',name: 'Commission Flat Rate' },
        { data: 'is_active',name: 'is_active' },
        { data: 'action',name: 'action' }
      ],
      columnDefs: [
        {
          className: 'control',
          orderable: false,
          targets: 0
        }

      ],
      language: {
        paginate: {
          // remove previous & next text from pagination
          previous: '&nbsp;',
          next: '&nbsp;'
        }
      }
    });



      // Filter form control to default size for all tables
  $('.dataTables_filter .form-control').removeClass('form-control-sm');
  $('.dataTables_length .form-select').removeClass('form-select-sm').removeClass('form-control-sm');

// }


//sweet alert
function deleteConfirmation(id,model){

    var id = id;
    if(model=='feature'){
        var url ='';
    }else if(model=='amenity'){
        var url ='';
    }

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            customClass: {
            confirmButton: 'btn btn-primary',
            cancelButton: 'btn btn-outline-danger ms-1'
            },
            buttonsStyling: false
        }).then(function (result) {
            if (result.value) {
            Swal.fire({
                icon: 'success',
                title: 'Deleted!',
                text: 'Your file has been deleted.',
                customClass: {
                confirmButton: 'btn btn-success'
                }
            });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire({
                title: 'Cancelled',
                text: 'Your imaginary file is safe :)',
                icon: 'error',
                customClass: {
                confirmButton: 'btn btn-success'
                }
            });
            }
        });
}


