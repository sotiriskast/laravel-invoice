<?php

namespace App\Repositories;

use App\Mail\ClientMakePaymentMail;
use App\Models\Invoice;
use App\Models\Notification;
use App\Models\Payment;
use Illuminate\Support\Facades\Mail;

/**
 * Class PaymentRepository
 */
class PaymentRepository extends BaseRepository
{

    public function getFieldsSearchable(): array
    {
        return [];
    }

    /**
     *
     * @return string
     */
    public function model(): string
    {
        return Payment::class;
    }

    /**
     * @param $input
     * @param $invoice
     *
     * @return mixed
     */
    public function store($input, $invoice)
    {
        if ($input['payable_amount'] == $input['amount']) {
            $input['payment_type'] = Payment::FULLPAYMENT;
        }
        $input['is_approved'] = Payment::PENDING;

        if ($input['payment_mode'] == Payment::MANUAL && getManualPayment() == 1) {
            $input['is_approved'] = Payment::APPROVED;
        } else {
            $input['payment_type'] = Invoice::PROCESSING;
        }
        $payment = Payment::create($input);
        $invoice->update(['status' => $input['payment_type']]);

        $input['invoice'] = $payment->invoice;

        if (getSettingValue('mail_notification')) {
            Mail::to(getAdminUser()->email)->send(new ClientMakePaymentMail($input));
        }

        return $payment;
    }

    /**
     * @param $invoice
     *
     * @return array
     */
    public function getTotalPayable($invoice): array
    {
        $data = [];
        $invoice->load(['payments']);
        $data['id'] = $invoice->id;
        $payment = $invoice->payments()->get();
        $paid = $invoice->payments()->where('is_approved', Payment::APPROVED)->sum('amount');

        if ($invoice->status == Payment::PARTIALLYPAYMENT) {
            $data['total_amount'] = ($invoice->final_amount - $paid);
        } else {
            $data['total_amount'] = $invoice->final_amount;
        }

        return $data;
    }

    /**
     * @param $input
     *
     */
    public function saveNotification($input)
    {
        $adminUserId = getAdminUser()->id;
        $invoice = Invoice::find($input['invoice_id']);
        $title = "Payment ".getInvoiceCurrencyIcon($input['currency_id']).$input['amount']." received successfully for #".$invoice->invoice_id.".";
        addNotification([
            Notification::NOTIFICATION_TYPE['Invoice Payment'],
            $adminUserId,
            $title,
        ]);
    }
}
