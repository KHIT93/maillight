
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
        operators: [
            {text: "is equal to", value: "="},
            {text: "is not equal to", value: "<>"},
            {text: "is greater than", value: ">"},
            {text: "is greater than or equal to", value: ">="},
            {text: "is less than", value: "<"},
            {text: "is less than or equal to", value: "<="},
            {text: "contains", value: "LIKE"},
            {text: "does not contain", value: "NOT LIKE"},
            {text: "is empty", value: "IS NULL"},
            {text: "Is not empty", value: "IS NOT NULL"},
        ],
        statistics: {
            new: '',
            old: '',
            count: 0
        },
        new_filter: {
        	field: null,
        	operator: null,
        	value: ''
        }
    },
    mounted: function() {
        this.reload_filters();
    },
    methods: {
        user() {
            this.$http.get('/user').then(function(response){
                if(response.data == "")
                {
                    return null;
                }
                return response.data.api_token;
            }).catch(function(error){
                console.log(error.response);
                return null;
            });
        },
    	get_filtered_data() {
            this.is_loading = true;
    		this.$http.get('/reports/filter?api_token='+Laravel.api_token).then(function(response){
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
            data['reports_filter_domain'] = {
                field: this.new_filter.field.value,
                operator: this.new_filter.operator.value,
                value: this.new_filter.value
            };
            console.log(data);
    		this.$http.post('/reports/filter?api_token='+Laravel.api_token, data).then(function(response){
    			console.log(response);
                app.is_loading = false;
                app.reload_filters();
    		});
    	},
    	remove_filter(filter) {
            this.is_loading = true;
    		this.$http.delete('/reports/filter/'+filter.field+'?api_token='+Laravel.api_token).then(function(response){
                console.log(response);
                app.is_loading = false;
                app.reload_filters();
    		});
    	},
        get_filter_options() {
            this.is_loading = true;
            this.$http.get('/reports/filter/options?api_token='+Laravel.api_token).then(function(response){
                app.filter_options = response.data.filter_options;
                app.active_filters = response.data.active_filters;
                app.is_loading = false;
            }).catch(function(response){
                console.log(response);
            });
        }
    }
});
