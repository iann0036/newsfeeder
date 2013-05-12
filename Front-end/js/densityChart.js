	$(function () {
		var data = [], totalPoints = 200, nextItem = 10;
		function populateData() {
			if (data.length > 0) {
				data = data.slice(1);
				data.push(nextItem);
			} else {
				// pad with 0's
				while (data.length < totalPoints) {
					data.push(0);
				}
			}
	
			// zip the generated y values with the x values
			var res = [];
			for (var i = 0; i < data.length; ++i)
				res.push([i, data[i]])
			return res;
		}
	
		// setup control widget
		var updateInterval = 1000;
	
		// setup plot
		var options = {
			yaxis: { min: 0, max: 100 },
			xaxis: { min: 0, max: 100 },
			colors: ["#afd8f8"],
			series: {
					   lines: { 
							lineWidth: 2, 
							fill: true,
							fillColor: { colors: [ { opacity: 0.6 }, { opacity: 0.2 } ] },
							//"#dcecf9"
							steps: false
	
						}
				   }
		};
		var plot = $.plot($(".densityChart"), [ populateData() ], options);
	
		function update() {
			plot.setData([ populateData() ]);
			//plot.setupGrid();
			plot.draw();
			
			setTimeout(update, updateInterval);
		}
	
		update();
	});