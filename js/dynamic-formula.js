function dynamic_formula(data, cell_text) {
	if (cell_text[0] === '=') {
	    method_name = cell_text.substring(1, cell_text.indexOf("(")).toLowerCase();
		columns = cell_text.substring(cell_text.indexOf("(")+1, cell_text.lastIndexOf(")")).split(",");
		values = [];
		for (var i in columns) {
			column = columns[i].trim().split("|");
			cell_value = get_value_from_index(data, column[0], column[1]);
			values.push(cell_value);
		}
		return window[method_name](values);
	} else {
		return cell_text;
	}
}

function get_value_from_index(data, col, row) {
	var name = "";
	for (var i in data.colModel) {
		if (data.colModel[i].display == col) {
			name = data.colModel[i].name;
			break;
		}
	}
	return data.rows[parseInt(row)].cell[name];
}

function sum(values) {
	sum = 0;
	for(var i in values) {
		sum += values[i];
	}
	return sum;
}

function avg(values) {
	sum = 0;
	for(var i in values) {
		sum += values[i];
	}
	return sum / values.length;
}

function min(values) {
	min = Infinity;
	for(var i in values) {
		if (values[i] < min) {
			min = values[i];
		}
	}
	return min;
}

function max(values) {
	max = -Infinity;
	for(var i in values) {
		if (values[i] > max) {
			max = values[i];
		}
	}
	return max;
}


/*dynamic_formula(data, "=SUM(ID|0, ID|1)");
dynamic_formula(data, "=AVG(ID|0, ID|1)");
dynamic_formula(data, "=MIN(ID|0, ID|1)");
dynamic_formula(data, "=MAX(ID|0, ID|1)");*/