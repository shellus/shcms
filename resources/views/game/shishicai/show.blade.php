@extends('game.shishicai.layout')
@section('head')
    <title>{{$lottery -> title}}</title>

    <script src="{{asset('/js/angular.js')}}"></script>
    <script src="{{asset('/angular-bootstrap/ui-bootstrap.js')}}"></script>
    <script src="{{asset('/angular-bootstrap/ui-bootstrap-tpls.js')}}"></script>



    <script src="{{asset('/js/config.js')}}"></script>
    <script>sh.config.addPrefix('/game/shishicai');</script>
    <script>sh.config.set('LOTTERY_ID', '{{$lottery -> id}}');</script>
    <script src="{{asset('/game/shishicai/controller/play.js')}}"></script>

    <style>

        .play-table .list-inline{
            display: inline-block;
        }
        .selects>li{
            margin: 0 10px;
        }
        .numbers{
            margin: 0 10px;
        }
        .numbers>label{
            margin-right: 6px;
        }
        .l_row{
            margin-bottom: 6px;
        }
    </style>

@endsection


@section('content')

    @include('game.shishicai.opentime')
    <!--投注台--->
    <div role="tabpanel" class="selecttabs" ng-controller="Play">
        <!--星级选择器--->
        <ul class="nav nav-tabs play_label_a">
            <li role="presentation" class="active" ng-repeat="play_label_a in play_label_as">
                <a href="#" ng-click="click_a(play_label_a.id)" role="tab" data-toggle="tab">
                    @{{play_label_a.title}}
                </a>
            </li>
        </ul>

        <!--投注选择器--->
        <div id="beter">
            {{--玩法选择--}}
            <div class="play-label-b">
                <ul class="list-inline" ng-repeat="play_label_b in play_label_bs">
                    <li>
                        <label>@{{ play_label_b.title }}</label>
                        <ul class="list-inline play-label-c" ng-repeat="play_label_c in play_label_b.child">
                            <li>
                                <a href="#" ng-click="click_c(play_label_c)">
                                    @{{ play_label_c.title }}
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            {{--选彩票的框--}}
            <div class="play-table">
                <div class="play-label-tip">
                    <button popover="玩法:@{{ grid.rule }}" popover-trigger="mouseenter" class="btn btn-default btn-xs">玩法</button>
                    <button popover="演示:@{{ grid.example }}" popover-trigger="mouseenter" class="btn btn-default btn-xs">演示</button>
                    <span>@{{ grid.tip }}</span>
                </div>
                <div class="play-label-grid"ng-switch on="grid.display.type">

                    <textarea ng-switch-when="edit" placeholder="输入投注内容后，按句号、逗号、分号、回车、空格进行确认" onkeyup="this.value=this.value.replace(/[^\d|,]/g,'')"  ng-model=""></textarea>


                    <div ng-switch-when="table">
                        <ul>
                            <li class="l_row" ng-repeat="low in grid.display.grid">
                                <label class="label">@{{ low.label }}</label>
                                <div class="btn-group numbers">
                                    <label class="btn btn-primary" ng-repeat="number in low.numbers" ng-model="number.check" ng-change="number_click()" btn-checkbox>@{{ number.title }}</label>
                                </div>


                                <ul class="list-inline selects">
                                    <li class=" btn btn-sm" ng-repeat="select in low.selects" ng-click="select_click[select.name](low.numbers);number_click()">
                                        @{{ select.title }}
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
        <!--选择结果----->
        <div class="select-result">
            <p>
                您选择了<span id="res-bet">@{{ result.count }}</span>柱，
                最高可赢<span>@{{ (result.max_winnings) | number:4 }}</span>元，
                返回<span>@{{ (result.back_bet_money) | number:4 }}</span>元，
                倍数<input type="text"  ng-model="multiple"  />

                共投注<span id="total_amount" >@{{ (result.sum_bet_money*multiple) | number:4 }}</span>元,

                <button class="btn btn-primary" type="button" id="select_ok" ng-click="result_click()">选好了</button>

            </p>

        </div>

        <!---投注卡------>
        <div class="bet-card">


            <div class="col-xs-9 select-bets"  ng-repeat="bet in bets" >


                <span>@{{ bet.title }}</span>
                <span>@{{ bet.player }}</span>
                <span>@{{ bet.count }}注</span>
                <span ng-model="bet.money">@{{ (bet.money) | number:4}}元</span>
                <button class="btn btn-primary btn-xs" ng-click="remove($index)">删除</button>

            </div>


            <div class="col-xs-3 cumulation" >
                <p>钱包余额：<span>0.0000</span>元</p>

                <p>总投注：<span>@{{ notes }}</span>柱</p>

                <p>总金额：<span>@{{ amount | number:4 }}</span>元</p>


                <!--
                <button type="button" class="btn btn-primary btn-md num-bet">追号投注</button>
                -->
                <button type="button" class="btn btn-primary btn-md " ng-click="confirm_click">确定投注</button>
            </div>
        </div>
    </div>


@endsection

