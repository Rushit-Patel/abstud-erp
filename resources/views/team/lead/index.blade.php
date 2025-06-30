@php
    $breadcrumbs = [
        ['title' => 'Home', 'url' => route('team.dashboard')],
        ['title' => 'Leads']
    ];
@endphp
@push('styles')
    @vite([
        'resources/css/team/vendors/dataTables.css',
    ])
@endpush
<x-team.layout.app title="Dashboard" :breadcrumbs="$breadcrumbs">
    <x-slot name="content">
        <div class="kt-container-fixed">
            <div class="grid gap-2 lg:gap-2">
                {{-- Lead Dashboard Start --}}
                <x-team.card title="Leads Statistics" headerClass="">
                    <x-slot name="header">
                        <div class="flex justify-between items-center">
                            <div class="kt-menu" data-kt-menu="true">
                                <button class="kt-btn kt-btn-icon kt-btn-outline"
                                    data-kt-modal-toggle="#leadFilterModal">
                                    <i class="ki-filled ki-filter"></i>
                                </button>
                            </div>
                        </div>
                    </x-slot>
                    <div class="grid lg:grid-cols-1 gap-y-5 lg:gap-7.5 items-stretch  pb-5">
                        <div class="lg:col-span-1">
                            {{ $dataTable->table() }}
                        </div>
                        
                    </div>
                </x-team.card>

                {{-- Lead Dashboard End --}}
            </div>
        </div>
        <!-- Lead Filter Modal start -->
        <x-team.modal id="leadFilterModal" title="Filter Leads" size="max-w-[500px]" position="top-[15%]">

            <div class="grid gap-4">
                <!-- Lead Status Filter -->
                <div class="flex flex-col gap-1">
                    <label class="kt-form-label font-normal text-mono">Date Range</label>
                    <select class="kt-input" id="lead_filter_date">
                        <option value="">All Data</option>
                        <option value="Yesterday">Yesterday</option>
                        <option value="Last 7 Days">Last 7 Days</option>
                        <option value="Last 30 Days">Last 30 Days</option>
                        <option value="Last Month">Last Month</option>
                        <option value="This Year">This Year</option>
                        <option value="Last Year">Last Year</option>
                        <option value="Custom">Custom Range</option>
                    </select>
                </div>
                <!-- Custom Date Range Picker -->
                <div class="flex flex-col gap-1" id="custom_date_range" style="display: none;">
                    <label class="kt-form-label font-normal text-mono">Custom Date Range</label>
                    <div class="grid grid-cols-2 gap-3">
                        <div class="relative">
                            <input type="text" class="kt-input pl-10 pr-3" id="lead_filter_date_from"
                                placeholder="From Date" readonly>
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="ki-filled ki-calendar text-gray-400"></i>
                            </div>
                        </div>
                        <div class="relative">
                            <input type="text" class="kt-input pl-10 pr-3" id="lead_filter_date_to"
                                placeholder="To Date" readonly>
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="ki-filled ki-calendar text-gray-400"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Date Picker Calendar -->
                    <div class="relative">
                        <!-- Calendar Backdrop -->
                        <div id="calendar_backdrop" class="fixed inset-0 bg-black bg-opacity-50 hidden"
                            style="z-index: 99998;"></div>

                        <!-- Calendar Modal -->
                        <div id="datepicker_calendar" class="fixed kt-card shadow-lg hidden"
                            style="min-width: 350px; z-index: 99999;">
                            <div class="kt-card-header">
                                <h3 class="kt-card-title text-sm">Select Date Range</h3>
                            </div>
                            <div class="kt-card-body p-4">
                                <!-- Calendar Header -->
                                <div class="flex items-center justify-between mb-4">
                                    <button type="button" id="prev_month"
                                        class="kt-btn kt-btn-sm kt-btn-icon kt-btn-light">
                                        <i class="ki-filled ki-left text-sm"></i>
                                    </button>
                                    <div class="flex items-center gap-2">
                                        <select id="month_select"
                                            class="kt-select-sm form-select text-sm border-0 bg-transparent">
                                            <option value="0">January</option>
                                            <option value="1">February</option>
                                            <option value="2">March</option>
                                            <option value="3">April</option>
                                            <option value="4">May</option>
                                            <option value="5">June</option>
                                            <option value="6">July</option>
                                            <option value="7">August</option>
                                            <option value="8">September</option>
                                            <option value="9">October</option>
                                            <option value="10">November</option>
                                            <option value="11">December</option>
                                        </select>
                                        <select id="year_select"
                                            class="kt-select-sm form-select text-sm border-0 bg-transparent"></select>
                                    </div>
                                    <button type="button" id="next_month"
                                        class="kt-btn kt-btn-sm kt-btn-icon kt-btn-light">
                                        <i class="ki-filled ki-right text-sm"></i>
                                    </button>
                                </div>

                                <!-- Calendar Grid -->
                                <div class="calendar-container">
                                    <div class="calendar-header grid grid-cols-7 gap-1 mb-2">
                                        <div class="calendar-day-header">Su</div>
                                        <div class="calendar-day-header">Mo</div>
                                        <div class="calendar-day-header">Tu</div>
                                        <div class="calendar-day-header">We</div>
                                        <div class="calendar-day-header">Th</div>
                                        <div class="calendar-day-header">Fr</div>
                                        <div class="calendar-day-header">Sa</div>
                                    </div>
                                    <div id="calendar_days" class="calendar-days grid grid-cols-7 gap-1"></div>
                                </div>
                            </div>
                            <div class="kt-card-footer">
                                <div class="flex justify-between items-center">
                                    <button type="button" id="clear_dates" class="kt-btn kt-btn-sm kt-btn-light">
                                        <i class="ki-filled ki-trash"></i>
                                        Clear
                                    </button>
                                    <div class="flex gap-2">
                                        <button type="button" id="cancel_selection"
                                            class="kt-btn kt-btn-sm kt-btn-secondary">
                                            Cancel
                                        </button>
                                        <button type="button" id="apply_selection"
                                            class="kt-btn kt-btn-sm kt-btn-primary">
                                            <i class="ki-filled ki-check"></i>
                                            Apply
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col gap-1">
                    <label class="kt-form-label font-normal text-mono">Branch</label>
                    <select class="kt-input" id="lead_filter_branch">
                        <option value="">All</option>
                        <option value="HO">HO</option>
                        <option value="Ahmedabad">Ahmedabad</option>
                        <option value="Surat">Surat</option>
                        <option value="Vadodara">Vadodara</option>
                    </select>
                </div>

            </div>

            <x-slot name="footer">
                <div class="flex justify-end gap-2.5">
                    <button class="kt-btn kt-btn-secondary" data-kt-modal-dismiss="#leadFilterModal">
                        Cancel
                    </button>
                    <button class="kt-btn kt-btn-outline" onclick="clearFilters()">
                        Clear Filters
                    </button>
                    <button class="kt-btn kt-btn-primary" onclick="applyFilters()">
                        <i class="ki-filled ki-check"></i>
                        Apply Filters
                    </button>
                </div>
            </x-slot>
        </x-team.modal>
        <!-- Lead Filter Modal End -->

    </x-slot>


    @push('scripts')
        @vite([
            'resources/js/team/vendors/dataTables.min.js',
        ])
        {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    @endpush
</x-team.layout.app>