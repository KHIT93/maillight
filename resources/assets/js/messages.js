
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
        messages: []
    },
    mounted: function() {
    	this.update_messages();
    	setInterval(function(){
    		this.update_messages();
    	}.bind(this), 30000);
    },
    methods: {
    	update_messages() {
    		this.is_loading = true;
    		this.$http.get('/api/messages').then(function(response){
    			if(response.status == 200)
				{
					app.messages = response.data;
				}
				app.is_loading = false;
    		}).catch(function(response){
    			console.log(response);
    			app.is_loading = false;
    		});
    	},
    	get_message_status(message) {
    		let status_arr = [];
	        if(message.isspam || message.ishighspam)
	        {
	            status_arr.push('Spam');
	        }
	        if(message.ismcp || message.ishighmcp)
	        {
	            $status_arr.push('MCP');
	        }
	        if(message.virusinfected)
	        {
	            status_arr.push('Virus');
	        }
	        if(message.nameinfected)
	        {
	            status_arr.push('Bad Content');
	        }
	        if(message.otherinfected)
	        {
	            status_arr.push('Infected');
	        }
	        if(message.spamwhitelisted)
	        {
	            status_arr.push('W/L');
	        }
	        if(message.spamblacklisted)
	        {
	            status_arr.push('B/L');
	        }
	        let result = (status_arr.length) ? status_arr : ['Clean'];
	        return result;
    	},
    	message_status_class(message) {
    		let classes = [];
	        let status_arr = this.get_message_status(message);

	        if(status_arr.indexOf('Spam'))
	        {
	            if(this.ishighspam)
	            {
	                classes.push('highspam');
	                classes.push('is-danger');
	            }
	            else
	            {
	                classes.push('spam');
	                classes.push('is-warning');
	            }
	        }
	        if(status_arr.indexOf('MCP'))
	        {
	            if(this.ishighmcp)
	            {
	                classes.push('highmcp');
	                classes.push('is-danger');
	            }
	            else
	            {
	                classes.push('mcp');
	                classes.push('is-warning');
	            }
	        }
	        if(this.virusinfected)
	        {
	            classes.push('infected');
	            classes.push('is-danger');
	        }
	        if(this.nameinfected)
	        {
	            classes.push('infected');
	            classes.push('is-warning');
	        }
	        if(this.otherinfected)
	        {
	            classes.push('infected');
	            classes.push('is-danger');
	        }
	        if(this.spamwhitelisted)
	        {
	            classes.push('whitelisted');
	            classes.push('is-primary');
	        }
	        if(this.spamblacklisted)
	        {
	            classes.push('blacklisted');
	            classes.push('is-dark');
	        }
	        let result = classes.join(' ');
	        return result;
    	},
    	refresh_notice() {
    		console.log('Refreshed');
    	}
    }
});