/**
 * Created by shellus on 2015-04-28.
 */


/**
 * 翻页实现
 */
$(document).on('keydown',function(event){
    switch (event.keyCode){
        case 39:
            $('[rel="next"]').get(0).click();
            return false;
        case 37:
            $('[rel="prev"]').get(0).click();
            return false;
        /*
         case 38:
         $('body').animate({scrollTop: $('body').scrollTop() - $(window).height()/2}, 300);
         return false;
         case 40:
         $('body').animate({scrollTop: $('body').scrollTop() + $(window).height()/2}, 300);
         return false;
         default:
         */
    }
});

function Config(){
    this.protocol = window.location.protocol;
    this.domain = window.location.hostname;
    this.prefix = '/api/v1';
    this.value = {};
    this.addPrefix = function(prefix){
        this.prefix += prefix;
    };
    this.getBaseUrl = function(){
        return this.protocol + '//' + this.domain + this.prefix;
    };
    this.getUrl = function(url){
        if(url.substr(0,1) != "/"){
            throw "必须以/开头";
        }
        return this.getBaseUrl() + url;
    };
    this.set = function(key,value){
        this.value[key] = value;
    }
    this.get = function(key){
        return this.value[key];
    }
}


var config = new Config();


/**
 * 应用抽象层，脱耦jQuery
 * @constructor
 */
function Sh(){
    this.config = config;

    /**
     * 获取数据（默认json）
     * @param url 如 /post/1
     */
    this.get = function(url,data,callback){
        return $.getJSON(url,data,callback);
    }
}

var sh = new Sh();


if(window.angular){
    app = angular.module('app',['ui.bootstrap']);
    app.value('config',config);
}


