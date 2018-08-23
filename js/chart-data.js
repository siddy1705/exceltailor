$(document).ready(function() {

	$.ajax({
		url : "chart_data_ajax.php",
		type : "GET",
		success : function(data){
            
            var obj = {};
            var data = JSON.parse(data);
            data.forEach(element => {
                obj[element] = (obj[element]||0) + 1;
            });
            
            var monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

            var today = new Date();
            var d;
            var month;
            var sixMonths = [];
            var sixMonthsData = [];

            for(var i = 5; i >= 0; i -= 1) {
                d = new Date(today.getFullYear(), today.getMonth() - i, 1);
                month = monthNames[d.getMonth()];
                sixMonths.push(month);
                if(obj[month] != undefined)
                    sixMonthsData.push(obj[month]);
                else
                    sixMonthsData.push(0);

            }
            
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
                        data : sixMonthsData
                    }
                ]
            }

            var chart1 = document.getElementById("line-chart").getContext("2d");
            window.myLine = new Chart(chart1).Line(lineChartData, {
                responsive: true,
                scaleLineColor: "rgba(0,0,0,.2)",
                scaleGridLineColor: "rgba(0,0,0,.05)",
                scaleFontColor: "#c5c7cc"
            });

		},
		error : function(data) {
			console.log(data);
		}
	});

});
