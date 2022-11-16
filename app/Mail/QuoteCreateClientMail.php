<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class QuoteCreateClientMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $invoiceId = $this->data['quoteData']['id'];
        $adminName = getAdminUser()->first_name.' '.getAdminUser()->last_name;
        $quoteNumber = $this->data['quoteData']['quote_id'];
        $quoteDate = $this->data['quoteData']['quote_date'];
        $dueDate = $this->data['quoteData']['due_date'];
        $subject = "Quote #$quoteNumber Created";

        return $this->view('emails.create_invoice_admin_mail',
            compact('adminName', 'quoteNumber', 'quoteDate', 'dueDate', 'invoiceId'))
            ->markdown('emails.create_quote_admin_mail')
            ->subject($subject);
    }
}
