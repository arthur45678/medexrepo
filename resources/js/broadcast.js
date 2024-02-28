import Echo from "laravel-echo";
window.io = require("socket.io-client");

window.Echo = new Echo({
    broadcaster: "socket.io",
    host: process.env.MIX_APP_URL + ":6001" // this is laravel-echo-server host
});

// void (function() {
//     const { id = false } = window.Laravel.user.id;

//     Echo.private(`App.User.${id}`).listen("ReferralReceivedEvent", e => {
//         try {

//         } catch (e) {

//         }
//     });
// })();
