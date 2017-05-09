
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
        sa_options: [
            {value: 'ham', text: 'The message is clean'},
            {value: 'spam', text: 'The message is spam'},
            {value: 'report', text: 'Report and mark as spam'},
            {value: 'revoke', text: 'Report as clean and release'},
        ],
        sa_action: null
    },
    methods: {
        sa_release(message_uuid) {
            /*this.$http.post('/api/sa/release?api_token='+Laravel.api_token, { message_uuid }).then(function(response){
                console.log(response);
            }).catch(function(error){
                console.log(error.response);
            });*/
            console.log('recieved '+message_uuid);
        },
        sa_remove(message_uuid) {
            console.log('recieved '+message_uuid);
        },
        sa_learn(message_uuid) {
            //Use sa_action to send with request for sa-learn
            console.log('recieved '+message_uuid);
        }
    }
});
