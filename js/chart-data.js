var monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

var today = new Date();
var d;
var month;
var sixMonths = [];

for(var i = 5; i >= 0; i -= 1) {
	d = new Date(today.getFullYear(), today.getMonth() - i, 1);
	month = monthNames[d.getMonth()];
	sixMonths.push(month);
}

var randomScalingFactor = function(){ return Math.round(Math.random()*10)};

var lineChartData = {
	labels : sixMonths,
	datasets : [
		{
			label: "My First dataset",
			fillColor : "rgba(220,220,220,0.2)",
			strokeColor : "rgba(220,220,220,1)",
			pointColor : "rgba(220,220,220,1)",
			pointStrokeColor : "#fff",
			pointHighlightFill : "#fff",
			pointHighlightStroke : "rgba(220,220,220,1)",
			data : [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]
		}
	]
}

		


