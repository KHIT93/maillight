
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
    	whitelist: {
    		search_key: '',
            entries: []
    	},
    	blacklist: {
    		search_key: '',
            entries: []
    	},
    	search_key: '',
    	show_entry_modal: false,
    	entry: {
    		from_address: '',
    		to_address: '',
    		list: ''
    	},
        list_types: [
            { text: "Blacklist", value: "blacklist"},
            { text: "Whitelist", value: "whitelist"},
        ],
        headers: [
            {value: 'From'},
            {value: 'To'},
            {value: 'Task'}
        ],
        is_loading: true,
        js_enabled: true
    },
    mounted: function() {
        this.init_lists();
        this.is_loading = false;
    },
    methods: {
        init_lists() {
            this.refresh_whitelist();
            this.refresh_blacklist();
        },
        refresh_blacklist() {
            this.$http.post('/api/blacklist/search?api_token='+Laravel.api_token).then(function(response){
                if (response.status == 200)
                {
                    app.blacklist.entries = response.data;
                }
            }).catch(function(error){
                console.log(error.response);
            });
        },
        refresh_whitelist() {
            this.$http.post('/api/whitelist/search?api_token='+Laravel.api_token).then(function(response){
                if (response.status == 200)
                {
                    app.whitelist.entries = response.data;
                }
            }).catch(function(error){
                console.log(error.response);
            });
        },
    	search_blacklist() {
    		this.search_key = this.blacklist.search_key;
    		this.search_list('blacklist');
    	},
    	search_whitelist() {
    		this.search_key = this.whitelist.search_key;
    		this.search_list('whitelist');
    	},
    	search_list(list) {
            this.is_loading = true;
    		this.$http.post('/api/'+list+'/search?api_token='+Laravel.api_token, {
    			query_key: this.search_key
    		}).then(function(response){
    			if (response.status == 200)
                {
                    app[list].entries = response.data;
                }
    		}).catch(function(error){
                console.log(error.response);
            });
            this.is_loading = false;
    	},
    	delete_entry(list, uuid) {
            this.is_loading = true;
    		this.$http.delete('/api/'+list+'/destroy/'+uuid+'?api_token='+Laravel.api_token).then(function(response){
    			console.log(response);
    		});
            this.init_lists();
            this.is_loading = false;
    	},
    	show_modal() {
    		if(this.show_entry_modal)
    		{
    			return 'is_active';
    		}
    		else
    		{
    			return '';
    		}
    	},
    	toggle_modal() {
    		if(this.show_entry_modal)
    		{
    			this.show_entry_modal = false;
    			this.reset_entry();
    		}
    		else
    		{
    			this.show_entry_modal = true;
    		}
    	},
    	reset_entry() {
    		this.entry.from_address = '';
    		this.entry.to_address = '';
    		this.entry.to_domain = '';
            this.entry.list = '';
    	},
    	submit_entry() {
    		let list = '';
    		if(this.entry.list.value == 'blacklist' || this.entry.list.value == 'whitelist')
    		{
    			list = this.entry.list.value;
    		}
    		if(list != '')
    		{
    			this.$http.put('/api/'+list+'/create?api_token='+Laravel.api_token, this.entry).then(function(response){
    				console.log(response);
                    if(list == 'blacklist') { app.refresh_blacklist(); }
                    if(list == 'whiteist') { app.refresh_whitelist(); }
                    app.toggle_modal();
    			}).catch(function(error){
                    console.log(error.response);
                    if(list == 'blacklist') { app.refresh_blacklist(); }
                    if(list == 'whiteist') { app.refresh_whitelist(); }
                    app.toggle_modal();
                });
    		}
    	}
    }
});
