
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
        email: '',
        reset_token: '',
        password: '',
        password_confirmation: '',
        show_dialog: true,
        error: null,
        status: null,
    },
    mounted()
    {
        this.reset_token = window.location.pathname.split('/password/reset/')[1];
    },
    methods: {
        send_link() {
            this.$http.post('/password/email', { email: this.email }).then(function(response){
                console.log(response);
                app.status = response.data.status;
                app.loading = false;
            })
            .catch(function(error){
                app.error = error.response.data.email;
                app.loading = false;
                console.log(error.response);
            });
        },
        reset_password() {
            this.$http.post('/password/reset', { email: this.email, password: this.password, password_confirmation: this.password_confirmation, token: this.reset_token }).then(function(response){
                console.log(response);
                app.status = "Your password has been reset. You are now being logged in";
                app.loading = false;
                app.get_redirect(response.data);
            })
            .catch(function(error){
                app.error = error.response.data;
                app.loading = false;
                console.log(error.response);
            });
        },
        get_redirect(userdata) {
            this.$http.post('/api/password-reset/redirect?api_token='+userdata.api_token).then(function(response){
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
