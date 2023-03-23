<?php

namespace App\DataTables;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class HospitalDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->addColumn('action', function($row){
            return '<a href="user/edit/'.$row->id.'" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" class="delete btn btn-danger btn-sm">Delete</a>';
        })
        ->editColumn('user_id', function ($row) {
            return $row->owner->first_name;
        })
        ->editColumn('state_id', function ($row) {
            return $row->state !=null ? $row->state->name :'';
        })
        ->editColumn('city_id', function ($row) {
            return $row->city !=null?$row->city->name:'';
        })

        ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Profile $model): QueryBuilder
    {
        $profiles = $model->newQuery()->with('owner','creator')->latest();
        return $this->applyScopes($profiles);
    }

    // public function ajax()
    // {

    //     return $this->datatables
    //     ->eloquent($this->query())
    //     ->make(true);

    // }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('hospitals-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     *
     * @return array
     */
    public function getColumns(): array
    {
        return [
            // Column::make('responsive_id'),
            Column::make('id'),
            Column::make('Owner Name'),
            Column::make('contact_person'),
            Column::make('Phone'),
            Column::make('Email'),
            Column::make('Hospital Name'),
            Column::make('Registration Number'),
            Column::make('Speciality'),
            Column::make('Address'),
            Column::make('State'),
            Column::make('City'),
            Column::make('Pincode'),
            Column::make('is_active'),
            Column::computed('action')
            ->exportable(false)
            ->printable(false)
            // ->width(100)
            ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Users_' . date('YmdHis');
    }
}
