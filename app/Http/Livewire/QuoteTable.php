<?php

namespace App\Http\Livewire;

use App\Models\Quote;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class QuoteTable extends LivewireTableComponent
{
    protected $model = Quote::class;
    protected string $tableName = 'quotes';

    public $showButtonOnHeader = true;
    public $buttonComponent = 'quotes.components.add-button';
    public $status;
    protected $queryString = ['status'];

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('created_at', 'desc');
        $this->setQueryStringStatus(false);
    }

    public function columns(): array
    {
        return [
            Column::make(__('messages.quote.client'), "client.user.first_name")
                ->sortable()
                ->searchable()
                ->view('quotes.components.client-name'),
            Column::make("quote_id", "quote_id")
                ->sortable()
                ->searchable()->hideIf(1),
            Column::make("Last Name", "client.user.last_name")
                ->sortable()
                ->searchable()->hideIf(1),
            Column::make(__('messages.quote.quote_date'), "quote_date")
                ->sortable()
                ->searchable()
                ->format(function($value, $row, Column $column) {
                    return view('quotes.components.quote-due-date')
                        ->withValue([
                            'quote-date' => $row->quote_date,
                        ]);
                }),
            Column::make(__('messages.quote.due_date'), "due_date")
                ->sortable()
                ->searchable()
                ->format(function($value, $row, Column $column) {
                    return view('quotes.components.quote-due-date')
                        ->withValue([
                            'due-date' => $row->due_date,
                        ]);
                }),
            Column::make(__('messages.quote.amount'), "final_amount")
                ->sortable()
                ->searchable()
                ->format(function($value, $row, Column $column){
                    return getCurrencyAmount($row->final_amount,true);
                }),
            Column::make(__('messages.common.status'), "status")
                ->searchable()
                ->view('quotes.components.quote-status'),
            Column::make(__('messages.common.action'), "id")
                ->view('livewire.quote-action-button'),
        ];
    }

    public function builder(): Builder
    {
        $status = request()->input('status', null);
        $query = Quote::with(['client.user.media'])->select('quotes.*')
            ->when($status, function ($query, $status) {
                return $query->where('quotes.status', $status);
            })
            ->when($this->getAppliedFilterWithValue('quotes.status'), function ($query, $type) {
                return $query->where('quotes.status', $type);
            });

        return $query;
    }

    public function filters(): array {
        $status = Quote::STATUS_ARR;
        unset($status[Quote::STATUS_ALL]);
        return [
            SelectFilter::make(__('messages.common.status').':')
                ->options($status)
                ->filter(function (Builder $builder, string $value) {
                    $builder->where('quotes.status','=', $value);
                }),
        ];
    }

}
