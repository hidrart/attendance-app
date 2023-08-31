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
            ->addColumn('action', 'attendances.column.action')
            ->addColumn('user', function ($attendance) {
                return view('attendances.column.user', [
                    'user' => $attendance->user,
                    'role' => $attendance->user->role
                ]);
            })
            ->addColumn('checkin', function ($attendance) {
                return view('attendances.column.checkin', [
                    'checkin' => $attendance->checkin
                ]);
            })
            ->addColumn('checkout', function ($attendance) {
                return view('attendances.column.checkout', [
                    'checkout' => $attendance->checkout
                ]);
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Attendance $model): QueryBuilder
    {
        return $model->newQuery()->with(['user', 'user.role', 'checkin', 'checkout']);
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
            //->dom('Bfrtip')
            ->orderBy(0, 'desc')
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
            Column::make('id')->width('60px'),
            Column::computed('user'),
            Column::make('updated_at')->width('20%')->title('Date'),
            Column::computed('checkin')->width('20%'),
            Column::computed('checkout')->width('20%'),
            Column::computed('action')->width('60px')->exportable(false)->printable(false)->addClass('text-center'),

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
