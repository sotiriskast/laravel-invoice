<?php

return [
    /*
    |--------------------------------------------------------------------------
    | All Titles and static string in blade files - English Language
    |--------------------------------------------------------------------------
    |
    */
    //menu.blade keys
    'dashboard'         => '仪表板',
    'users'             => '用户',
    'settings'          => '设置',
    'apps'              => '应用程序',
    'countries'         => '国家',
    'states'            => '州',
    'cities'            => '城市',
    'roles'             => '角色',
    'sign_out'          => '退出',
    'language'          => '语言',
    'clients'           => '客户',
    'products'          => '产品',
    'invoices'          => '发票',
    'quotes'            => '引号',
    'general'           => '一般',
    'taxes'             => '税收',
    'transactions'      => '交易',
    'categories'        => '类别',
    'invoice_templates' => '发票模板',
    'payments'          => '付款',
    'payment-gateway'   => '支付网关',
    'change_language'   => '改變語言',
    'clear_cache'       => '清除缓存',
    'admin'             => '行政',
    'admins'            => '管理员',
    'add_admin'         => '添加管理员',
    'edit_admin'        => "编辑管理员",
    'admin_details'     => '管理员详情',

    'admin_dashboard' => [
        'dashboard'                   => '仪表板',
        'name'                        => '姓名',
        'registered'                  => '注册',
        'month'                       => '月',
        'year'                        => '年',
        'week'                        => '周',
        'day'                         => '天',
        'total_invoices'              => '总发票',
        'total_clients'               => '总客户',
        'total_payments'              => '总付款',
        'total_products'              => '总产品',
        'total_paid_invoices'         => '总已付发票',
        'total_unpaid_invoices'       => '总未付发票',
        'total_partial_paid_invoices' => '部分支付的总发票',
        'total_overdue_invoice'       => '总逾期发票',
        'payment_overview'            => '付款概览',
        'no_record_found'             => '未找到记录',
        'total_amount'                => '总金额',
        'total_paid'                  => '总支付',
        'total_due'                   => '总到期',
        'yearly_income_overview'      => '年收入概览',
        'monthly_income_overview'     => '每月收入概览',
        'invoice_overview'            => '发票概览',
        'income_overview'             => '收入概览',
    ],

    'common' => [
        'save'            => '保存',
        'submit'          => '提交',
        'cancel'          => '取消',
        'discard'         => '丢弃',
        'country'         => '国家',
        'state'           => '状态',
        'city'            => '城市',
        'please_wait'     => '请稍候...',
        'back'            => '返回',
        'action'          => '动作',
        'add'             => '添加',
        'edit'            => '编辑',
        'name'            => '姓名',
        'details'         => '详情',
        'service'         => '服务',
        'active'          => '活跃',
        'de_active'       => '不活跃',
        'created_at'      => '创建',
        'updated_at'      => '更新',
        'status'          => '状态',
        'filter'          => '过滤器',
        'actions'         => '动作',
        'address'         => '地址',
        'n/a'             => '不适用',
        'filter_options'  => '过滤器选项',
        'reset'           => '重置',
        'payment_type'        => '付款类型',
        'pay'                 => '支付',
        'value'               => '价值',
        'default'             => '默认',
        'allow_file_type'     => '允许的文件类型',
        'save_send'           => '保存并发送',
        'save_draft'          => '另存为草稿',
        'last_update'         => '最后更新',
        'delete'              => '删除',
        'reminder'            => '提醒',
        'custom'              => '风俗',
        'from'                => '从',
        'to'                  => '至',
        'apply'               => '申请',
        'are_you_sure_delete' => '你确定要删除这个吗',
        'deleted'             => '已删除!',
        'has_been_deleted'    => '已被删除.',
        'no_cancel'           => '不，取消',
        'yes_delete'          => '是的，删除!',
        'ok'                  => '好的',
        'error'               => '错误',
    ],

    'user' => [
        'profile_details'  => '个人资料详情',
        'avatar'           => '头像',
        'full_name'        => '全名',
        'email'            => '电子邮件',
        'contact_number'   => '联系电话',
        'save_changes'     => '保存更改',
        'setting'          => '设置',
        'account_setting'  => '账户设置',
        'change_password'  => '修改密码',
        'current_password' => '当前密码',
        'new_password'     => '新密码',
        'confirm_password' => '确认密码',
        'account'          => '账户',
        'user_details'     => '用户详细信息',
        'gender'           => '性别',
        'phone'            => '电话',
        'profile'          => '个人资料',
    ],

    'setting' => [
        'setting'                  => '设置',
        'general'                  => '一般',
        'contact_information'      => '联系信息',
        'currency_settings'        => '货币设置',
        'general_details'          => '一般详细信息',
        'clinic_name'              => '诊所名称',
        'specialities'             => '专业',
        'currencies'               => '货币',
        'prefix'                   => '前缀',
        'address'                  => '地址',
        'postal_code'              => '邮政编码',
        'app_name'                 => '应用名称',
        'company_name'             => '公司名称',
        'app_logo'                 => '应用标志',
        'image_validation'         => '图像必须为 90 x 60 像素。',
        'company_image_validation' => '图像的像素必须为 210 x 50。',
        'company_logo'             => '公司标志',
        'date_format'              => '日期格式',
        'time_format'              => '时间格式',
        'timezone'                 => '时区',
        'decimal_separator'        => '十进制分隔符',
        'thousand_separator'       => '千位分隔符',
        'company_address'          => '公司地址',
        'company_phone'            => '公司电话',
        'fav_icon'                 => '收藏夹图标',
        'invoice_template'         => '发票模板',
        'color'                    => '颜色',
        'mail_notifications'       => '邮件通知',
        'stripe_key'               => '条纹键',
        'stripe_secret'            => '条纹秘密',
        'paypal_client_id'         => '贝宝客户端 ID',
        'paypal_secret'            => '贝宝秘密t',
        'razorpay_key'             => 'Razorpay 密钥',
        'razorpay_secret'          => 'Razorpay 秘密',
        'invoice_no_prefix'        => '发票无前缀',
        'invoice_no_suffix'        => '发票无后缀',
        'payment_auto_approved'    => '付款自动审批',
        'currency_position'        => '货币头寸',
        'show_currency_behind'     => '显示货币背后',
        'invoice_settings'         => '发票设置',
        'manual_payment_approval'  => '人工付款审批',
        'auto_approve'             => '自动批准',
        'country_code'             => '国家代码',
    ],

    'client' => [
        'add_user'         => '添加用户',
        'role'             => '角色',
        'first_name'       => '名字',
        'last_name'        => '姓氏',
        'email'            => '电子邮件',
        'contact_no'       => '联系号码',
        'password'         => '密码',
        'confirm_password' => '确认密码',
        'gender'           => '性别',
        'male'             => '男',
        'female'           => '女',
        'profile'          => '个人资料',
        'edit_user'        => '编辑用户',
        'client'           => '客户',
        'add_client'       => '添加客户端',
        'website'          => '网站',
        'address'          => '地址',
        'client_details'   => '客户详情',
        'postal_code'      => '邮政编码',
        'notes'            => '注释',
        'note'             => '注意',
        'city'             => '城市',
        'role'             => '角色',
        'state'            => '状态',
        'country'          => '国家',
        'created_at'       => '日期',
    ],

    'category' => [
        'add_category'  => '添加类别',
        'edit_category' => '编辑类别',
        'category'      => '类别',
    ],

    'product' => [
        'add_product'     => '添加产品',
        'edit_product'    => '编辑产品',
        'image'           => '图像',
        'name'            => '姓名',
        'code'            => '产品代码',
        'category'        => '类别',
        'price'           => '价格',
        'unit_price'      => '单价',
        'description'     => '说明',
        'product'         => '产品',
        'updated_at'      => '更新时间',
        'product_name'    => '产品名称',
        'product_details' => '产品详情',
    ],

    'invoice' => [
        'new_invoice'      => '新发票',
        'edit_invoice'     => '编辑发票',
        'client'           => '客户',
        'invoice_date'     => '发票日期',
        'discount'         => '折扣',
        'add'              => '添加',
        'qty'              => '数量',
        'tax'              => '税',
        'price'            => '价格',
        'amount'           => '金额',
        'invoice_id'       => '发票编号',
        'sub_total'        => '小计',
        'total'            => '总计',
        'due_date'         => '截止日期',
        'recurring'        => '再次发生的',
        'total_tax'        => '税',
        'client_name'      => '客户端名称',
        'client_email'     => '客户电子邮件',
        'invoice_details'  => '发票明细',
        'add_note_term'    => '添加注释和术语',
        'remove_note_term' => '删除注释和条款',
        'note'             => '注意',
        'terms'            => "条款",
        'print_invoice'    => '打印发票',
        'discount_type'    => '折扣类型',
        'invoice'          => '发票',
        'paid'             => '付费',
        'due_amount'       => '到期金额',
        'payment_method'   => '付款方式',
        'invoice_pdf'      => '发票',
        'transactions'     => '交易',
        'download'         => '下载',
        'payment'            => '付款',
        'overview'           => '概览',
        'note_terms'         => '注意和条款',
        'payment_history'    => '付款历史',
        'issue_for'          => '问题为',
        'issue_by'           => '发布者',
        'paid_amount'        => '支付金额',
        'remaining_amount'   => '剩余金额',
        'client_overview'    => '客户概览',
        'note_not_found'     => '找不到笔记',
        'terms_not_found'    => '未找到条款',
        'make_payment'       => '付款',
        'excel_export'       => 'Excel 导出',
        'invoice_url'        => '发票网址',
        'invoice_number'     => '发票号码',
        'recurring_cycle'    => '循环周期',
        'recurring_invoices' => '经常性发票',
        'last_recurring_on'  => '上次重复时间',
        'parent_invoice'     => '家长发票',
        'stop_recurring'     => '停止重复',
        'start_recurring'    => '开始重复',
    ],

    'quote' => [
        'new_quote'          => 'Neues Zitat',
        'edit_quote'         => 'Zitat bearbeiten',
        'quote_date'         => 'Angebotsdatum',
        'quote_id'           => 'Zitat-ID',
        'quote_details'      => 'Angebotsdetails',
        'quote'              => 'Zitat',
        'quote_pdf'          => 'Zitat',
        'quote_url'          => 'Zitat-URL',
        'convert_to_invoice' => 'In Rechnung umwandeln',
        'quote_number'       => 'Angebotsnummer',
        'print_quote'        => 'Angebot drucken',
        'client'             => '客户',
        'discount'           => '折扣',
        'add'                => '添加',
        'qty'                => '数量',
        'tax'                => '税',
        'price'              => '价格',
        'amount'             => '金额',
        'sub_total'          => '小计',
        'total'              => '总计',
        'due_date'           => '截止日期',
        'recurring'          => '再次发生的',
        'total_tax'          => '税',
        'client_name'        => '客户端名称',
        'client_email'       => '客户电子邮件',
        'add_note_term'      => '添加注释和术语',
        'remove_note_term'   => '删除注释和条款',
        'note'               => '注意',
        'terms'              => "条款",
        'discount_type'      => '折扣类型',
        'paid'               => '付费',
        'due_amount'         => '到期金额',
        'payment_method'     => '付款方式',
        'transactions'       => '交易',
        'download'           => '下载',
        'payment'            => '付款',
        'overview'           => '概览',
        'note_terms'         => '注意和条款',
        'payment_history'    => '付款历史',
        'issue_for'          => '问题为',
        'issue_by'           => '发布者',
        'paid_amount'        => '支付金额',
        'remaining_amount'   => '剩余金额',
        'client_overview'    => '客户概览',
        'note_not_found'     => '找不到笔记',
        'terms_not_found'    => '未找到条款',
        'make_payment'       => '付款',
        'excel_export'       => 'Excel 导出',
    ],

    'tax' => [
        'tax'        => '税',
        'add_tax'    => '加税',
        'edit_tax'   => '编辑税',
        'is_default' => '是默认值',
        'yes'        => '是',
        'no'         => '不',
    ],

    'notification' => [
        'notifications'                       => '通知',
        'mark_all_as_read'                    => '标记为已读',
        'you_don`t_have_any_new_notification' => '您没有任何新通知',
    ],

    'payment' => [
        'payment_date'      => '付款日期',
        'add_payment'       => '添加付款',
        'payable_amount'    => '应付金额',
        'payment_type'      => '付款类型',
        'payment_mode'      => '付款方式',
        'transaction_id'    => '交易ID',
        'payment_amount'    => '付款金额',
        'payment_method'    => '付款方式',
        'edit_payment'      => '编辑付款',
        'transaction_notes' => '交易记录',
    ],

    'currency' => [
        'add_currency'  => '添加货币',
        'edit_currency' => '编辑货币',
        'icon'          => '图标',
        'currency_code' => '货币代码',
        'currency'      => '货币',
    ],

    'months' => [
        'jan' => '简',
        'feb' => '二月',
        'mar' => '三月',
        'apr' => '四月',
        'may' => '可能',
        'jun' => '君',
        'jul' => '八月',
        'aug' => '九月',
        'sep' => '十月',
        'oct' => '十一月',
        'nov' => '十二月',
        'dec' => '太阳',
    ],

    'weekdays' => [
        'sun' => '太阳',
        'mon' => '星期一',
        'tue' => '周二',
        'wed' => '星期三',
        'thu' => '周四',
        'fri' => '周五',
        'sat' => '星期六',
    ],

    'datepicker' => [
        'today'      => '今天',
        'this_week'  => '本星期',
        'last_week'  => '上周',
        'this_month' => '这个月',
        'last_month' => '上个月',
    ],

    'flash' => [
        'client_cant_deleted'   => '无法删除客户端。',
        'category_cant_deleted' => '类别不能删除',
        'product_cant_deleted'  => '产品不能被删除。',
        'tax_can_not_deleted'   => '税收不能被删除。',
    ],
];