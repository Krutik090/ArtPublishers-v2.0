<?php

namespace App\DataTables;

use App\Models\Location;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class LocationDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function($query){
                $edit = '<a href="'.route('location.edit',$query->id).'" class="btn btn-md btn-primary" ><i class="fas fa-edit"></i></a>';
                $delete = '<a href="'.route('location.destroy',$query->id).'" class="delete-item btn btn-md btn-danger ml-3" ><i class="fas fa-trash-alt"></i></a>';

                return $edit.$delete;
            })
            ->addColumn('show_at_home', function ($query) {
                if ($query->show_at_home == 1) {
                    return '<span class="badge badge-primary">Yes</span>';
                } else {
                    return '<span class="badge badge-danger">No</span>';
                }
            })
            ->addColumn('status',function($query){
                if($query->status == 1){
                    return '<span class="badge badge-primary">Active</span>';
                }else{
                    return '<span class="badge badge-danger">Inactive</span>';
                }
            })
            ->rawColumns(['action','show_at_home','status'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Location $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('location-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(0)
            ->selectStyleSingle();

    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [

            Column::make('id')->width(100)
            ,
            Column::make('name')->width(200),
            Column::make('show_at_home')->width(200),
            Column::make('status')->width(200),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(200)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Location_' . date('YmdHis');
    }
}
