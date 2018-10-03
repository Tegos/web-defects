function getGroup() {
    var matrix = Create2DArray(7, 7);
    for (var i = 0; i < 7; i++) {
        for (var j = 0; j < 7; j++) {
            var dist = parseFloat(findDistance(i, j));
            matrix[i][j] = (dist);
        }
    }

    var n = 7;

    var next = Create2DArray(7, 7);
    for (var i = 0; i < n; ++i)
        for (var u = 0; u < n; ++u)
            for (var v = 0; v < n; ++v) {
                if (matrix[u][i] + matrix[i][v] < matrix[u][v]) {
                    matrix[u][v] = matrix[u][i] + matrix[i][v]
                    next[u][v] = i
                }
            }

    var groupOne = [];
    var groupTwo = [];

    groupOne.push(0);
    while (groupOne.length < 4) {
        var last_path = groupOne.last();
        var arr = matrix[last_path];
        var m = minimum(arr, groupOne);
        var ind = matrix[last_path].indexOf(m);
        groupOne.push(ind);
    }

    // i = count sites (may changes)
    for (var i = 0; i < 10; i++) {
        if (groupOne.indexOf(i) == -1) {
            groupTwo.push(i + 1);
        }
    }

    groupOne.forEach(function (it, i) {
        groupOne[i] = it + 1;
    });

    var table = $('<table border="1"  class="source-table group-class"/>');
    var tr = $('<tr/>');
    var tr1 = $('<tr/>');
    $('<td>Група 1</td><td>Група 2</td>').appendTo(tr);
    tr.appendTo(table);

    $.getJSON('/api.php?method=getSites', function (json) {

        var gr_1 = [], gr_2 = [];
        groupOne.forEach(function (itt) {
            json.forEach(function (it) {
                if (itt == it.id) {
                    gr_1.push(it.name);
                }
            });
        });

        groupTwo.forEach(function (itt) {
            json.forEach(function (it) {
                if (itt == it.id) {
                    gr_2.push(it.name);
                }
            });
        });

        var td_1 = $('<td/>');
        var td_2 = $('<td/>');

        td_1.html(gr_1.join(', '));
        td_2.html(gr_2.join(', '));

        td_1.appendTo(tr1);
        td_2.appendTo(tr1);
        tr1.appendTo(table);

        $('#table-result-group').html(table);

        console.log(gr_1);
        console.log(gr_2);

        group_1 = [];
        group_2 = [];

        console.dir(series_groups);

        series_groups.forEach(function (it) {
            gr_1.forEach(function (itt) {
                if (it.name == itt) {
                    group_1.push(it);
                }
            });

            gr_2.forEach(function (itt) {
                if (it.name == itt) {
                    group_2.push(it);
                }
            });
        });

        console.log(group_1);
        console.log(group_2);

    });

    //console.log(groupOne);
}