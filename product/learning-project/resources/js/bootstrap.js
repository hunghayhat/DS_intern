import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import Echo from "laravel-echo";
import Pusher from "pusher-js";
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: "pusher",
    key: process.env.MIX_PUSHER_APP_KEY || '017e5baf7ec4223db9d0', // Sử dụng giá trị mặc định hoặc từ biến môi trường
    cluster: process.env.MIX_PUSHER_APP_CLUSTER || 'ap3', // Sử dụng giá trị mặc định hoặc từ biến môi trường
    wsHost: process.env.MIX_PUSHER_HOST || 'ws-pusher.pusher.com', // Sử dụng giá trị mặc định hoặc từ biến môi trường
    wsPort: process.env.MIX_PUSHER_PORT || 80, // Sử dụng giá trị mặc định hoặc từ biến môi trường
    wssPort: process.env.MIX_PUSHER_PORT || 443, // Sử dụng giá trị mặc định hoặc từ biến môi trường
    forceTLS: (process.env.MIX_PUSHER_SCHEME || 'https') === 'https', // Sử dụng giá trị mặc định hoặc từ biến môi trường
    enabledTransports: ["ws", "wss"],
});
