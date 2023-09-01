<?php

namespace App\DataTables;

use App\Models\Work;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class WorkDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($work) {
                return view('works.column.action', [
                    'work' => $work
                ]);
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Work $model): QueryBuilder
    {
        return $model
            ->query()
            ->when(request('frequency'), function ($query) {
                $query->where('frequency', request('frequency'));
            })
            ->when(request('pic'), function ($query) {
                $query->where('pic', request('pic'));
            });
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('work-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('frtip')
            ->orderBy(1, 'desc')
            ->parameters([
                'scrollX' => true,
                'responsive' => true,
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
                ->width(60),
            Column::make('date')->width(200),
            Column::make('plant')->width(100),
            Column::make('registration'),
            Column::make('pic'),
            Column::make('classification')->width(100),
            Column::make('parameter')->width(200),
            Column::make('wo'),
            Column::make('jpp'),
            Column::make('notification'),
            Column::make('equipment'),
            Column::make('frequency'),
            Column::make('value'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Work_' . date('YmdHis');
    }
}
