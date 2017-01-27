
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
        filter_options: [],
        active_filters: [],
        statistics: {
            new: '',
            old: '',
            count: 0
        },
        new_filter: {
        	field: '',
        	operator: '=',
        	value: ''
        }
    },
    mounted: function() {
        this.reload_filters();
    },
    methods: {
    	get_filtered_data() {
            this.is_loading = true;
    		this.$http.get('/reports/filter').then(function(response){
                app.statistics.new = new Date(response.data.new).toLocaleDateString('da-DK');
                app.statistics.old = new Date(response.data.old).toLocaleDateString('da-DK');
                app.statistics.count = response.data.count.toLocaleString('da-DK');
                app.is_loading = false;
    		}).catch(function(response){
                console.log(response);
            });
    	},
        reload_filters() {
            this.get_filtered_data();
            this.get_filter_options();
        },
    	apply_filter() {
            this.is_loading = true;
            let data = {};
            data['reports_filter_domain'] = this.new_filter;
            console.log(data);
    		this.$http.post('/reports/filter', data).then(function(response){
    			console.log(response);
                app.is_loading = false;
                app.reload_filters();
    		});
    	},
    	remove_filter(filter) {
            this.is_loading = true;
    		this.$http.delete('/reports/filter/'+filter.field).then(function(response){
                console.log(response);
                app.is_loading = false;
                app.reload_filters();
    		});
    	},
        get_filter_options() {
            this.is_loading = true;
            this.$http.get('/reports/filter/options').then(function(response){
                app.filter_options = response.data.filter_options;
                app.active_filters = response.data.active_filters;
                app.is_loading = false;
            }).catch(function(response){
                console.log(response);
            });
        }
    }
});
