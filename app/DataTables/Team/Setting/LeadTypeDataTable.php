<?php

namespace App\DataTables\Team\Setting;

use App\Models\LeadType;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class LeadTypeDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($leadType) {
                $editUrl = route('team.settings.lead-types.edit', $leadType->id);
                $deleteUrl = route('team.settings.lead-types.destroy', $leadType->id);
                $toggleUrl = route('team.settings.lead-types.toggle-status', $leadType->id);
                
                $actions = '<div class="d-flex align-items-center gap-2">';
                
                // Edit button
                $actions .= '<a href="' . $editUrl . '" class="btn btn-icon btn-sm btn-light-primary" title="Edit">
                    <i class="ki-duotone ki-pencil fs-5">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </a>';
                
                // Toggle status button
                $statusClass = $leadType->status ? 'btn-light-success' : 'btn-light-warning';
                $statusIcon = $leadType->status ? 'ki-check' : 'ki-cross';
                $statusTitle = $leadType->status ? 'Deactivate' : 'Activate';
                
                $actions .= '<button type="button" class="btn btn-icon btn-sm ' . $statusClass . ' toggle-status-btn" 
                    data-url="' . $toggleUrl . '" title="' . $statusTitle . '">
                    <i class="ki-duotone ' . $statusIcon . ' fs-5">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </button>';
                
                // Delete button
                $actions .= '<button type="button" class="btn btn-icon btn-sm btn-light-danger delete-btn" 
                    data-url="' . $deleteUrl . '" title="Delete">
                    <i class="ki-duotone ki-trash fs-5">
                        <span class="path1"></span>
                        <span class="path2"></span>
                        <span class="path3"></span>
                        <span class="path4"></span>
                        <span class="path5"></span>
                    </i>
                </button>';
                
                $actions .= '</div>';
                
                return $actions;
            })
            ->addColumn('status', function ($leadType) {
                $badgeClass = $leadType->status ? 'badge-light-success' : 'badge-light-danger';
                $statusText = $leadType->status ? 'Active' : 'Inactive';
                return '<span class="badge ' . $badgeClass . '">' . $statusText . '</span>';
            })
            ->rawColumns(['action', 'status'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(LeadType $model): QueryBuilder
    {
        return $model->newQuery()->withTrashed()->orderBy('created_at', 'desc');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('lead-types-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('rt<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>')
                    ->orderBy(0, 'desc')
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ])
                    ->parameters([
                        'responsive' => true,
                        'autoWidth' => false,
                        'lengthMenu' => [[10, 25, 50, 100, -1], [10, 25, 50, 100, 'All']],
                        'pageLength' => 10,
                        'language' => [
                            'search' => '',
                            'searchPlaceholder' => 'Search lead types...',
                            'emptyTable' => 'No lead types found',
                            'zeroRecords' => 'No matching lead types found'
                        ]
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id')
                ->title('ID')
                ->width(80)
                ->addClass('text-center'),
            Column::make('name')
                ->title('Lead Type Name')
                ->addClass('fw-bold'),
            Column::make('status')
                ->title('Status')
                ->width(100)
                ->addClass('text-center'),
            Column::make('created_at')
                ->title('Created At')
                ->width(150)
                ->addClass('text-center'),
            Column::computed('action')
                ->title('Actions')
                ->exportable(false)
                ->printable(false)
                ->width(120)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'LeadTypes_' . date('YmdHis');
    }
}
