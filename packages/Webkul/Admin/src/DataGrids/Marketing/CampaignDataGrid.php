<?php

namespace Webkul\Admin\DataGrids\Marketing;

use Illuminate\Support\Facades\DB;
use Webkul\DataGrid\DataGrid;

class CampaignDataGrid extends DataGrid
{
    /**
     * Prepare query builder.
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function prepareQueryBuilder()
    {
        $queryBuilder = DB::table('marketing_campaigns')->addSelect('id', 'name', 'subject', 'status');

        $this->addFilter('status', 'marketing_campaigns.status');

        return $queryBuilder;
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
            'label'      => trans('admin::app.marketing.email-marketing.campaigns.index.datagrid.id'),
            'type'       => 'integer',
            'searchable' => false,
            'sortable'   => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'name',
            'label'      => trans('admin::app.marketing.email-marketing.campaigns.index.datagrid.name'),
            'type'       => 'string',
            'searchable' => true,
            'sortable'   => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'subject',
            'label'      => trans('admin::app.marketing.email-marketing.campaigns.index.datagrid.subject'),
            'type'       => 'string',
            'searchable' => true,
            'sortable'   => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'status',
            'label'      => trans('admin::app.status'),
            'type'       => 'boolean',
            'searchable' => true,
            'sortable'   => true,
            'filterable' => true,
            'closure'    => function ($value) {
                if ($value->status) {
                    return trans('admin::app.marketing.email-marketing.campaigns.index.datagrid.active');
                }

                return trans('admin::app.marketing.email-marketing.campaigns.index.datagrid.inactive');
            },
        ]);
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
            'title'  => trans('admin::app.marketing.email-marketing.campaigns.index.datagrid.edit'),
            'method' => 'GET',
            'url'    => function ($row) {
                return route('admin.marketing.promotions.campaigns.edit', $row->id);
            },
        ]);

        $this->addAction([
            'icon'         => 'icon-delete',
            'title'        => trans('admin::app.marketing.email-marketing.campaigns.index.datagrid.delete'),
            'method'       => 'DELETE',
            'confirm_text' => trans('ui::app.datagrid.mass-action.delete', ['resource' => 'Campaign']),
            'url'          => function ($row) {
                return route('admin.marketing.promotions.campaigns.delete', $row->id);
            },
        ]);
    }
}
