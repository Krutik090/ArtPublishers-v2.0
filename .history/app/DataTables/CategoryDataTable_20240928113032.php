<?php

namespace App\DataTables;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CategoryDataTable extends DataTable
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
                $edit = '<a href="'.route('category.edit',$query->id).'" class="btn btn-md btn-primary" ><i class="fas fa-edit"></i></a>';
                $delete = '<a href="'.route('category.destroy',$query->id).'" class="delete-item btn btn-md btn-danger ml-3" ><i class="fas fa-trash-alt"></i></a>';

                return $edit.$delete;
            })
            ->addColumn('icon',function($query){
                return '<img src="'.asset($query->image_icon).' " hight="75px" width="75px"></img>';
            })
            ->addColumn('background',function($query){
                return '<img src="'.asset($query->bg_image).' " hight="150px" width="210px"></img>';
            })
            ->addColumn('show_at_home',function($query){
                if($query->show_at_home == 1){
                    return '<span class="badge badge-primary">Yes</span>';
                }else{
                    return return '<span class="badge badge-primary">Yes</span>';
                }
            })
            ->addColumn('background',function($query){
                return '';
            })
            ->rawColumns(['icon','background','action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Category $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('category-table')
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
     */
    public function getColumns(): array
    {
        return [
            Column::make('id')->width(100),
            Column::make('name')->width(200),
            Column::make('icon'),
            Column::make('background'),
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
        return 'Category_' . date('YmdHis');
    }
}
