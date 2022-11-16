<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

/**
 * App\Models\Invoice
 *
 * @property int $id
 * @property string $invoice_id
 * @property int $client_id
 * @property string $invoice_date
 * @property string $due_date
 * @property float|null $amount
 * @property float|null $final_amount
 * @property int $discount_type
 * @property float $discount
 * @property string|null $note
 * @property string|null $term
 * @property \App\Models\Setting|mixed $currency_id
 * @property int|null $template_id
 * @property int $recurring
 * @property int $status
 * @property int $recurring_status
 * @property int|null $recurring_cycle
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AdminPayment[] $AdminPayment
 * @property-read int|null $admin_payment_count
 * @property-read \App\Models\Client $client
 * @property-read string $status_label
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\InvoiceItem[] $invoiceItems
 * @property-read int|null $invoice_items_count
 * @property-read \App\Models\InvoiceSetting|null $invoiceTemplate
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Payment[] $payments
 * @property-read int|null $payments_count
 * @method static Builder|Invoice newModelQuery()
 * @method static Builder|Invoice newQuery()
 * @method static Builder|Invoice query()
 * @method static Builder|Invoice whereAmount($value)
 * @method static Builder|Invoice whereClientId($value)
 * @method static Builder|Invoice whereCreatedAt($value)
 * @method static Builder|Invoice whereCurrencyId($value)
 * @method static Builder|Invoice whereDiscount($value)
 * @method static Builder|Invoice whereDiscountType($value)
 * @method static Builder|Invoice whereDueDate($value)
 * @method static Builder|Invoice whereFinalAmount($value)
 * @method static Builder|Invoice whereId($value)
 * @method static Builder|Invoice whereInvoiceDate($value)
 * @method static Builder|Invoice whereInvoiceId($value)
 * @method static Builder|Invoice whereNote($value)
 * @method static Builder|Invoice whereRecurring($value)
 * @method static Builder|Invoice whereRecurringCycle($value)
 * @method static Builder|Invoice whereRecurringStatus($value)
 * @method static Builder|Invoice whereStatus($value)
 * @method static Builder|Invoice whereTemplateId($value)
 * @method static Builder|Invoice whereTerm($value)
 * @method static Builder|Invoice whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $last_recurring_on
 * @method static Builder|Invoice whereLastRecurringOn($value)
 * @property int|null $parent_id
 * @method static Builder|Invoice whereParentId($value)
 */
class Invoice extends Model
{
    use HasFactory;

    public const SELECT_DISCOUNT_TYPE = 0;
    public const FIXED = 1;
    public const PERCENTAGE = 2;

    public const DISCOUNT_TYPE = [
        self::SELECT_DISCOUNT_TYPE => 'Select Discount Type',
        self::FIXED                => 'Fixed',
        self::PERCENTAGE           => 'Percentage',
    ];

    public const DRAFT = 0;
    public const UNPAID = 1;
    public const PAID = 2;
    public const PARTIALLY = 3;
    public const OVERDUE = 4;
    public const STATUS_ALL = 5;
    public const PROCESSING = 6;

    public const STATUS_ARR = [
        self::STATUS_ALL => 'All',
        self::DRAFT      => 'Draft',
        self::UNPAID     => 'Unpaid',
        self::PAID       => 'Paid',
        self::PARTIALLY  => 'Partially Paid',
        self::OVERDUE    => 'Overdue',
        self::PROCESSING => 'Processing',
    ];

    public const RECURRING_OFF = 0;
    public const RECURRING_ON = 1;

    public const RECURRING_STATUS_ARR = [
        self::RECURRING_ON  => 'On',
        self::RECURRING_OFF => 'Off',
    ];

    public const MONTHLY = 1;
    public const QUARTERLY = 2;
    public const SEMIANNUALLY = 3;
    public const ANNUALLY = 4;
    public const RECURRING_ARR = [
        self::MONTHLY      => 'Monthly',
        self::QUARTERLY    => 'Quarterly',
        self::SEMIANNUALLY => 'Semi Annually',
        self::ANNUALLY     => 'Annually',
    ];

    /**
     * Validation rules
     * @var array
     */
    public static $rules = [
        'client_id'    => 'required',
        'invoice_id'   => 'required|unique:invoices,invoice_id',
        'invoice_date' => 'required',
        'due_date'     => 'required',
    ];

    public static $messages = [
        'client_id.required'    => 'The Client field is required.',
        'invoice_date.required' => 'The invoice date field is required.',
        'due_date'              => 'The invoice Due date field is required.',
    ];

    public $table = 'invoices';
    public $appends = ['status_label'];
    public $fillable = [
        'client_id',
        'invoice_date',
        'due_date',
        'invoice_id',
        'currency_id',
        'amount',
        'discount_type',
        'discount',
        'final_amount',
        'note',
        'term',
        'template_id',
        'status',
        'recurring_status',
        'recurring_cycle',
        'last_recurring_on',
        'parent_id',
    ];

    public function getStatusLabelAttribute(): string
    {
        return self::STATUS_ARR[$this->status];
    }

    /**
     *
     * @return BelongsTo
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function invoiceItems(): HasMany
    {
        return $this->hasMany(InvoiceItem::class);
    }

    /**
     * @return string
     */
    public static function generateUniqueInvoiceId(): string
    {
        $invoiceId = mb_strtoupper(Str::random(6));
        while (true) {
            $isExist = self::whereInvoiceId($invoiceId)->exists();
            if ($isExist) {
                self::generateUniqueInvoiceId();
            }
            break;
        }

        return $invoiceId;
    }

    /**
     *
     * @return HasMany
     *
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class, 'invoice_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function AdminPayment(): HasMany
    {
        return $this->hasMany(AdminPayment::class, 'invoice_id', 'id');
    }

    /**
     *
     * @return BelongsTo
     *
     */
    public function invoiceTemplate(): BelongsTo
    {
        return $this->belongsTo(InvoiceSetting::class, 'template_id', 'id');
    }

    public function parentInvoice(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id', 'id');
    }

    public function childInvoices(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }

    /**
     * @param $value
     * @return Setting|mixed
     */
    public function getCurrencyIdAttribute($value)
    {
        if (! empty($value)) {
            return Currency::where('id', $value)->pluck('id')->first();
        }

        return Currency::where('id', getSettingValue('current_currency'))->pluck('id')->first();
    }

    /**
     * @param $value
     */
    public function setInvoiceDateAttribute($value): void
    {
        $this->attributes['invoice_date'] = Carbon::createFromFormat(currentDateFormat(),
            $value)->translatedFormat('Y-m-d');
    }

    /**
     * @param $value
     */
    public function setDueDateAttribute($value): void
    {
        $this->attributes['due_date'] = Carbon::createFromFormat(currentDateFormat(),
            $value)->translatedFormat('Y-m-d');
    }
}
