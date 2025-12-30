<x-admin::layouts>
    <x-slot:title>
        @lang('sizechart::app.sizechart.template.title')
        </x-slot>

        <div class="flex items-center justify-between">
            <p class="text-xl font-bold text-gray-800 dark:text-white">
                @lang('sizechart::app.sizechart.template.title')
            </p>

            <div class="flex items-center gap-x-2.5">
                <a href="{{ route('sizechart.admin.index.create', ['type' => '0']) }}"
                    class="primary-button">
                    @lang('sizechart::app.sizechart.template.add-configurable')
                </a>

                <a href="{{ route('sizechart.admin.index.create', ['type' => '1']) }}"
                    class="primary-button">
                    @lang('sizechart::app.sizechart.template.add-simple')
                </a>
            </div>
        </div>

        {!! view_render_event('bagisto.admin.sizechart.template.list.before') !!}

        <!-- Keep the existing code above the table -->

        <div class="page-content">
            <div class="table-responsive">
                <table class="table">
                    <!-- Table header -->
                    <thead>
                        <tr>
                            <th>@lang('admin::app.datagrid.id')</th>
                            <th>@lang('admin::app.datagrid.name')</th>
                            <th>@lang('admin::app.datagrid.code')</th>
                            <th>@lang('admin::app.datagrid.type')</th>
                            <th>@lang('admin::app.datagrid.created')</th>
                            <th>@lang('admin::app.datagrid.actions')</th>
                        </tr>
                    </thead>

                    <!-- Table body -->
                    <tbody>
                        @forelse($sizeCharts as $chart)
                        <tr>
                            <td>{{ $chart->id }}</td>
                            <td>{{ $chart->template_name }}</td>
                            <td>{{ $chart->template_code }}</td>
                            <td>
                                <span class="badge badge-{{ $chart->template_type === 'simple' ? 'success' : 'info' }}">
                                    {{ ucfirst($chart->template_type) }}
                                </span>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($chart->created_at)->format('Y-m-d H:i') }}</td>
                            <td>
                                <div class="flex gap-1">
                                    <a href="{{ route('sizechart.admin.index.edit', $chart->id) }}"
                                        class="icon-btn">
                                        <span class="icon-edit"></span>
                                    </a>
                                    <form method="POST"
                                        action="{{ route('sizechart.admin.index.delete', $chart->id) }}"
                                        onsubmit="return confirm('{{ __('admin::app.datagrid.delete') }}')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="icon-btn">
                                            <span class="icon-delete"></span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">
                                @lang('admin::app.datagrid.no-records')
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($sizeCharts->hasPages())
            <div class="pagination-wrapper mt-4">
                {{ $sizeCharts->links() }}
            </div>
            @endif
        </div>

        <!-- Rest of your view -->

        {!! view_render_event('bagisto.admin.sizechart.template.list.after') !!}

        @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Handle delete confirmations
                document.querySelectorAll('form[onsubmit]').forEach(form => {
                    form.onsubmit = function(e) {
                        if (!confirm('{{ __('
                                admin::app.datagrid.delete ') }}')) {
                            e.preventDefault();
                            return false;
                        }
                    };
                });

                // Clean up any datagrid-related localStorage items
                const keys = Object.keys(localStorage);
                keys.forEach(key => {
                    if (key.includes('datagrid_state') && key.includes('sizechart')) {
                        localStorage.removeItem(key);
                    }
                });
            });
        </script>
        @endpush
</x-admin::layouts>