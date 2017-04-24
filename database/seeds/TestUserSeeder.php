<?php

use Illuminate\Database\Seeder;

class TestUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(\App\Service\UserService $service)
    {
        $first_names = explode(' ', '赵 钱 孙 李 周 吴 郑 王 冯 陈 楮 卫 蒋 沈 韩 杨 朱 秦 尤 许 何 吕 施 张 孔 曹 严 华 金 魏 陶 姜 戚 谢 邹 喻 柏 水 窦 章 云 苏 潘 葛 奚 范 彭 郎 鲁 韦 昌 马 苗 凤 花 方 俞 任 袁 柳 酆 鲍 史 唐 费 廉 岑 薛 雷 贺 倪 汤 滕 殷 罗 毕 郝 邬 安 常 乐 于 时 傅 皮 卞 齐 康 伍 余 元 卜 顾 孟 平 黄 和 穆 萧 尹 姚 邵 湛 汪 祁 毛 禹 狄 米 贝 明 臧 计 伏 成 戴 谈 宋 茅 庞 熊 纪 舒 屈 项 祝 董 梁 杜 阮 蓝 闽 席 季 麻 强 贾 路 娄 危 江 童 颜 郭 梅 盛 林 刁 锺 徐 丘 骆 高 夏 蔡 田 樊 胡 凌 霍 虞 万 支 柯 昝 管 卢 莫 经 房 裘 缪 干 解 应 宗 丁 宣 贲 邓 郁 单 杭 洪 包 诸 左 石 崔 吉 钮 龚 程 嵇 邢 滑 裴 陆 荣 翁 荀 羊 於 惠 甄 麹 家 封 芮 羿 储 靳 汲 邴 糜 松 井 段 富 巫 乌 焦 巴 弓 牧 隗 山 谷 车 侯 宓 蓬 全 郗 班 仰 秋 仲 伊 宫 宁 仇 栾 暴 甘 斜 厉 戎 祖 武 符 刘 景 詹 束 龙 叶 幸 司 韶 郜 黎 蓟 薄 印 宿 白 怀 蒲 邰 从 鄂 索 咸 籍 赖 卓 蔺 屠 蒙 池 乔 阴 郁 胥 能 苍 双 闻 莘 党 翟 谭 贡 劳 逄 姬 申 扶 堵 冉 宰 郦 雍 郤 璩 桑 桂 濮 牛 寿 通 边 扈 燕 冀 郏 浦 尚 农 温 别 庄 晏 柴 瞿 阎 充 慕 连 茹 习 宦 艾 鱼 容 向 古 易 慎 戈 廖 庾 终 暨 居 衡 步 都 耿 满 弘 匡 国 文 寇 广 禄 阙 东 欧 殳 沃 利 蔚 越 夔 隆 师 巩 厍 聂 晁 勾 敖 融 冷 訾 辛 阚 那 简 饶 空 曾 毋 沙 乜 养 鞠 须 丰 巢 关 蒯 相 查 后 荆 红 游 竺 权 逑 盖 益 桓 公 万俟 司马 上官 欧阳 夏侯 诸葛 闻人 东方 赫连 皇甫 尉迟 公羊 澹台 公冶 宗政 濮阳 淳于 单于 太叔 申屠 公孙 仲孙 轩辕 令狐 锺离 宇文 长孙 慕容 鲜于 闾丘 司徒 司空 丌官 司寇 仉 督 子车 颛孙 端木 巫马 公西 漆雕 乐正 壤驷 公良 拓拔 夹谷 宰父 谷梁 晋 楚 阎 法 汝 鄢 涂 钦 段干 百里 东郭 南门 呼延 归 海 羊舌 微生 岳 帅 缑 亢 况 后 有 琴 梁丘 左丘 东门 西门 商 牟 佘 佴 伯 赏 南宫 墨 哈 谯 笪 年 爱 阳 佟');
        $last_names = explode(' ', '婧文 威皓 山川 吾光 璇海 学海 午光 绚海 吾行 腾 宵蕙 雾瑕 紫豪 敏 轩海 家豪 海洲 容 礼义 宇 萸艳 天宇 艳 小瑞 健民 大宇 彪 建荣 玉胜 新文 墨然 浩然 智渊 维杰 树岗 唯伊 雪凡 丽荣 稼婷 琳琳 人稼 白茹 辰生 甜也 洪坚 绍旭 芳 墨涵 天涵 赛旭 继锋 秋凤 士皓 甜冶 刚 艳臣 舔业 湛博 泰彰 欷西 华 倩云 春燕 静 瑞凯 嘉琦 俊霞 一鹤 梓含 若岚 若兰 文婷 家同 英博 珈影 凯 竣景 晏 大炜 子仪 墨琴 馨 章光 一璇 淑敏 久久 品良 希远 本山 雪阳 培雁 英杰 纯一 伟 存富 思媛 思谦 春富 雍婷 永婷 晨希 曼孜 曼希 博 敏孜 莉蓉 敏希 柳清 一龙 程程 婷婷 柯朱 春丽 柯焦 甜耶 淮音 红艳 小焦 红炎 春雷 卓群 莉莎 红菲 乙诚 乙铖 依琳 文蓉 婧燕 玲 珮霖 瑛 志 鑫宇 常景 鑫凯 静茹 桦 臻 美琪 建博 家成 天爱 子茜 龙 月华 天慈 芪 洁 心如 文杰 晨羲 红娜 美娜 宸希 惠娜 宸羲 辰羲 宸熹 辰熹 红燕 辰希 凡与 建红 凡舆 子嫣 珂阳 子文 晓超 君瑷 安邦 芬 健辉 蓉 雪利 文卿 奕成 连弯 忠义 皇帝 芃芃 燕梅 智 祈雯 若雅 耀 春光 聆伶 学健 若君 文清 若均 健 宏钢 家乐 殊锋 杰 久乐 显锋 紫梁 广森 筱 怡鑫 筱雯 萍 筱茹 俊杰 亚楠 菁 艺寒 婉肜 文辉 祈妍 紫藤 祈萱 向 茂成 跃华 宝禾 津 凤喜 学梅 惠 勃翔 怡哲 粒米 若宇 国伟 利坛 芷砚 子砚 之砚 传宇 国访 博新 稚砚 执砚 芷若 止若 丽萍 康伯 孟竹 燕 春晖 涵 施皓 籽珺 吉贵 艺伟 强 祥龙 慧懿 思童 鹏琰 迎余 芮婕 涔伶 家先 芙蓉 家虞 家妤 小雅 晓雅 芮漩 家婕 鑫淼 素 家婧 淦彪 启程 若曦 红兴 森河 志义 旭 俊莉 根 邦宇 玥琀 俊荔 振中 莎莎 家岚 祝海 缔 祝江 玥涵 华清 翊铭 国仙 启言 红叶 博洋 珈言 风锐 玮 世雄 奕淼 开平 文华 小兰');
        $domains = explode(' ', 'qq.com 163.com 126.com gmail.com sina.com hotmail.com vip.qq.com foxmail.com sina.cn yeah.net sohu.com live.cn outlook.com aliyun.com yahoo.com');
        for ($i = 0; $i < 100; $i++){
            $first_name = $first_names[rand(0, count($first_names)-1)];
            $last_name = $last_names[rand(0, count($last_names)-1)];
            $name = $first_name . $last_name;
            $email = \Illuminate\Support\Str::random(rand(4,10)) . "@" . $domains[rand(0, count($domains)-1)];

            $service->create([
                'name'=>$name,
                'email'=>$email,
                'password'=>bcrypt(\Illuminate\Support\Str::random()),
                'register_ip' => long2ip(rand()),
                'created_at' => date('Y-m-d H:i:s', strtotime('-' . $i . 'day')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-' . $i . 'day')),
            ]);
        }
        $this->command->info('created 100 users done!');
    }
}
