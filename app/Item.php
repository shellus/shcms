<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Item
 *
 * @property int $id
 * @property int $ordid 自定义排序
 * @property int $cate_id 属于分类
 * @property int $orig_id
 * @property string $num_iid
 * @property string $title
 * @property string $intro
 * @property string $headPic
 * @property string $feedback
 * @property string $nicker
 * @property string $nicker1
 * @property string $feedback1
 * @property string $headPic1
 * @property string $nicker2
 * @property string $feedback2
 * @property string $headPic2
 * @property string $nicker3
 * @property string $feedback3
 * @property string $headPic3
 * @property string $nicker4
 * @property string $feedback4
 * @property string $headPic4
 * @property string $desc
 * @property string $tags
 * @property string $nick
 * @property string $sellerId
 * @property int $uid
 * @property string $uname
 * @property string $pic_url
 * @property string $pic_urls 宽版图片
 * @property float $price
 * @property string $click_url
 * @property int $volume
 * @property float $commission
 * @property int $commission_rate
 * @property float $coupon_price
 * @property int $coupon_rate
 * @property int $coupon_start_time
 * @property int $coupon_end_time
 * @property int $pass 是否审核
 * @property string $status 出售状态
 * @property string $fail_reason 未通过理由
 * @property string $shop_type
 * @property string $item_url 宝贝地址
 * @property int $ems
 * @property string $qq
 * @property string $mobile
 * @property string $realname
 * @property int $hits 点击量
 * @property int $isshow
 * @property int $likes
 * @property int $inventory 库存
 * @property string $seo_title
 * @property string $seo_keys
 * @property string $seo_desc
 * @property int $add_time
 * @property int $last_rate_time
 * @property int $is_collect_comments 是否采集了淘宝评论1表示已经采集了淘宝评论
 * @property string $cu
 * @property int $sex
 * @property int $isq
 * @property string $quan
 * @property string $quanurl
 * @property string $Quan_condition
 * @property int $Quan_surplus
 * @property int $Quan_receive
 * @property string $tao_kou_ling
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereAddTime($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereCateId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereClickUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereCommission($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereCommissionRate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereCouponEndTime($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereCouponPrice($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereCouponRate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereCouponStartTime($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereCu($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereDesc($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereEms($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereFailReason($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereFeedback($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereFeedback1($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereFeedback2($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereFeedback3($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereFeedback4($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereHeadPic($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereHeadPic1($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereHeadPic2($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereHeadPic3($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereHeadPic4($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereHits($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereIntro($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereInventory($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereIsCollectComments($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereIsq($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereIsshow($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereItemUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereLastRateTime($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereLikes($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereMobile($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereNick($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereNicker($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereNicker1($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereNicker2($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereNicker3($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereNicker4($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereNumIid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereOrdid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereOrigId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item wherePass($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item wherePicUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item wherePicUrls($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item wherePrice($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereQq($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereQuan($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereQuanCondition($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereQuanReceive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereQuanSurplus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereQuanurl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereRealname($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereSellerId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereSeoDesc($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereSeoKeys($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereSeoTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereSex($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereShopType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereTags($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereTaoKouLing($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereUid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereUname($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereVolume($value)
 * @mixin \Eloquent
 */
class Item extends Model
{
    protected $connection="taobao";
    protected $table="htian_items";
}
