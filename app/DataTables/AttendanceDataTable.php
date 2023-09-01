<?php

namespace App\DataTables;

use App\Models\Attendance;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AttendanceDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('checkin', function ($row) {
                return view('attendances.column.checkin', [
                    'checkin' => $row->checkin
                ]);
            })
            ->addColumn('checkout', function ($row) {
                return view('attendances.column.checkout', [
                    'checkout' => $row->checkout
                ]);
            })
            ->addColumn('checkinlocation', function ($row) {
                return $row->checkin ?
                    sprintf(
                        '%s, %s',
                        $row->checkin?->latitude,
                        $row->checkin?->longitude
                    ) : '-';
            })
            ->addColumn('checkoutlocation', function ($row) {
                return $row->checkout ?
                    sprintf(
                        '%s, %s',
                        $row->checkout?->latitude,
                        $row->checkout?->longitude
                    ) : '-';
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Attendance $model): QueryBuilder
    {
        return $model
            ->query()
            ->with(['user', 'user.role', 'checkin', 'checkout'])
            ->when(request('role'), function ($query) {
                $query->whereHas('user', function ($query) {
                    $query->whereHas('role', function ($query) {
                        $query->where('name', request('role'));
                    });
                });
            });
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('attendance-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('frtip')
            ->orderBy(0, 'desc')
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
            Column::make('user.name')->title('Name')->width(200),
            Column::make('user.email')->title('Email'),
            Column::make('user.role.description')
                ->title('Role')
                ->orderable(false)
                ->addClass('text-center')->width(150),
            Column::make('created_at')->title('Date')->width(200),
            Column::computed('checkin')
                ->orderable(false)
                ->title('Check In')
                ->width(200)
                ->addClass('text-center'),
            Column::computed('checkinlocation')
                ->title('Location')
                ->orderable(false)
                ->addClass('text-center')->width(200),
            Column::computed('checkout')
                ->width(200)
                ->title('Check Out')
                ->orderable(false)
                ->addClass('text-center'),
            Column::computed('checkoutlocation')
                ->title('Location')
                ->orderable(false)
                ->addClass('text-center')->width(200),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Attendance_' . date('YmdHis');
    }
}
