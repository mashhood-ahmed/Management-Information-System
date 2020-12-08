$(document).ready(function() {

	$.ajax({

		url: "./index.php",
		method: "GET",
		success: function(data) {

			console.log(data);
			var weeks = [];
			var score = [];

			for(var i in data) {

				weeks.push(data[i].Week);
				score.push(data[i].score);
			}

			var chartdata = {

				labels: weeks, 
				datasets: [

					{

						label: 'Distribution Of Grades' ,
						backgroundColor: 'rgba(0, 0, 0, 0.1)' ,
						borderColor: 'rgba(200,200,200,0.75)' ,
						hoverBackgroundColor: 'rgba(200,200,200,1)' ,
						hoverBorderColor: 'rgba(200,200,200,1)',
						data: score

					}

				]

			};

			var ctx = $("#mycanvas");
			var barGraph = new Chart(ctx, {

				type: 'doughnut',
				data: chartdata

			});

		} ,

		error: function(data) {

			console.log(data);
		}


	});


});