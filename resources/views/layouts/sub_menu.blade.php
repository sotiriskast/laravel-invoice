<li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('*/dashboard*') ? 'd-none' : '' }}">
    @hasrole('admin')
    <a class="nav-link p-0 {{ Request::is('*/dashboard*') ? 'active' : '' }}"
       href="{{ route('admin.dashboard') }}">{{ __('messages.dashboard') }}</a>
    @endrole
    @hasrole('client')
    <a class="nav-link p-0 {{ Request::is('*/dashboard*') ? 'active' : '' }}"
       href="{{ route('client.dashboard') }}">{{ __('messages.dashboard') }}</a>
    @endrole
</li>
<li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('admin/users*') ? 'd-none' : '' }}">
    <a class="nav-link p-0 {{ Request::is('admin/users*') ? 'active' : '' }}"
       href="{{ route('users.index') }}">{{ __('messages.admins') }}</a>
</li>
<li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('admin/clients*') ? 'd-none' : '' }}">
    <a class="nav-link p-0 {{ Request::is('admin/clients*') ? 'active' : '' }}"
       href="{{ route('clients.index') }}">{{ __('messages.clients') }}</a>
</li>
<li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('admin/categories*') ? 'd-none' : '' }}">
    <a class="nav-link p-0 {{ Request::is('admin/categories*') ? 'active' : '' }}"
       href="{{ route('category.index') }}">{{ __('messages.categories') }}</a>
</li>
<li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('admin/taxes*') ? 'd-none' : '' }}">
    <a class="nav-link p-0 {{ Request::is('admin/taxes*') ? 'active' : '' }}"
       href="{{ route('taxes.index') }}">{{ __('messages.taxes') }}</a>
</li>
<li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('admin/products*') ? 'd-none' : '' }}">
    <a class="nav-link p-0 {{ Request::is('admin/products*') ? 'active' : '' }}"
       href="{{ route('products.index') }}">{{ __('messages.products') }}</a>
</li>
@role('admin')
<li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('admin/transactions*') ? 'd-none' : '' }}">
    <a class="nav-link p-0 {{ Request::is('admin/transactions*') ? 'active' : '' }}"
       href="{{ route('transactions.index') }}">{{ __('messages.transactions') }}</a>
</li>
@else
    <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('client/transactions*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('client/transactions*') ? 'active' : '' }}"
           href="{{ route('client.transactions.index') }}">{{ __('messages.transactions') }}</a>
    </li>
    @endrole
    <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('*/quotes*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('*/quotes*') ? 'active' : '' }}"
           href="{{ route('quotes.index') }}">{{ __('messages.quotes') }}</a>
    </li>
    <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('*/invoices*') ? 'd-none' : '' }}">
        @role('admin')
        <a class="nav-link p-0 {{ Request::is('*/invoices*') ? 'active' : '' }}"
           href="{{ route('invoices.index') }}">{{ __('messages.invoices') }}</a>
        @endrole
        @hasrole('client')
        <a class="nav-link p-0 {{ Request::is('*/invoices*') ? 'active' : '' }}"
           href="{{ route('client.invoices.index') }}">{{ __('messages.invoices') }}</a>
        @endrole
    </li>
    <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('admin/template-setting*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('admin/template-setting*') ? 'active' : '' }}"
           href="{{ route('invoiceTemplate') }}">{{ __('messages.invoice_templates') }}</a>
    </li>
    @role('admin')
    <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ !Request::is('admin/payments*') ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('admin/payments*') ? 'active' : '' }}"
           href="{{ route('payments.index') }}">{{ __('messages.payments') }}</a>
    </li>
    @endrole
    @role('admin')
    {{--     Admin Subscription Sub Menu--}}
    <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ (!Request::is('admin/settings*', 'admin/currencies*', 'admin/payment-gateway*','admin/invoice-settings')) ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ isset($sectionName)?($sectionName == 'general' ? 'active' : ''):'' }}"
           href="{{ route('settings.edit',['section' => 'general']) }}">{{ __('messages.general') }}</a>
    </li>

    <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ (!Request::is('admin/settings*', 'admin/currencies*', 'admin/payment-gateway*','admin/invoice-settings')) ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('admin/currencies*') ? 'active' : '' }}"
           href="{{ route('currencies.index') }}">{{__('messages.setting.currencies')}}</a>
    </li>
    
    <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ (!Request::is('admin/settings*', 'admin/currencies*', 'admin/payment-gateway*','admin/invoice-settings')) ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('admin/payment-gateway*') ? 'active' : '' }}"
           href="{{ route('payment-gateway.show',['section' => 'payment-gateway']) }}">{{__('messages.payment-gateway')}}</a>
    </li>
    
    <li class="nav-item position-relative mx-xl-3 mb-3 mb-xl-0 {{ (!Request::is('admin/settings*', 'admin/currencies*', 'admin/payment-gateway*' ,'admin/invoice-settings')) ? 'd-none' : '' }}">
        <a class="nav-link p-0 {{ Request::is('admin/invoice-settings*') ? 'active' : '' }}"
           href="{{ route('settings.invoice-settings') }}">{{__('messages.setting.invoice_settings')}}</a>
    </li>
    @endrole
