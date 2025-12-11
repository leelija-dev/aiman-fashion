<x-admin::layouts>
    <x-slot:title>
        {{ __('sizechart::app.sizechart.template.title') }}
    </x-slot>

    @push('styles')
    <style>
        /* Scoped styles for SizeChart index page */
        .sizechart-index .page-header {
            padding-bottom: 12px !important;
            border-bottom: 1px solid #e5e7eb !important; /* gray-200 */
            margin-bottom: 16px !important;
        }

        .sizechart-index .page-title h1 {
            font-weight: 700 !important;
        }

        .sizechart-index .page-action {
            display: inline-block !important;
            margin-left: 8px !important;
        }
    </style>
    @endpush

    <div class="content sizechart-index" style="height: 100%;">
        <?php $locale = request()->get('locale') ?: null; ?>
        <?php $channel = request()->get('channel') ?: null; ?>
        <div class="page-header">
            <div class="page-title">
                <h1>{{ __('sizechart::app.sizechart.template.title') }}</h1>
            </div>

            <div class="page-action">
                <a href="{{ route('sizechart.admin.index.create', ['type' => '0'])  }}" class="btn btn-lg btn-primary">
                    {{ __('sizechart::app.sizechart.template.add-configurable') }}
                </a>
            </div>

            <div class="page-action">
                <a href="{{ route('sizechart.admin.index.create', ['type' => '1']) }}" class="btn btn-lg btn-primary">
                    {{ __('sizechart::app.sizechart.template.add-simple') }}
                </a>
            </div>

        </div>

        {!! view_render_event('bagisto.admin.sizechart.template.list.before') !!}

        <div class="page-content">
            <x-admin::datagrid :src="route('sizechart.admin.index')" />
        </div>

        {!! view_render_event('bagisto.admin.sizechart.template.list.after') !!}

    </div>
    

<!-- @push('scripts')
    <script>

        function reloadPage(getVar, getVal) {
            let url = new URL(window.location.href);
            url.searchParams.set(getVar, getVal);

            window.location.href = url.href;
        }

    </script>
@endpush -->

@pushOnce('scripts')
    <script>
        function reloadPage(getVar, getVal) {
            let url = new URL(window.location.href);
            url.searchParams.set(getVar, getVal);
            window.location.href = url.href;
        }
    </script>
@endPushOnce
</x-admin::layouts>