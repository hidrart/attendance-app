<?php

namespace App\DataTables;

use App\Models\ActionPlan;
use App\Models\UserAction;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UserActionDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function (ActionPlan $row) {
                return view('actions.column.action', [
                    'action' => $row
                ]);
            })
            ->addColumn('photo', function ($row) {
                return view('actions.column.photo', [
                    'photo' => $row->photo
                ]);
            })
            ->addColumn('status', function ($row) {
                return view('actions.column.status', [
                    'status' => $row->status
                ]);
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(ActionPlan $model): QueryBuilder
    {
        return $model->newQuery()
            ->with(['user', 'work'])
            ->where('user_id', Auth::user()->id)
            ->when(request()->status, function ($query, $status) {
                return $query->where('status', $status);
            });
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('actionplan-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('frtip')
            ->orderBy(9)
            ->parameters([
                'scrollX' => true,
                'responsive' => true,
                'autoWidth' => false,
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
            Column::make('work.registration')->title('Registration')->orderable(false),
            Column::make('id')->width(60),
            Column::make('user.name')->title('User')->width(200)->orderable(false), // dont change this it fkd up the row id
            Column::make('plan')->width(200),
            Column::computed('photo')
                ->exportable(false)
                ->printable(false)
                ->width(200)
                ->addClass('text-center'),
            Column::make('analysis')->width(200),
            Column::make('recommendation')->width(200),
            Column::computed('status')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center'),
            Column::make('status')->visible(false),
            Column::make('created_at')->visible(false),
            Column::make('updated_at')->visible(false),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'UserAction_' . date('YmdHis');
    }
}
