<!----开奖大屏幕------->
<div class="onelottery" id="betone" ng-controller="time">

    <div class="col-md-4">
        <div class="period">正在关注<span>20150319-50</span>期</div>

        <div class="time">

            <strong >@{{ minite }}</strong>
            <strong >:</strong>
            <strong>@{{ second }}</strong>
        </div>
    </div>


    <div class="col-md-7">
        <h4>开奖结果</h4>
        <a href="moreSSC">
            <button type="button" class="btn btn-primary btn-xs details">更多>></button>
        </a>
        <table class="table table-bordered">

            <tr>
                <th>开奖期数</th>
                <th>开奖号码</th>
            </tr>
            <tr>
                <td>20150319052</td>
                <td>9,9,2,7,6</td>
            </tr>
            <tr>
                <td>20150319052</td>
                <td>9,9,2,7,6</td>
            </tr>
            <tr>
                <td>20150319051</td>
                <td>7,6,8,7,8</td>
            </tr>

        </table>
    </div>

</div>