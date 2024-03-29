<?php

namespace App\DataTables;

use App\Models\Amenity;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AmenityDataTable extends DataTable
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
            $model="'amenity'";
            return '<div class="dropdown">
            <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                <i data-feather="more-vertical"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-end">
                <a class="dropdown-item" href="amenity/edit/'.$row->id.'">
                    <i data-feather="edit-2" class="me-50"></i>
                    <span>Edit</span>
                </a>
                <a class="dropdown-item" onClick="deleteConfirmation('.$row->id.','.$model.')">
                    <i data-feather="trash" class="me-50"></i>
                    <span>Delete</span>
                </a>
            </div>
        </div>';
        })
        ->editColumn('is_active', function ($row) {
            if($row->is_active == 0){
                return "In Active";
            }else{
                return "Active";
            }
        })
        ->editColumn('created_at', function ($row) {
            return Carbon::parse($row->created_at)->format('Y/m/d');
        })
        ->editColumn('updated_at', function ($row) {
            return Carbon::parse($row->created_at)->format('Y/m/d');
        })

        ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Amenity $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Amenity $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('amenity-table')
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
            Column::make('id'),
            Column::make('name'),
            Column::make('type'),
            Column::make('description'),
            Column::make('is_active'),
            Column::make('created_at'),
            Column::make('updated_at'),
            Column::computed('action')
            ->exportable(false)
            ->printable(false)
            // ->width(60)
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
        return 'Amenity_' . date('YmdHis');
    }
}
