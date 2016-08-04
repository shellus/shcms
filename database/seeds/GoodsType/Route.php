<?php
/**
 * Created by PhpStorm.
 * User: shellus
 * Date: 2016-08-04
 * Time: 13:38
 */

namespace GoodsTyoe;


use App\Attribute;
use App\AttributeOption;
use App\GoodsType;

class Route
{
    /**
     * Route constructor.
     */
    public function __construct()
    {
        $goods_type_data = [
            'title' => '路由器',
            'attributes' =>
        ];
        $goods_type = GoodsType::create([

        ]);

        $options = ;

        $attributes = [
            Attribute::create([
                'title' => '网络类型',
                'type' => 'select',
            ])->attributeOptions()->saveMany([
                AttributeOption::create([
                    'title' => '2.4G',
                ]),
                AttributeOption::create([
                    'title' => '5G',
                ]),
                AttributeOption::create([
                    'title' => '2.4G&5G',
                    'value' => 'value_test',
                ]),
            ]),
        ];

           $goods_type ->attributes()->saveMany([



        ]);
//        [
//            Attribute::create([
//                'title' => '是否无线',
//                'type' => 'select',
//            ])->attributeOptions()->saveMany([
//                AttributeOption::create([
//                    'title' => '无线',
//                ]),
//                AttributeOption::create([
//                    'title' => '有线',
//                ]),
//            ]),
//
//            Attribute::create([
//                'title' => '适用对象',
//                'type' => 'checkbox',
//            ])->attributeOptions()->saveMany([
//                AttributeOption::create([
//                    'title' => '宽带VPN路由器',
//                ]),
//                AttributeOption::create([
//                    'title' => '企业级路由器',
//                ]),
//                AttributeOption::create([
//                    'title' => '迷你无线路由器',
//                ]),
//                AttributeOption::create([
//                    'title' => '家用',
//                ]),
//                AttributeOption::create([
//                    'title' => '电信级高端路由器',
//                ]),
//            ]),
//        ];
    }

}