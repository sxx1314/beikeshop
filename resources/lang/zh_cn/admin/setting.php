<?php
/**
 * order.php
 *
 * @copyright  2022 beikeshop.com - All Rights Reserved
 * @link       https://beikeshop.com
 * @author     Edward Yang <yangjin@guangda.work>
 * @created    2022-08-02 14:22:41
 * @modified   2022-08-02 14:22:41
 */

return [
    'index' => '系统设置',
    'settings_index' => '查看系统设置',
    'settings_update' => '修改系统设置',
    'design_index' => '首页编辑器',
    'design_footer_index' => '页尾编辑器',
    'design_menu_index' => '导航编辑器',
    'product_per_page' => '每页显示数量',

    'basic_settings' => '基础设置',
    'store_settings' => '商店设置',
    'picture_settings' => '图片设置',
    'use_queue' => '是否使用队列',
    'mail_settings' => '邮件设置',
    'mail_engine' => '邮件引擎',
    'smtp_host' => '主机',
    'smtp_username' => '用户',
    'smtp_encryption' => '加密方式',
    'smtp_encryption_info' => 'SSL 或者 TLS',
    'smtp_password' => '密码',
    'smtp_password_info' => '设置 SMTP 密码。Gmail 请参考：https://security.google.com/settings/security/apppasswords',
    'smtp_port' => '端口',
    'smtp_timeout' => '超时',
    'sendmail_path' => '执行路径',
    'mailgun_domain' => '域名',
    'mailgun_secret' => '密钥',
    'mailgun_endpoint' => '端口',
    'mail_log' => '说明：日志引擎一般用于测试目的！邮件将不会被真实发送至收件地址，邮件内容会以日志形式保存在 `/storage/logs/laravel.log`',

    'theme_default' => '默认主题',
    'theme_black' => '黑色主题',
    'shipping_address' => '发货地址',
    'payment_address' => '账单地址',
    'meta_title' => 'Meta 标题',
    'meta_description' => 'Meta 描述',
    'meta_keyword' => 'Meta 关键词',
    'telephone' => '联系电话',
    'email' => '邮箱',
    'default_address' => '默认地址',
    'default_country_set' => '默认国家设置',
    'default_zone_set' => '默认省份设置',
    'default_language' => '默认语言',
    'default_currency' => '默认货币',
    'default_customer_group' => '默认客户组',
    'admin_name' => '后台目录',
    'admin_name_info' => '管理后台目录,默认为admin',
    'enable_tax' => '启用税费',
    'enable_tax_info' => '是否启用税费计算',
    'tax_address' => '税费地址',
    'tax_address_info' => '按什么地址计算税费',
    'logo' => '网站 Logo',
    'favicon' => 'favicon',
    'favicon_info' => '显示在浏览器选项卡上的小图标，必须为PNG格式大小为：32*32',
    'placeholder_image' => '占位图',
    'head_code' => '插入代码',
    'head_code_info' => '会将输入框中的代码插入到前端页面 head 中，可用于统计代码或者添加特殊插件等',
];
