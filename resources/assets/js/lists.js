
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the body of the page. From here, you may begin adding components to
 * the application, or feel free to tweak this setup for your needs.
 */


const app = new Vue({
    el: '#app',
    data: {
    	whitelist: {
    		search_key: ''
    	},
    	blacklist: {
    		search_key: ''
    	},
    	search_key: '',
    	show_entry_modal: false,
    	entry: {
    		from_address: '',
    		to_address: '',
    		to_domain: '',
    		list: ''
    	}
    },
    methods:
    {
    	search_blacklist() {
    		this.search_key = this.blacklist.search_key;
    		this.search_list('blacklist');
    	},
    	search_whitelist() {
    		this.search_key = this.whitelist.search_key;
    		this.search_list('whitelist');
    	},
    	search_list(list) {
    		this.$http.post('/api/'+list+'/search', {
    			query_key: this.search_key
    		}).then(function(response){
    			console.log(response);
    		})
    	},
    	delete_entry(list, uuid) {
    		this.$http.delete('/api/'+list+'/destroy/'+uuid).then(function(response){
    			console.log(response);
    		});
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
    	},
    	submit_entry() {
    		let list = '';
    		if(entry.list == 'blacklist' || entry.list == 'whitelist')
    		{
    			list = entry.list;
    		}
    		if(list != '')
    		{
    			this.$http.post('/api'+list+'/create', this.entry).then(function(response){
    				console.log(response);
    			});
    		}
    		this.toggle_modal();
    	}
    }
});
