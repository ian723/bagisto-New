<?php

namespace Webkul\Admin\Http\Controllers\Reporting;

use Webkul\Admin\Http\Controllers\Controller;
use Webkul\Admin\Helpers\Reporting;

class SaleController extends Controller
{
    /**
     * Create a controller instance.
     * 
     * @param  \Webkul\Admin\Helpers\Reporting  $reportingHelper
     * @return void
     */
    public function __construct(protected Reporting $reportingHelper)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin::reporting.sales.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function stats()
    {
        $stats = $this->reportingHelper->{request()->query('type')}();

        return response()->json([
            'statistics' => $stats,
            'date_range' => $this->reportingHelper->getDateRange(),
        ]);
    }
}