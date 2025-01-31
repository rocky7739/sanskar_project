"use strict";



// Optional. You will see this name in eg. 'ps' or 'top' command

process.title = 'Socket Live';



var host = "localhost";

var socketPort = 1337;

// Port where we'll run the websocket server

var app = require('express')();

var http = require('http').Server(app);

var io = require('socket.io')(http);

var apn = require('apn');



http.listen(socketPort, function () {

    console.log('socket listening on ' + socketPort);

});



var QueryBuilder = require('node-querybuilder');

var FCM = require('fcm-node');

var settings = {

    host: 'localhost',

    database: 'appsansk_tbhakti',

    user: 'appsansk_tbhakti',

    password: 'FcCHlwYgmlFz'

};

const sql = new QueryBuilder(settings, 'mysql', 'single');

var async = require('async');



/*
 
 * This callback function is called every time someone
 
 * tries to connect to the Socket.IO server
 
 */

io.on('connection', function (socket) {

    // notification management

    socket.on('notification', function (message) {

        var android_tokens = [],
                ios_tokens = [],
                user_ids = [];



        var select_where = {'status': '0', 'device_token !=': '', 'notification_status': '0'};

        //   var select_where = {'status': '0', 'device_token !=': ''};

        //var select_where = {'status': '0', 'device_token !=': '','mobile':'7985030495'};

        if (message.device_type != undefined && message.device_type != "")
            select_where.device_type = message.device_type;



        // var message_target = "open";

        var message_target = message.notification_type;

        var emit = {};

        async.waterfall([

            function fetching_users(callback) {

                socket.emit('notification', JSON.stringify({message: "Fetching Users From Database"}));

                sql.select('id,device_type,device_token')

                        .where(select_where)

                        .get('users', function (err, response) {

                            if (err)
                                console.log(err);

                            response.forEach(function (value, index) {

                                user_ids.push(value.id);

                                if (value.device_type == 1)
                                    android_tokens.push(value.device_token);

                                else if (value.device_type == 2)
                                    ios_tokens.push(value.device_token);

                            });

                            if (response.length == 0) {

                                socket.emit('notification', JSON.stringify({message: "No User Found"}));

                                return false;

                            } else {

                                socket.emit('notification', JSON.stringify({message: "Total Users Found: " + response.length}));

                            }

                            callback(null, emit);

                        });

            },

            function notificaion_sender(emit, callback) {

                var i, max = 0, total_users = android_tokens.length;

                while (total_users > 0) {

                    ++max;

                    total_users -= 999;

                }

                var sent_count = 0, failed_count = 0;



                //android payload with config

                var serverKey = 'AAAABEMu0p8:APA91bFG3mHlk2ZiqOI7eLhACwQN8iNrmuvZFM2_cQDaiEKbbOyD68yBatCQ7A6OQ3GibGNbPX21YLQl5V9PpOOQhjLWhi8ICkd1fX0UgTuXE_9lTW5mc_oGBLJlY24ZihUEsDNjrcwL'; //put your server key here

                var fcm = new FCM(serverKey);

                let payload = {//this may vary according to the message type (single recipient, multicast, topic, et cetera)

                    data: {//you can send only notification or only data(or include both)

                        message: {

                            message: message.users_message,

                            data: {

                                message_target: message_target

                            }

                        },

                        image_url: message.notification_text,

                        "mutable-content": 1,

                        "notification_type": message.post_type,

                        type: 0

                    }

                };



                for (i = 0; i < max; i++) {

                    let limit = ((i * 999) + 999);

                    limit = (android_tokens.length >= limit) ? limit : android_tokens.length;



                    payload.registration_ids = android_tokens.slice(i * 999, limit);

                    fcm.send(payload, function (err, response) {

                        if (err) {

                            console.log(err);

                            socket.emit('notification', JSON.stringify({message: err}));

                        } else {

                            response = JSON.parse(response);

                            sent_count += response.success;

                            failed_count += response.failure;

                            console.log("Successfully sent with response: ", response);

                            socket.emit('notification', JSON.stringify({message: "Notification sent to " + sent_count + " users out of " + emit.total_users + " users"}));

                            socket.emit('notification', JSON.stringify({message: response}));

                        }

                    });

                }



                if (ios_tokens.length != 0) {

                    let options = {

                        token: {

                            key: "./AuthKey_3J33835A2M.p8",

                            keyId: "3J33835A2M",

                            teamId: "7BMX4SN26T"

                        },

                        production: false

                    };



                    // Prepare the notifications

                    let notification = new apn.Notification();



                    // Replace this with your app bundle ID:

                    notification.topic = "com.sanskargroup.sanskarTV";

                    notification.aps = {

                        alert: {

                            "title": message.post_type,

                            "subtitle": message.users_message,

                            body: "",

                            'action-loc-key': "SANSKAR"

                        },

                        json: {

                            message: message.users_message,

                            type: message.post_type,

                            data: {

                                message_target: message_target

                            }

                        },

                        image_url: message.notification_text,

                        "mutable-content": 1,

                        sound: 'oven.caf',

                        badge: 1,

                    };



                    let apnProvider = new apn.Provider(options);

                    ios_tokens.forEach(function (deviceToken, index) {

                        apnProvider.send(notification, deviceToken).then(function (response) {

                            // Show the result of the send operation:

                            ++sent_count;

//                            console.log(response);

                        });

                    });

                    // Close the server

                    apnProvider.shutdown();

                }



                callback(null, emit);

            }

        ], function (error, success) {

            if (error) {

                console.log('Something is wrong!');

            }

            var today = new Date();

            let notification_history = {

                user_id: 0,

                user_type: message.users_type,

                post_type: message.post_type,

                post_id: message.post_id,

                text: message.users_message,

                device_type: (message.device_type != undefined) ? message.device_type : "",

                notification_type: message_target,

                sent_by: message.admin_id,

                notification_thumbnail: message.notification_text,

                created_on: today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate(),

                created_at: today.getTime()

            }

            sql.insert('push_notification_history', notification_history);

            console.log("success");

            socket.emit('task_done', JSON.stringify({message: "Notification Successfully Deployed ", 'user_ids': user_ids}));

        });

    });



    // user disconnected

    socket.on('disconnect', function () {

        console.log("Disconnected User");

    });

});