<?php

namespace App\DataTables;

use App\Models\Arts;
use App\Models\PendingArt;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PendingArtsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($query) {
                $edit = '<a href="' . route('arts.edit', $query->id) . '" class="btn btn-md btn-primary" ><i class="fas fa-edit"></i></a>';
                $delete = '<a href="' . route('arts.destroy', $query->id) . '" class="delete-item btn btn-md btn-danger ml-3" ><i class="fas fa-trash-alt"></i></a>';

                $more = '<div class="btn-group dropleft">
                  <button type="button" class="btn btn-md ml-3 btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-cog"></i>
                  </button>
                  <div class="dropdown-menu dropleft">
                    <a class="dropdown-item" href="' . route('image-gallery.index', ['id' => $query->id]) . '">Image Gallery</a>
                     <a class="dropdown-item" href="' . route('video-gallery.index', ['id' => $query->id]) . '">Video Gallery</a>
                  </div>
                </div>';

                return $edit . $delete . $more;
            })
            ->addColumn('category', function ($query) {
                return $query->category->name;
            })
            ->addColumn('location', function ($query) {
                return $query->location->name;
            })
            ->addColumn('status', function ($query) {
               $html = '<select class="approve form-control" data-id="'.$query->id.'">
               <option value = "0">Pending</option>
               <option value = "1">Approved</option>
               </select>';

               return $html;
            })

            ->addColumn('image', function ($query) {
                return '<img src="' . asset($query->image) . ' " hight="70px" width="140px"></img>';
            })
            ->addColumn('by', function ($query) {
                return $query->user?->name;
            })
            ->rawColumns(['status', 'action', 'image'])
            ->setRowId('id');
    }


    /**
     * Get the query source of dataTable.
     */
    public function query(Arts $model): QueryBuilder
    {
        return $model->where('is_approved', 0)->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
        ->setTableId('arts-table')
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

            Column::make('id'),
            Column::make('image'),
            Column::make('title'),
            Column::make('category'),
            Column::make('location'),
            Column::make('by')->width(120),
            Column::make('status')->width(140),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(250)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'PendingArts_' . date('YmdHis');
    }
}
