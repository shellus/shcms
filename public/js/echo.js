(function (factory) {
    if (typeof define === 'function' && define.amd) {
        // AMD. Register as anonymous module.
        define(factory);
    } else if (typeof exports === 'object') {
        // Node / CommonJS
        module.exports=factory();
    } else {
        // Browser globals.
        window.Echo=factory();
    }
})(function () {
    "use strict";
    var selector;
    var asyncGenerator = function () {
        function AwaitValue(value) {
            this.value = value;
        }

        function AsyncGenerator(gen) {
            var front, back;

            function send(key, arg) {
                return new Promise(function (resolve, reject) {
                    var request = {
                        key: key,
                        arg: arg,
                        resolve: resolve,
                        reject: reject,
                        next: null
                    };

                    if (back) {
                        back = back.next = request;
                    } else {
                        front = back = request;
                        resume(key, arg);
                    }
                });
            }

            function resume(key, arg) {
                try {
                    var result = gen[key](arg);
                    var value = result.value;

                    if (value instanceof AwaitValue) {
                        Promise.resolve(value.value).then(function (arg) {
                            resume("next", arg);
                        }, function (arg) {
                            resume("throw", arg);
                        });
                    } else {
                        settle(result.done ? "return" : "normal", result.value);
                    }
                } catch (err) {
                    settle("throw", err);
                }
            }

            function settle(type, value) {
                switch (type) {
                case "return":
                    front.resolve({
                        value: value,
                        done: true
                    });
                    break;

                case "throw":
                    front.reject(value);
                    break;

                default:
                    front.resolve({
                        value: value,
                        done: false
                    });
                    break;
                }

                front = front.next;

                if (front) {
                    resume(front.key, front.arg);
                } else {
                    back = null;
                }
            }

            this._invoke = send;

            if (typeof gen.return !== "function") {
                this.return = undefined;
            }
        }

        if (typeof Symbol === "function" && Symbol.asyncIterator) {
            AsyncGenerator.prototype[Symbol.asyncIterator] = function () {
                return this;
            };
        }

        AsyncGenerator.prototype.next = function (arg) {
            return this._invoke("next", arg);
        };

        AsyncGenerator.prototype.throw = function (arg) {
            return this._invoke("throw", arg);
        };

        AsyncGenerator.prototype.return = function (arg) {
            return this._invoke("return", arg);
        };

        return {
            wrap: function (fn) {
                return function () {
                    return new AsyncGenerator(fn.apply(this, arguments));
                };
            },
            await: function (value) {
                return new AwaitValue(value);
            }
        };
    }();

    var classCallCheck = function (instance, Constructor) {
        if (!(instance instanceof Constructor)) {
            throw new TypeError("Cannot call a class as a function");
        }
    };

    var createClass = function () {
        function defineProperties(target, props) {
            for (var i = 0; i < props.length; i++) {
                var descriptor = props[i];
                descriptor.enumerable = descriptor.enumerable || false;
                descriptor.configurable = true;
                if ("value" in descriptor) descriptor.writable = true;
                Object.defineProperty(target, descriptor.key, descriptor);
            }
        }

        return function (Constructor, protoProps, staticProps) {
            if (protoProps) defineProperties(Constructor.prototype, protoProps);
            if (staticProps) defineProperties(Constructor, staticProps);
            return Constructor;
        };
    }();

    var _extends = Object.assign || function (target) {
            for (var i = 1; i < arguments.length; i++) {
                var source = arguments[i];

                for (var key in source) {
                    if (Object.prototype.hasOwnProperty.call(source, key)) {
                        target[key] = source[key];
                    }
                }
            }

            return target;
        };

    var inherits = function (subClass, superClass) {
        if (typeof superClass !== "function" && superClass !== null) {
            throw new TypeError("Super expression must either be null or a function, not " + typeof superClass);
        }

        subClass.prototype = Object.create(superClass && superClass.prototype, {
            constructor: {
                value: subClass,
                enumerable: false,
                writable: true,
                configurable: true
            }
        });
        if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass;
    };

    var possibleConstructorReturn = function (self, call) {
        if (!self) {
            throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
        }

        return call && (typeof call === "object" || typeof call === "function") ? call : self;
    };

    var Connector = function () {
        function Connector(options) {
            classCallCheck(this, Connector);

            this._defaultOptions = {
                auth: {
                    headers: {}
                },
                authEndpoint: '/broadcasting/auth',
                broadcaster: 'pusher',
                csrfToken: null,
                host: null,
                key: null,
                namespace: 'App.Events'
            };
            this.setOptions(options);
            this.connect();
        }

        createClass(Connector, [{
            key: 'setOptions',
            value: function setOptions(options) {
                this.options = _extends(this._defaultOptions, options);
                if (this.csrfToken()) {
                    this.options.auth.headers['X-CSRF-TOKEN'] = this.csrfToken();
                }
                return options;
            }
        }, {
            key: 'csrfToken',
            value: function csrfToken() {
                if (window && window['Laravel'] && window['Laravel'].csrfToken) {
                    return window['Laravel'].csrfToken;
                } else if (this.options.csrfToken) {
                    return this.options.csrfToken;
                } else if (document && (selector = document.querySelector('meta[name="csrf-token"]'))) {
                    return selector.getAttribute('content');
                }
                return null;
            }
        }]);
        return Connector;
    }();

    var Channel = function () {
        function Channel() {
            classCallCheck(this, Channel);
        }

        createClass(Channel, [{
            key: 'notification',
            value: function notification(callback) {
                return this.listen('.Illuminate.Notifications.Events.BroadcastNotificationCreated', callback);
            }
        }, {
            key: 'listenForWhisper',
            value: function listenForWhisper(event, callback) {
                return this.listen('.client-' + event, callback);
            }
        }]);
        return Channel;
    }();

    var EventFormatter = function () {
        function EventFormatter(namespace) {
            classCallCheck(this, EventFormatter);

            this.setNamespace(namespace);
        }

        createClass(EventFormatter, [{
            key: 'format',
            value: function format(event) {
                if (this.namespace) {
                    if (event.charAt(0) != '\\' && event.charAt(0) != '.') {
                        event = this.namespace + '.' + event;
                    } else {
                        event = event.substr(1);
                    }
                }
                return event.replace(/\./g, '\\');
            }
        }, {
            key: 'setNamespace',
            value: function setNamespace(value) {
                this.namespace = value;
            }
        }]);
        return EventFormatter;
    }();

    var PusherChannel = function (_Channel) {
        inherits(PusherChannel, _Channel);

        function PusherChannel(pusher, name, options) {
            classCallCheck(this, PusherChannel);

            var _this = possibleConstructorReturn(this, (PusherChannel.__proto__ || Object.getPrototypeOf(PusherChannel)).call(this));

            _this.name = name;
            _this.pusher = pusher;
            _this.options = options;
            _this.eventFormatter = new EventFormatter(_this.options.namespace);
            _this.subscribe();
            return _this;
        }

        createClass(PusherChannel, [{
            key: 'subscribe',
            value: function subscribe() {
                this.subscription = this.pusher.subscribe(this.name);
            }
        }, {
            key: 'unsubscribe',
            value: function unsubscribe() {
                this.pusher.unsubscribe(this.name);
            }
        }, {
            key: 'listen',
            value: function listen(event, callback) {
                this.on(this.eventFormatter.format(event), callback);
                return this;
            }
        }, {
            key: 'on',
            value: function on(event, callback) {
                this.subscription.bind(event, callback);
                return this;
            }
        }]);
        return PusherChannel;
    }(Channel);

    var PusherPrivateChannel = function (_PusherChannel) {
        inherits(PusherPrivateChannel, _PusherChannel);

        function PusherPrivateChannel() {
            classCallCheck(this, PusherPrivateChannel);
            return possibleConstructorReturn(this, (PusherPrivateChannel.__proto__ || Object.getPrototypeOf(PusherPrivateChannel)).apply(this, arguments));
        }

        createClass(PusherPrivateChannel, [{
            key: 'whisper',
            value: function whisper(eventName, data) {
                this.pusher.channels.channels[this.name].trigger('client-' + eventName, data);
                return this;
            }
        }]);
        return PusherPrivateChannel;
    }(PusherChannel);

    var PusherPresenceChannel = function (_PusherChannel) {
        inherits(PusherPresenceChannel, _PusherChannel);

        function PusherPresenceChannel() {
            classCallCheck(this, PusherPresenceChannel);
            return possibleConstructorReturn(this, (PusherPresenceChannel.__proto__ || Object.getPrototypeOf(PusherPresenceChannel)).apply(this, arguments));
        }

        createClass(PusherPresenceChannel, [{
            key: 'here',
            value: function here(callback) {
                this.on('pusher:subscription_succeeded', function (data) {
                    callback(Object.keys(data.members).map(function (k) {
                        return data.members[k];
                    }));
                });
                return this;
            }
        }, {
            key: 'joining',
            value: function joining(callback) {
                this.on('pusher:member_added', function (member) {
                    callback(member.info);
                });
                return this;
            }
        }, {
            key: 'leaving',
            value: function leaving(callback) {
                this.on('pusher:member_removed', function (member) {
                    callback(member.info);
                });
                return this;
            }
        }, {
            key: 'whisper',
            value: function whisper(eventName, data) {
                this.pusher.channels.channels[this.name].trigger('client-' + eventName, data);
                return this;
            }
        }]);
        return PusherPresenceChannel;
    }(PusherChannel);

    var SocketIoChannel = function (_Channel) {
        inherits(SocketIoChannel, _Channel);

        function SocketIoChannel(socket, name, options) {
            classCallCheck(this, SocketIoChannel);

            var _this = possibleConstructorReturn(this, (SocketIoChannel.__proto__ || Object.getPrototypeOf(SocketIoChannel)).call(this));

            _this.events = {};
            _this.name = name;
            _this.socket = socket;
            _this.options = options;
            _this.eventFormatter = new EventFormatter(_this.options.namespace);
            _this.subscribe();
            _this.configureReconnector();
            return _this;
        }

        createClass(SocketIoChannel, [{
            key: 'subscribe',
            value: function subscribe() {
                this.socket.emit('subscribe', {
                    channel: this.name,
                    auth: this.options.auth || {}
                });
            }
        }, {
            key: 'unsubscribe',
            value: function unsubscribe() {
                this.unbind();
                this.socket.emit('unsubscribe', {
                    channel: this.name,
                    auth: this.options.auth || {}
                });
            }
        }, {
            key: 'listen',
            value: function listen(event, callback) {
                this.on(this.eventFormatter.format(event), callback);
                return this;
            }
        }, {
            key: 'on',
            value: function on(event, callback) {
                var _this2 = this;

                var listener = function listener(channel, data) {
                    if (_this2.name == channel) {
                        callback(data);
                    }
                };
                this.socket.on(event, listener);
                this.bind(event, listener);
            }
        }, {
            key: 'configureReconnector',
            value: function configureReconnector() {
                var _this3 = this;

                var listener = function listener() {
                    _this3.subscribe();
                };
                this.socket.on('reconnect', listener);
                this.bind('reconnect', listener);
            }
        }, {
            key: 'bind',
            value: function bind(event, callback) {
                this.events[event] = this.events[event] || [];
                this.events[event].push(callback);
            }
        }, {
            key: 'unbind',
            value: function unbind() {
                var _this4 = this;

                Object.keys(this.events).forEach(function (event) {
                    _this4.events[event].forEach(function (callback) {
                        _this4.socket.removeListener(event, callback);
                    });
                    delete _this4.events[event];
                });
            }
        }]);
        return SocketIoChannel;
    }(Channel);

    var SocketIoPrivateChannel = function (_SocketIoChannel) {
        inherits(SocketIoPrivateChannel, _SocketIoChannel);

        function SocketIoPrivateChannel() {
            classCallCheck(this, SocketIoPrivateChannel);
            return possibleConstructorReturn(this, (SocketIoPrivateChannel.__proto__ || Object.getPrototypeOf(SocketIoPrivateChannel)).apply(this, arguments));
        }

        createClass(SocketIoPrivateChannel, [{
            key: 'whisper',
            value: function whisper(eventName, data) {
                this.socket.emit('client event', {
                    channel: this.name,
                    event: 'client-' + eventName,
                    data: data
                });
                return this;
            }
        }]);
        return SocketIoPrivateChannel;
    }(SocketIoChannel);

    var SocketIoPresenceChannel = function (_SocketIoPrivateChann) {
        inherits(SocketIoPresenceChannel, _SocketIoPrivateChann);

        function SocketIoPresenceChannel() {
            classCallCheck(this, SocketIoPresenceChannel);
            return possibleConstructorReturn(this, (SocketIoPresenceChannel.__proto__ || Object.getPrototypeOf(SocketIoPresenceChannel)).apply(this, arguments));
        }

        createClass(SocketIoPresenceChannel, [{
            key: 'here',
            value: function here(callback) {
                this.on('presence:subscribed', function (members) {
                    callback(members.map(function (m) {
                        return m.user_info;
                    }));
                });
                return this;
            }
        }, {
            key: 'joining',
            value: function joining(callback) {
                this.on('presence:joining', function (member) {
                    return callback(member.user_info);
                });
                return this;
            }
        }, {
            key: 'leaving',
            value: function leaving(callback) {
                this.on('presence:leaving', function (member) {
                    return callback(member.user_info);
                });
                return this;
            }
        }]);
        return SocketIoPresenceChannel;
    }(SocketIoPrivateChannel);

    var PusherConnector = function (_Connector) {
        inherits(PusherConnector, _Connector);

        function PusherConnector() {
            var _ref;

            classCallCheck(this, PusherConnector);

            for (var _len = arguments.length, args = Array(_len), _key = 0; _key < _len; _key++) {
                args[_key] = arguments[_key];
            }

            var _this = possibleConstructorReturn(this, (_ref = PusherConnector.__proto__ || Object.getPrototypeOf(PusherConnector)).call.apply(_ref, [this].concat(args)));

            _this.channels = {};
            return _this;
        }

        createClass(PusherConnector, [{
            key: 'connect',
            value: function connect() {
                this.pusher = new Pusher(this.options.key, this.options);
            }
        }, {
            key: 'listen',
            value: function listen(name, event, callback) {
                return this.channel(name).listen(event, callback);
            }
        }, {
            key: 'channel',
            value: function channel(name) {
                if (!this.channels[name]) {
                    this.channels[name] = new PusherChannel(this.pusher, name, this.options);
                }
                return this.channels[name];
            }
        }, {
            key: 'privateChannel',
            value: function privateChannel(name) {
                if (!this.channels['private-' + name]) {
                    this.channels['private-' + name] = new PusherPrivateChannel(this.pusher, 'private-' + name, this.options);
                }
                return this.channels['private-' + name];
            }
        }, {
            key: 'presenceChannel',
            value: function presenceChannel(name) {
                if (!this.channels['presence-' + name]) {
                    this.channels['presence-' + name] = new PusherPresenceChannel(this.pusher, 'presence-' + name, this.options);
                }
                return this.channels['presence-' + name];
            }
        }, {
            key: 'leave',
            value: function leave(name) {
                var _this2 = this;

                var channels = [name, 'private-' + name, 'presence-' + name];
                channels.forEach(function (name, index) {
                    if (_this2.channels[name]) {
                        _this2.channels[name].unsubscribe();
                        delete _this2.channels[name];
                    }
                });
            }
        }, {
            key: 'socketId',
            value: function socketId() {
                return this.pusher.connection.socket_id;
            }
        }]);
        return PusherConnector;
    }(Connector);

    var SocketIoConnector = function (_Connector) {
        inherits(SocketIoConnector, _Connector);

        function SocketIoConnector() {
            var _ref;

            classCallCheck(this, SocketIoConnector);

            for (var _len = arguments.length, args = Array(_len), _key = 0; _key < _len; _key++) {
                args[_key] = arguments[_key];
            }

            var _this = possibleConstructorReturn(this, (_ref = SocketIoConnector.__proto__ || Object.getPrototypeOf(SocketIoConnector)).call.apply(_ref, [this].concat(args)));

            _this.channels = {};
            return _this;
        }

        createClass(SocketIoConnector, [{
            key: 'connect',
            value: function connect() {
                this.socket = io(this.options.host, this.options);
                return this.socket;
            }
        }, {
            key: 'listen',
            value: function listen(name, event, callback) {
                return this.channel(name).listen(event, callback);
            }
        }, {
            key: 'channel',
            value: function channel(name) {
                if (!this.channels[name]) {
                    this.channels[name] = new SocketIoChannel(this.socket, name, this.options);
                }
                return this.channels[name];
            }
        }, {
            key: 'privateChannel',
            value: function privateChannel(name) {
                if (!this.channels['private-' + name]) {
                    this.channels['private-' + name] = new SocketIoPrivateChannel(this.socket, 'private-' + name, this.options);
                }
                return this.channels['private-' + name];
            }
        }, {
            key: 'presenceChannel',
            value: function presenceChannel(name) {
                if (!this.channels['presence-' + name]) {
                    this.channels['presence-' + name] = new SocketIoPresenceChannel(this.socket, 'presence-' + name, this.options);
                }
                return this.channels['presence-' + name];
            }
        }, {
            key: 'leave',
            value: function leave(name) {
                var _this2 = this;

                var channels = [name, 'private-' + name, 'presence-' + name];
                channels.forEach(function (name) {
                    if (_this2.channels[name]) {
                        _this2.channels[name].unsubscribe();
                        delete _this2.channels[name];
                    }
                });
            }
        }, {
            key: 'socketId',
            value: function socketId() {
                return this.socket.id;
            }
        }]);
        return SocketIoConnector;
    }(Connector);

    var Echo = function () {
        function Echo(options) {
            classCallCheck(this, Echo);

            this.options = options;
            if (typeof Vue === 'function' && Vue.http) {
                this.registerVueRequestInterceptor();
            }
            if (typeof axios === 'function') {
                this.registerAxiosRequestInterceptor();
            }
            if (typeof jQuery === 'function') {
                this.registerjQueryAjaxSetup();
            }
            if (this.options.broadcaster == 'pusher') {
                if (!window['Pusher']) {
                    window['Pusher'] = require('pusher-js');
                }
                this.connector = new PusherConnector(this.options);
            } else if (this.options.broadcaster == 'socket.io') {
                this.connector = new SocketIoConnector(this.options);
            }
        }

        createClass(Echo, [{
            key: 'registerVueRequestInterceptor',
            value: function registerVueRequestInterceptor() {
                var _this = this;

                Vue.http.interceptors.push(function (request, next) {
                    if (_this.socketId()) {
                        request.headers.set('X-Socket-ID', _this.socketId());
                    }
                    next();
                });
            }
        }, {
            key: 'registerAxiosRequestInterceptor',
            value: function registerAxiosRequestInterceptor() {
                var _this2 = this;

                axios.interceptors.request.use(function (config) {
                    if (_this2.socketId()) {
                        config.headers['X-Socket-Id'] = _this2.socketId();
                    }
                    return config;
                });
            }
        }, {
            key: 'registerjQueryAjaxSetup',
            value: function registerjQueryAjaxSetup() {
                var _this3 = this;

                jQuery.ajaxSetup({
                    beforeSend: function beforeSend(xhr) {
                        xhr.setRequestHeader('X-Socket-Id', _this3.socketId());
                    }
                });
            }
        }, {
            key: 'listen',
            value: function listen(channel, event, callback) {
                return this.connector.listen(channel, event, callback);
            }
        }, {
            key: 'channel',
            value: function channel(_channel) {
                return this.connector.channel(_channel);
            }
        }, {
            key: 'private',
            value: function _private(channel) {
                return this.connector.privateChannel(channel);
            }
        }, {
            key: 'join',
            value: function join(channel) {
                return this.connector.presenceChannel(channel);
            }
        }, {
            key: 'leave',
            value: function leave(channel) {
                this.connector.leave(channel);
            }
        }, {
            key: 'socketId',
            value: function socketId() {
                return this.connector.socketId();
            }
        }]);
        return Echo;
    }();

    return Echo;
});