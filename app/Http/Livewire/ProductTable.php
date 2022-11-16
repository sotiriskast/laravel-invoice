<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class ProductTable extends LivewireTableComponent
{
    protected $model = Product::class;
    protected string $tableName = 'products';

    // for table header button
    public $showButtonOnHeader = true;
    public $buttonComponent = 'products.components.add-button';


    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('created_at', 'desc');
        $this->setQueryStringStatus(false);

        $this->setThAttributes(function (Column $column) {

            if ($column->isField('id') || $column->isField('unit_price')) {

                    return ($column->isSortable()) ? ['class' => 'd-flex justify-content-end']
                                                   : ['class' => 'text-center'];
            }
            return [];
        });
        $this->setTdAttributes(function (Column $column) {
            if($column->getField() === 'id') {
                return [
                    'class' => 'text-center',
                ];
            }
            if($column->getField() === 'unit_price') {
                return [
                    'class' => 'customWidth',
                ];
            }
            return [];
        });
    }

    public function columns(): array
    {
        return [
            Column::make(__('messages.product.product_name'), "name")
                ->sortable()
                ->searchable()
                ->view('products.components.product-name'),
            Column::make(__('messages.product.category'), "category.name")
                ->sortable()
                ->searchable()
                ->format(function($value, $row, Column $column){
                    return $row->category->name;
                }),
            Column::make(__('messages.product.price'), "unit_price")
                ->sortable()
                ->searchable()
                ->view('products.components.price'),
            Column::make(__('messages.common.action'), "id")
                ->format(function($value, $row, Column $column) {
                    return view('livewire.action-button')
                        ->with([
                            'editRoute' => route('products.edit', $row->id),
                            'dataId' => $row->id,
                            'deleteClass' => 'product-delete-btn',
                        ]);
                })
        ];
    }

    public  function  builder(): Builder
    {
        return Product::with('category')->with('media')->select('products.*');
    }
}
