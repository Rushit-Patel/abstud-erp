<?php

namespace App\DataTables\Team\Lead;

use App\Models\Test;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class LeadDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', fn($test) => $this->renderAction($test))
            ->addColumn('lead', fn($test) => $this->renderLead($test))
            ->addColumn('client', fn($test) => $this->renderClient($test))
            ->addColumn('service', fn($test) => $this->renderService($test))
            ->addColumn('status', fn($test) => $this->renderStatus($test))
            ->addColumn('follow up', fn($test) => $this->renderFollowUp($test))
            ->rawColumns(['action', 'lead', 'client', 'status', 'follow up', 'service'])
            ->setRowId('id');
    }

    private function renderAction($test): string
    {
        return view('team.lead.datatables.action', ['id' => $test->id])->render();
    }

    private function renderLead($test): string
    {
        return view('team.lead.datatables.lead', [
            'date' => $test->date->format('d/m/Y'),
            'source' => $test->source,
            'branch' => $test->branch,
        ])->render();
    }

    private function renderClient($test): string
    {
        return view('team.lead.datatables.client', [
            'name' => $test->name,
            'mobile_no' => $test->mobile_no,
            'email_id' => $test->email_id,
        ])->render();
    }

    private function renderService($test): string
    {
        return view('team.lead.datatables.service', [
            'purpose' => $test->purpose,
            'country' => $test->country,
            'coaching' => $test->coaching,
        ])->render();
    }

    private function renderStatus($test): string
    {
        $badgeClass = $this->getStatusBadgeClass($test->call_status);

        return view('team.lead.datatables.status', [
            'status' => $test->call_status,
            'badgeClass' => $badgeClass,
        ])->render();
    }

    private function renderFollowUp($test): string
    {
        return view('team.lead.datatables.follow-up', [
            'follow_up' => $test->follow_up?->format('Y-m-d'),
        ])->render();
    }

    private function getStatusBadgeClass(string $status): string
    {
        return match($status) {
            'New' => 'bg-blue-100 text-blue-800',
            'In Progress' => 'bg-yellow-100 text-yellow-800',
            'Completed' => 'bg-green-100 text-green-800',
            'Closed' => 'bg-gray-100 text-gray-800',
            default => 'bg-gray-200 text-gray-900'
        };
    }

    public function query(Test $model): QueryBuilder
    {
        return $model->query()->limit(22);
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('lead-table')
            ->setTableAttribute('class', 'kt-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->parameters($this->getTableParameters())
            ->orderBy(1)
            ->selectStyleSingle();
    }

    public function getColumns(): array
    {
        return [
            Column::make('lead')->width(100),
            Column::make('client')->width(180),
            Column::make('service')->width(150),
            Column::make('status')->width(130),
            Column::make('follow up')->width(200),
            Column::computed('action')
                ->title('Actions')
                ->exportable(false)
                ->printable(false)
                ->width(80)
                ->addClass('text-center')
                ->orderable(false)
                ->searchable(false),
        ];
    }

    private function getTableParameters(): array
    {
        return [
            'dom' => '<"kt-datatable-toolbar flex flex-col sm:flex-row items-center justify-between gap-3 py-2"<"dt-length flex items-center gap-2 order-2 md:order-1"><"dt-search ml-auto"f>>rt<"kt-datatable-toolbar flex flex-col sm:flex-row items-center justify-between gap-3 py-4 border-t border-gray-200"<"kt-datatable-length text-secondary-foreground text-sm font-medium"l><"dt-paging flex items-center space-x-1 text-secondary-foreground text-sm font-medium"ip>>',
            'buttons' => ['export', 'print', 'reset', 'reload'],
            'scrollX' => true,
            'language' => [
                'lengthMenu' => 'Show _MENU_ per page',
                'search' => 'Search: ',
                'info' => '_START_-_END_ of _TOTAL_',
                'paginate' => [
                    'previous' => '←',
                    'next' => '→'
                ]
            ],
        ];
    }

    protected function filename(): string
    {
        return 'Lead_' . date('YmdHis');
    }
}