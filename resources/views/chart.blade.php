<!DOCTYPE html>
<html>
<head>
	<title>Temper test app</title>

	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://unpkg.com/vue"></script>
	<script src="https://code.highcharts.com/highcharts.js"></script>
	<script src="https://code.highcharts.com/modules/exporting.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/1.2.0/vue-resource.js"></script>

</head>
<body>

<div class="container" id="app">
	<div class="row">
		<div id="container" ></div>
	</div>
</div>

</body>
<script type="text/javascript">
	Vue.use(VueResource);

  	var app = new Vue({
		el: '#app',
		data: {},
		methods: {
			hadleError : function (){
				alert("Something went wrong in the server \n**Since Laravel uses blade as the template engine cant use vuejs two way data binding to display the error message**");
			},
		    fetchData: function () { 
		    	this.$http.get('/statistics',{
		    		headers: {
				        'Authorization': 'dXNlcjpwYXNzd29yZA'
				    }}).then(function(response){
		    		var CordinateList = [];

		           	$.each(response.body.data, function(key,value) {
		           		var cordinates = [];

			           	$.each(value, function(key,value){
			           		cordinates.push([parseInt(key), value]);
			           	})

			          	var cordinateObeject = {
							name : key,
							data : cordinates
						}
						console.log()
						CordinateList.push(cordinateObeject);
					});
		          
		
					Highcharts.chart('container', {
					    chart: {
					        type: 'spline',
					        inverted: false
					    },
					    title: {
					        text: 'Temper test app'
					    },
					    xAxis: {
					        reversed: false,
					        title: {
					            enabled: true,
					            text: ' Step in the onboarding'
					        },
					   
					        showLastLabel: true
					    },
					    yAxis: {
					        title: {
					            text: 'Percentage of users'
					        }
					    },
					    legend: {
					        enabled: true
					    },
					    plotOptions: {
					        spline: {
					            marker: {
					                enable: false
					            }
					        }
					    },
					    series: CordinateList
					});
		        }, function(response){
		            this.hadleError();
		        });
		    }
		}
	})

	app.fetchData();

</script>
</html>
