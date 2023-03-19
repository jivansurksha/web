<?php

namespace App\DataTables;

use App\Models\Commission;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CommissionDataTable extends DataTable
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
            return '<div class="dropdown">
                    <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                        <i data-feather="more-vertical"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="commission/edit/'.$row->id.'">
                            <i data-feather="edit-2" class="me-50"></i>
                            <span>Edit</span>
                        </a>
                        <a class="dropdown-item" onClick="deleteConfirmation('.$row->id.')">
                            <i data-feather="trash" class="me-50"></i>
                            <span>Delete</span>
                        </a>
                    </div>
                </div>';
        })
        ->editColumn('profile_id', function ($row) {
           return $row->hospital->org_name;
        })
        ->editColumn('is_active', function ($row) {
            if($row->is_active == 0){
                return "In Active";
            }else{
                return "Active";
            }
        })
        ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Commission $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Commission $model): QueryBuilder
    {
        return $model->newQuery()->with('hospital');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('commission-table')
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
            // Column::computed('action')
            //       ->exportable(false)
            //       ->printable(false)
            //       ->width(60)
            //       ->addClass('text-center'),
            Column::make('id'),
            Column::make('profile_id'),
            Column::make('percentage'),
            Column::make('flat_rate'),
            Column::make('is_active'),
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
        return 'Commission_' . date('YmdHis');
    }
}
