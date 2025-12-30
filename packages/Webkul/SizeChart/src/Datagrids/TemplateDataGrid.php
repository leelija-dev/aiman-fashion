<?php

namespace Webkul\SizeChart\Datagrids;

use Illuminate\Support\Facades\DB;
use Webkul\DataGrid\DataGrid;

class TemplateDataGrid extends DataGrid
{
    /**
     * Prepare query builder.
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function prepareQueryBuilder()
    {
        return DB::table('size_charts')
            ->select(
                'id',
                'template_name',
                'template_code',
                'template_type',
                'created_at'
            );
    }

    /**
     * Add columns.
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

        // Add other columns as needed
    }

    /**
     * Prepare actions.
     *
     * @return void
     */
    public function prepareActions()
    {
        $this->addAction([
            'icon'   => 'icon-edit',
            'title'  => 'Edit',
            'method' => 'GET',
            'url'    => function ($row) {
                return route('sizechart.admin.edit', $row->id);
            },
        ]);

        $this->addAction([
            'icon'   => 'icon-delete',
            'title'  => 'Delete',
            'method' => 'DELETE',
            'url'    => function ($row) {
                return route('sizechart.admin.delete', $row->id);
            },
        ]);
    }
}