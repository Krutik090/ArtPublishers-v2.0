<?php

namespace App\DataTables;

use App\Models\Arts;
use App\Models\UserArt;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Auth;

class UserArtsDataTable extends DataTable
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
                $edit = '<a href="' . route('account.arts.edit', $query->id) . '" class="btn btn-md btn-primary" ><i class="fas fa-edit"></i></a>';
                $delete = '<a href="' . route('account.arts.destroy', $query->id) . '" class="delete-item btn btn-md btn-danger ml-3" ><i class="fas fa-trash-alt"></i></a>';

                $more = '<div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-cog"></i>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="'.route('account.image-gallery.index',['id' => $query->id]).'">Image Gallery</a></li>
                            <li><a class="dropdown-item" href="'.route('account.video-gallery.index',['id' => $query->id]).'">Video Gallery</a></li>
                        </ul>
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
                if ($query->status == 1) {
                    $status = '<span class="badge bg-success">Active</span>';
                } else {
                    $status = '';
                }

                if ($query->is_featured == 1) {
                    $featured = '<span class="badge bg-primary">Featured</span>';
                } else {
                    $featured = '';
                }

                if ($query->is_verified == 1) {
                    $verified = '<span class="badge bg-info">Verified</span>';
                } else {
                    $verified = '';
                }
                if ($query->is_approved == 0) {
                    $is_approved = '<span class="badge bg-warning">Pending</span>';
                } else {
                    $is_approved = '';
                }
                return $status . $featured . $verified.$is_approved;

            })

            ->rawColumns(['status', 'action', 'is_featured', 'is_verified'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Arts $model): QueryBuilder
    {
        return $model->newQuery()->where('user_id', Auth::user()->id);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('userarts-table')
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
            Column::make('id'),
            Column::make('title')->width(300),
            Column::make('category'),
            Column::make('location'),
            Column::make('status'),
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
        return 'UserArts_' . date('YmdHis');
    }
}
