<?php

namespace Webkul\SizeChart\Datagrids;

use Illuminate\Support\Facades\DB;
use Webkul\DataGrid\DataGrid;

class SizeChartDataGrid extends DataGrid
{
    /**
     * Prepare query builder.
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function prepareQueryBuilder()
    {
        // Add DB::enableQueryLog() to debug the query
        DB::enableQueryLog();

        $query = DB::table('size_charts')
            ->select(
                'id',
                'template_name',
                'template_type',
                'template_code'
            );

        // Add this to see the actual query being executed
        \Log::info('SizeChart Query:', ['query' => $query->toSql(), 'bindings' => $query->getBindings()]);

        return $query;
    }

    /**
     * Add Columns.
     *
     * @return void
     */
    public function prepareColumns()
    {
        $this->addColumn([
            'index'      => 'id',
            'label'      => 'ID',
            'type'       => 'integer',
            'filterable' => true,
            'sortable'   => true,
        ]);

        $this->addColumn([
            'index'      => 'template_name',
            'label'      => 'Template Name',
            'type'       => 'string',
            'searchable' => true,
            'filterable' => true,
            'sortable'   => true,
        ]);

        $this->addColumn([
            'index'              => 'template_type',
            'label'              => 'Template Type', //trans('admin::app.settings.roles.index.datagrid.permission-type'),
            'type'               => 'string',
            'searchable'         => true,
            'filterable'         => true,
            'filterable_type'    => 'dropdown',
            'filterable_options' => [
                [
                    'label' => 'Fixed',  // or trans('sizechart::app.admin.datagrid.fixed')
                    'value' => 'fixed',
                ],
                [
                    'label' => 'Custom',  // or trans('sizechart::app.admin.datagrid.custom')
                    'value' => 'custom',
                ],
                // Add other template types as needed
            ],
            'sortable'   => true,
        ]);

        $this->addColumn([
            'index'      => 'template_code',
            'label'      => 'Template Code',
            'type'       => 'string',
            'searchable' => true,
            'filterable' => true,
            'sortable'   => true,
        ]);
    }

    /**
     * Prepare actions.
     *
     * @return void
     */
    public function prepareActions()
    {
        if (bouncer()->hasPermission('settings.roles.edit')) {
            $this->addAction([
                'icon'   => 'icon-edit',
                'title'  => 'Edit', //trans('admin::app.settings.roles.index.datagrid.edit'),
                'method' => 'GET',
                'url' => function ($row) {
                    return route('sizechart.admin.index.edit', $row->id);
                },

            ]);
        }

        if (bouncer()->hasPermission('settings.roles.delete')) {
            $this->addAction([
                'icon'   => 'icon-delete',
                'title'  => trans('admin::app.settings.roles.index.datagrid.delete'),
                'method' => 'DELETE',
                'url'    => function ($row) {
                    return route('admin.settings.roles.delete', $row->id);
                },
            ]);
        }
    }
}
