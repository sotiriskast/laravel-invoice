<?php

namespace App\Http\Controllers\Client;

use App\DataTables\InvoiceDataTable;
use App\Exports\ClientInvoicesExport;
use App\Http\Controllers\AppBaseController;
use App\Models\Invoice;
use App\Models\Payment;
use App\Repositories\InvoiceRepository;
use Barryvdh\DomPDF\Facade as PDF;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Laracasts\Flash\Flash;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Yajra\DataTables\Facades\DataTables;

class InvoiceController extends AppBaseController
{
    /** @var InvoiceRepository */
    public $invoiceRepository;

    public function __construct(InvoiceRepository $invoiceRepo)
    {
        $this->invoiceRepository = $invoiceRepo;
    }

    /**
     * @param  Request  $request
     *
     * @throws Exception
     *
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $statusArr = Invoice::STATUS_ARR;
        $status = $request->status;
        unset($statusArr[Invoice::DRAFT]);
        $paymentType = Payment::PAYMENT_TYPE;
        $paymentMode = $this->getPaymentGateways();
        $stripeKey = getSettingValue('stripe_key');
        if (empty($stripeKey)) {
            $stripeKey = config('services.stripe.key');
        }

        return view('client_panel.invoices.index', compact('statusArr', 'paymentType', 'paymentMode', 'status','stripeKey'));
    }

    /**
     * @param  Invoice  $invoice
     *
     * @return Application|Factory|View|RedirectResponse
     */
    public function show(Invoice $invoice)
    {
        $invoice->load('client');
        if (getLogInUserId() != $invoice->client->user_id || $invoice->status == Invoice::DRAFT) {
            Flash::error('Invoice Not Found.');

            return redirect()->route('client.invoices.index');
        }
        $invoiceData = $this->invoiceRepository->getInvoiceData($invoice);

        return view('client_panel.invoices.show')->with($invoiceData);
    }

    /**
     * @param  Invoice  $invoice
     *
     * @return Response
     */
    public function convertToPdf(Invoice $invoice): Response
    {
        $invoice->load('client.user', 'invoiceTemplate', 'invoiceItems.product', 'invoiceItems.invoiceItemTax');
        if(getLogInUserId() != $invoice->client->user->id){
            abort(404);
        }
        $invoiceData = $this->invoiceRepository->getPdfData($invoice);
        $invoiceTemplate = $this->invoiceRepository->getDefaultTemplate($invoice);
        $pdf = PDF::loadView("invoices.invoice_template_pdf.$invoiceTemplate", $invoiceData);

        return $pdf->stream('invoice.pdf');
    }

    /**
     *
     * @return BinaryFileResponse
     */
    public function exportInvoicesExcel(): BinaryFileResponse
    {
        return Excel::download(new ClientInvoicesExport(),'invoice-excel.xlsx');
    }

    /**
     * @return string[]
     */
    public function getPaymentGateways(): array
    {
        $paymentMode = Payment::PAYMENT_MODE;
        $availableMode = [
            Payment::PAYPAL => 'paypal_enabled',
            Payment::RAZORPAY => 'razorpay_enabled',
            Payment::STRIPE => 'stripe_enabled'
        ];
        foreach($availableMode as $key => $mode){
            if(!getSettingValue($mode)){
                unset($paymentMode[$key]);
            }
        }
        unset($paymentMode[Payment::CASH]);
        unset($paymentMode[Payment::ALL]);

        return $paymentMode;
    }
}
