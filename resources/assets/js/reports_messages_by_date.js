
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import Chart from 'chart.js';
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
        report_ready: false,
        statistics: [],
        chart: {
        	labels: [],
        	datasets: []
        },
        report_error: false,
        report_error_message: ''
    },
    mounted: function() {
    	this.get_data();
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
    	get_data() {
    		this.report_ready = false;
    		this.$http.get('/reports/filter/messages_by_date?api_token='+Laravel.api_token.then(function(response){
    			app.statistics = response.data.results;
    			app.chart.labels = response.data.labels;
    			app.generate_chart();
    			app.report_ready = true;
    		}).catch(function(error){
                app.report_error = true;
                app.report_error_message = error.response.data.message;
            });
    	},
    	generate_chart() {
    		let maildata = {
    			label: "Mail",
    			backgroundColor: "green",
    			data: []
    		};
    		let virusdata = {
    			label: "Viruses",
    			backgroundColor: "red",
    			data: []
    		};
    		let spamdata = {
    			label: "Spam",
    			backgroundColor: "yellow",
    			data: []
    		};
    		this.statistics.forEach(function(item, index){
    			maildata.data.push(item.messages);
    			virusdata.data.push(item.virus);
    			spamdata.data.push(item.spam);
    		});
    		this.chart.datasets.push(maildata);
    		this.chart.datasets.push(virusdata);
    		this.chart.datasets.push(spamdata);

    		let chart = new Chart(document.getElementById('mailreport_graph'), {
    			data: this.chart,
    			type: 'bar'
    		});
    	}
    }
});
