<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| The following language lines contain the default error messages used by
	| the validator class. Some of these rules have multiple versions such
	| as the size rules. Feel free to tweak each of these messages here.
	|
	*/

    "sub_password"         => "新支付密码格式错误",
    "old_sub_password"     => "支付密码错误",
    "old_password"         => "密码错误",
	"accepted"             => ":attribute 必须被接受.",
	"active_url"           => ":attribute不是一个有效的URL。",
	"after"                => ":attribute 必须是一个日期 :date.",
	"alpha"                => ":attribute 只能包含字母.",
	"alpha_dash"           => ":attribute 只能包含字母，数字，和破折号.",
	"alpha_num"            => ":attribute 只能包含字母和数字.",
	"array"                => ":attribute 必须是一个数组.",
	"before"               => ":attribute 必须是一个日期 :date.",
	"between"              => [
		"numeric" => ":attribute 必须在 :min 至 :max.",
		"file"    => ":attribute 必须在 :min and :max 千字节.",
		"string"  => ":attribute 必须在 :min and :max 字符.",
		"array"   => ":attribute 必须在 :min and :max 项目.",
	],
	"boolean"              => ":attribute 字段必须为真或假.",
	"confirmed"            => ":attribute 确认不匹配.",
	"date"                 => ":attribute 不是一个有效的日期.",
	"date_format"          => ":attribute 格式不符 :format.",
	"different"            => ":attribute 和 :other 必须是不同的.",
	"digits"               => ":attribute 必须 :digits 数字.",
	"digits_between"       => ":attribute 必须在 :min and :max 数字.",
	"email"                => ":attribute 必须是有效的电子邮件地址.",
	"filled"               => ":attribute 字段是必需的.",
	"exists"               => "指定的 :attribute 无效.",
	"image"                => ":attribute 必须是一个图像.",
	"in"                   => "指定的 :attribute 无效.",
	"integer"              => ":attribute 必须是一个整数.",
	"ip"                   => ":attribute 必须是一个有效的IP地址.",
	"max"                  => [
		"numeric" => ":attribute 不得大于 :max.",
		"file"    => ":attribute 不得大于 :max 千字节.",
		"string"  => ":attribute 不得大于 :max 字符.",
		"array"   => ":attribute 不得超过 :max 项目.",
	],
	"mimes"                => "The :attribute must be a file of type: :values.",
	"min"                  => [
		"numeric" => ":attribute 最小为 :min.",
		"file"    => "The :attribute must be at least :min kilobytes.",
		"string"  => ":attribute 至少为 :min 个字符.",
		"array"   => "The :attribute must have at least :min items.",
	],
	"not_in"               => "选项 :attribute 是无效的.",
	"numeric"              => ":attribute 必须是一个数字.",
	"regex"                => ":attribute 格式不正确.",
	"required"             => ":attribute 字段是必填的哦.",
	"required_if"          => ":attribute 字段是必需的 when :other is :value.",
	"required_with"        => ":attribute 字段是必需的 when :values is present.",
	"required_with_all"    => ":attribute 字段是必需的 when :values is present.",
	"required_without"     => ":attribute 字段是必需的 when :values is not present.",
	"required_without_all" => ":attribute 字段是必需的 when none of :values are present.",
	"same"                 => ":attribute and :other must match.",
	"size"                 => [
		"numeric" => "The :attribute must be :size.",
		"file"    => "The :attribute must be :size kilobytes.",
		"string"  => "The :attribute must be :size characters.",
		"array"   => "The :attribute must contain :size items.",
	],
	"unique"               => ":attribute 已经存在",
	"url"                  => ":attribute 格式不合法",
	"timezone"             => ":attribute 不在有效范围",

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| Here you may specify custom validation messages for attributes using the
	| convention "attribute.rule" to name the lines. This makes it quick to
	| specify a specific custom language line for a given attribute rule.
	|
	*/

	'custom' => [
		'attribute-name' => [
			'rule-name' => 'custom-message',
		],
	],

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Attributes
	|--------------------------------------------------------------------------
	|
	| The following language lines are used to swap attribute place-holders
	| with something more reader friendly such as E-Mail Address instead
	| of "email". This simply helps us make messages a little cleaner.
	|
	*/

    'submit_title' => '提交',
	'attributes' => [
		'name' => "用户名",
        'email' => "电子邮箱",
        'password' => "密码",
        'new_password' => "新密码",
        'sub_password' => "支付密码",
        'timezone' =>"时间",
        'mobile' => '手机号码',
        'actual_name' => '真实姓名',

        'id' => 'ID',
        'title' => '标题',
        'description' => '说明',
        'parent_id' => '父ID',
        'body' => '内容',
        'user_id' => '用户ID',
	],

];
