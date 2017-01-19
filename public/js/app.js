/**
 * Created by shellus on 2017/1/2.
 */

var echo = new Echo({
    broadcaster: 'socket.io',
    host: 'shcms.localhost:6001'
});


echo.channel('orders')
    .listen('OrderShipped', function(e) {
        alert(e.str);
    });

if (window.Laravel.userId){
    echo.private('App.User.' + window.Laravel.userId)
        .notification((notification) => {
            alert(notification.message);
        });
}
