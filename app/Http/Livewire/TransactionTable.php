<?php

namespace App\Http\Livewire;

use App\Models\Account;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class TransactionTable extends LivewireTableComponent
{
    protected $model = Payment::class;
    protected string $tableName = 'payments';

    // for table header button
    public $showButtonOnHeader = true;
    public $buttonComponent = 'transactions.components.export-button';
    public $showFilterOnHeader = true;
    public $filterComponent = ['transactions.components.filter-button', Payment::PAYMENT_MODE, Payment::PAYMENT_STATUS];
    protected $listeners = ['changePaymentModeFilter', 'changePaymentStatusFilter'];

    public function changePaymentModeFilter($param, $value)
    {
        $this->resetPage($this->getComputedPageName());
        $this->paymentModeFilter = $value;
        $this->setBuilder($this->builder());
    }

    public function changePaymentStatusFilter($param, $value)
    {
        $this->resetPage($this->getComputedPageName());
        $this->paymentStatusFilter = $value;
        $this->setBuilder($this->builder());
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('created_at', 'desc');
        $this->setQueryStringStatus(false);

        $this->setThAttributes(function (Column $column) {
            if ($column->isField('payment_mode')) {
                return [
                    'class' => 'text-center w-12',
                ];
            }
            if ($column->isField('first_name')) {
                return [
                    'class' => 'w-35',
                ];
            }
            if ($column->isField('amount')) {
                return [
                    'class' => 'd-flex justify-content-end w-15',
                ];
            }
            return [];  
        });
        
        $this->setTdAttributes(function (Column $column) {
            if($column->getField() === 'payment_mode') {
                return [
                    'class' => 'text-center',
                ];
            }

            if($column->getField() === 'amount') {
                return [
                    'class' => 'text-end',
                ];
            }
            return [];
        });
    }

    public function columns(): array
    {
        return [
            Column::make(__('messages.payment.transaction_id'), "transaction_id")
                ->searchable()
                ->view('transactions.components.transactions-id'),
            Column::make(__('messages.invoice.invoice_id'), "invoice.invoice_id")
                ->searchable()
                ->format(function ($value, $row, Column $column) {
                    return view('transactions.components.invoice-id-payment-date')
                        ->withValue([
                            'invoice-id-route' => route('invoices.show', $row->invoice->id),
                            'invoice-id' => $row->invoice->invoice_id
                        ]);
                }),
            Column::make(__('messages.invoice.client'), "invoice.client.user.first_name")
//                ->sortable()
                ->searchable()
                ->view('transactions.components.client-name'),
            Column::make("Last Name", "invoice.client.user.last_name")
                ->sortable()
                ->searchable()
                ->hideif('admin'),
            Column::make(__('messages.payment.payment_date'), "payment_date")
                ->sortable()
                ->searchable()
                ->format(function ($value, $row, Column $column) {
                    return view('transactions.components.invoice-id-payment-date')
                        ->withValue([
                            'payment-date' => $row->payment_date
                        ]);
                }),
            Column::make(__('messages.invoice.amount'), "amount")
                ->sortable()
                ->searchable()
                ->format(function ($value, $row, Column $column) {
                    return getInvoiceCurrencyAmount($row->amount,$row->invoice->currency_id,true);
                }),
            Column::make(__('messages.setting.payment_approved'), "payment_mode")
                ->searchable()
                ->view('transactions.components.transaction-approved'),
            Column::make(__('messages.invoice.payment_method'), "payment_mode")
                ->searchable()
                ->view('transactions.components.payment-mode'),
            Column::make(__('messages.common.status'), "payment_mode")
                ->searchable()
                ->view('transactions.components.transaction-status'),
        ];
    }

    /**
     * @return Builder
     */
    public function builder(): Builder
    {
        $query = Payment::with('invoice.client.user')->select('payments.*');

        $query->when(isset($this->paymentModeFilter), function (Builder $q) {
            if($this->paymentModeFilter != Payment::ALL){
                $q->where('payment_mode', $this->paymentModeFilter);
                }
        });


        $query->when(isset($this->paymentStatusFilter), function (Builder $q) {
            if($this->paymentStatusFilter != Payment::STATUS_ALL){
                $q->where('is_approved', $this->paymentStatusFilter);
            }
        });
        
        return $query;
        
    }
}
