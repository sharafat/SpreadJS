function drawChart(options) {
  var cols = options.cols;
  var div = options.block;
  var type = options.type;
  var opt = options.opt;

  var table = new Array([]);
  var colMeths = data.colModel;
  var rows = data.rows;

  for(var i = 0; i < cols.length; i++) {
    var col = cols[i];

    for(obj in colMeths) {
      var o = colMeths[obj];
      if (o.name === col) {
        table[0][i] = o.display;
        break;
      }
    }  
  }

  var index = 1;
  for (obj in rows) {
    var row = rows[obj];
    var cell = row.cell;
    table[index] = new Array();
    for (var i = 0; i < cols.length; i++) {
      table[index][i] = cell[cols[i]];
    }
    index++;
  }

  // Load the Visualization API and the piechart package.
  google.load('visualization', '1.0', {'packages':['corechart']});

  // Set a callback to run when the Google Visualization API is loaded.
  google.setOnLoadCallback(function () {
    var data = google.visualization.arrayToDataTable(table);
    var chart;
    if (type === "pie") {
      // Instantiate and draw our chart, passing in some options.
      chart = new google.visualization.PieChart(document.getElementById(div));
    } else if (type === "bar") {
      // Instantiate and draw our chart, passing in some options.
      chart = new google.visualization.BarChart(document.getElementById(div));
    }
    
    chart.draw(data, opt);
  });
}