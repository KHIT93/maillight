
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
        loading: false,
        js_enabled: true,
        loader: '',

        user: {
            email: '',
            password: ''
        },
        show_dialog: true,
        error: null
    },
    methods: {
        login() {
            this.$http.post('/login', this.user).then(function(response){
                console.log(response);
                app.get_redirect(response.data);
            })
            .catch(function(error){
                app.error = error.response.data;
                app.loading = false;
                console.log(error.response);
            });
        },
        get_redirect(userdata) {
            this.$http.post('/api/login/redirect?api_token='+userdata.api_token).then(function(response){
                console.log(response.data);
                window.location.href = response.data.path;
            })
            .catch(function(error){
                console.log(error.response);
                app.loading = false;
            });
        }
    }
});
