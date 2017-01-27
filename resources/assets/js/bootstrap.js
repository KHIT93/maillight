
//import lodash from 'lodash';
//window._ = lodash;

/**
 * Vue is a modern JavaScript library for building interactive web interfaces
 * using reactive data binding and reusable components. Vue's API is clean
 * and simple, leaving you to focus on building your next great project.
 */
import Vue from 'vue';
import axios from 'axios';
import VueSelect from 'vue-select';
window.Vue = Vue;
Vue.component('v-select', VueSelect.VueSelect);
/**
 * We'll register a HTTP interceptor to attach the "CSRF" header to each of
 * the outgoing requests issued by this application. The CSRF middleware
 * included with Laravel will automatically verify the header's value.
 */
axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest'
};

Vue.prototype.$http = axios;
/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from "laravel-echo"

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: 'your-pusher-key'
// });
