
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the body of the page. From here, you may begin adding components to
 * the application, or feel free to tweak this setup for your needs.
 */

const app = new Vue({
    el: '#app',
    data: {
        is_loading: false,
        js_enabled: true,
    },
    methods: {
        update_geoip() {
            this.$http.post('/api/tools/update-geoip').then(function(response){
                console.log(response);
            }).catch(function(response){
                console.log(response);
            });
        },
    }
});