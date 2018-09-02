$('#calendar').datepicker({
		});

!function ($) {
    $(document).on("click","ul.nav li.parent > a ", function(){          
        $(this).find('em').toggleClass("fa-minus");      
    }); 
    $(".sidebar span.icon").find('em:first').addClass("fa-plus");
}

(window.jQuery);
	$(window).on('resize', function () {
  if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
})
$(window).on('resize', function () {
  if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
})

$(document).on('click', '.panel-heading span.clickable', function(e){
    var $this = $(this);
	if(!$this.hasClass('panel-collapsed')) {
		$this.parents('.panel').find('.panel-body').slideUp();
		$this.addClass('panel-collapsed');
		$this.find('em').removeClass('fa-toggle-up').addClass('fa-toggle-down');
	} else {
		$this.parents('.panel').find('.panel-body').slideDown();
		$this.removeClass('panel-collapsed');
		$this.find('em').removeClass('fa-toggle-down').addClass('fa-toggle-up');
	}
})

$('#orders-bar-graph-close').click(function(e){
	$('#orders-bar-graph').slideUp();
})


$('.dashboard-stats').click(function(e){
	e.preventDefault();
	$('#orders-bar-graph').slideDown();

	$('#bar-chart').remove();
	$('#orders-details-barchart').append('<canvas class="main-chart" id="bar-chart" height="200" width="600"></canvas>');

	var toggleId = $(this).attr('id');
	var status = "All";

	$('#order-graph-heading').empty();

	if(toggleId == "completed"){
		status = "Completed";
		$('#order-graph-heading').text('Completed Orders Graph');
	}
	else if(toggleId == "processing"){
		status = "Processing";
		$('#order-graph-heading').text('Processing Orders Graph');
	}
	else {
		$('#order-graph-heading').text('Total Orders Graph');
	}
	$.ajax({
		url : "orders_bargraph_data_ajax.php",
		type : "POST",
		dataType: "json",  
        data: {
			status: status,
        },
		success : function(data){
            console.log(data);
            var obj = {};
            //var data = JSON.parse(data);
            data.forEach(element => {
                obj[element] = (obj[element]||0) + 1;
            });
            
            var orderTypes = ["Sherwani", "Kurta Pajama", "3 Piece Suit", "Suit", "Pant", "Shirt", "Jodhpuri", "Pathani Salwar", "Safari", "Jackets", "Others"];

            var today = new Date();
            var d;
            var month;
			var orderTypeData = [];
			
			orderTypes.forEach(type => {
				if(obj[type] != undefined)
					orderTypeData.push(obj[type]);
                else
					orderTypeData.push(0);
			});
            
            var lineChartData = {
                labels : orderTypes,
                datasets : [
                    {
                        label: "My First dataset",
                        fillColor : "rgba(50,150,200,0.3)",
                        strokeColor : "rgba(220,220,220,1)",
                        pointColor : "rgba(220,220,220,1)",
                        pointStrokeColor : "#fff",
                        pointHighlightFill : "#fff",
                        pointHighlightStroke : "rgba(220,220,220,1)",
                        data : orderTypeData
                    }
                ]
            }

            var chart1 = document.getElementById("bar-chart").getContext("2d");
            window.myLine = new Chart(chart1).Bar(lineChartData, {
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
})