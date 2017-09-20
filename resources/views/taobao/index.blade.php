<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>商品列表</title>
    <link href="https://cdn.bootcss.com/semantic-ui/2.2.13/semantic.min.css" rel="stylesheet">
    <style type="text/css">
        body > .ui.container {
            margin-top: 3em;
        }

        .ui.container > h1 {
            font-size: 3em;
            text-align: center;
            font-weight: normal;
        }

        .ui.container > h2.dividing.header {
            font-size: 2em;
            font-weight: normal;
        }

        .menu{
            border-radius:0 !important;
        }
        .sub{
            display: inline-block !important;
            padding-left: 0.3em !important;
        }

    </style>
</head>
<body>
<div class="ui inverted borderless nine item menu">

    <a href="#" class="item"></a>
    <a href="#" class="item">
        <h1>打折商品大全</h1>
    </a>
    <a href="#" class="item"><span class="ui red header">全</span></a>
    <a href="#" class="item"><span class="ui purple header">部</span></a>
    <a href="#" class="item"><span class="ui yellow header">大</span></a>
    <a href="#" class="item"><span class="ui violet header">甩</span></a>
    <a href="#" class="item"><span class="ui orange header">卖</span></a>
    <a href="#" class="item"><span class="ui brown header">！！！</span></a>
    <a href="#" class="item">
        <div class="ui search">
            <div class="ui icon input">
                <input class="prompt" type="text" placeholder="搜索...">
                <i class="search icon"></i>
            </div>
            <div class="results"></div>
        </div>
    </a>
    <a href="#" class="item"></a>

</div>
<div class="ui container">
    <h2 class="ui dividing blue header"> 最新特惠<a class="sub header" href="#">全部成本价，一件不留..</a></h2>
    <div class="ui segment" style="">
        <div class="ui four cards">
            @foreach($models as $model)
                <?php /** @var $model \App\Item */?>


                <div class="ui card">
                    <div class="image">
                        <img src="{{ $model -> pic_url }}">
                    </div>
                    <div class="content">
                        <a class="header">￥{{ $model->coupon_price }}
                            <small style="text-decoration: line-through;" class="sub header">￥{{ $model->price }}</small>
                        </a>

                        <div class="meta">
                            <span class="date">{{ $model -> clickUrl }}</span>
                        </div>
                        <div class="description">
                            {{ $model -> title }}
                        </div>
                    </div>
                    <div class="extra content">
                        <a>
                            <i class="user icon"></i>
                            22 Friends
                        </a>
                    </div>
                </div>

            @endforeach
        </div>

    </div>
    <div class="">
        {{ $models->links('vendor/pagination/pagination-advanced') }}
    </div>

</div>
<br><br>
<div class="ui vertical secondary very padded segment">
    <div class="ui container">
        <div class="sub header">
            卖完回家种田去了，一件不留，全部半卖半送
        </div>

        <div class="ui divider"></div>

        <div class="ui five column grid">
            <div class="column">
                <div class="ui vertical text menu">
                    <div class="item">
                        <h4>这些地方卖得很贵</h4>
                    </div>
                    <a class="item">查找零售店</a>
                    <a class="item">天猫</a>
                    <a class="item">淘宝</a>
                    <a class="item">聚美优品</a>
                    <a class="item">爱逛街</a>
                </div>
            </div>
            <!-- 段落重复4遍ing -->
        </div>
    </div>
</div>

<script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/semantic-ui/2.2.13/semantic.min.js"></script>
</body>
</html>