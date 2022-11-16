<?php

namespace App\Http\Controllers;

use App\Repositories\DashboardRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Laracasts\Flash\Flash;

class DashboardController extends AppBaseController
{
    /* @var DashboardRepository */
    public $dashboardRepository;

    /**
     * DashboardController constructor.
     * @param  DashboardRepository  $dashboardRepo
     */
    public function __construct(DashboardRepository $dashboardRepo)
    {
        $this->dashboardRepository = $dashboardRepo;
    }

    /**
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $dashboardData = $this->dashboardRepository->getDashboardData();

        return view('dashboard.index')->with($dashboardData);
    }

    /**
     *
     * @return mixed
     */
    public function paymentOverview()
    {
        $data = $this->dashboardRepository->getPaymentOverviewData();

        return $this->sendResponse($data, 'PaymentOverview Status retrieved successfully.');
    }
    /**
     *
     * @return mixed
     */
    public function invoiceOverview()
    {
        $data = $this->dashboardRepository->getInvoiceOverviewData();

        return $this->sendResponse($data, 'PaymentOverview Status retrieved successfully.');
    }

    /**
     * @param  Request  $request
     *
     * @return JsonResponse
     */
    public function getYearlyIncomeChartData(Request $request): JsonResponse
    {
        $input = $request->all();

        $data = $this->dashboardRepository->prepareYearlyIncomeChartData($input);

        return $this->sendResponse($data, 'Yearly Income Overview chart data retrieved successfully.');
    }

    public function clearCache(): RedirectResponse
    {
        Artisan::call('cache:clear');
        Flash::success('Application cache cleared!');

        return redirect()->back();
    }
}
