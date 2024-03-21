<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thống kê đơn hàng</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="thongke">
            <div class="row">
                <div class="col-md-6" id="chart_div">
                    <!-- Placeholder for chart -->
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="thongke">Thống kê đơn hàng theo:</label>
                        <select class="form-control" name="thongke" id="thongke" onchange="drawVisualization()">
                            <option value="7ngay">7 ngày gần nhất</option>
                            <option value="28ngay">28 ngày gần nhất</option>
                            <option value="90ngay">90 ngày gần nhất</option>
                            <option value="365ngay" selected>365 ngày gần nhất</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Load the AJAX API -->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
        google.load('visualization', '1.0', {
            'packages': ['corechart']
        });
        google.setOnLoadCallback(drawVisualization);

        function drawVisualization() {
            var selectedOption = document.getElementById("thongke").value;
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var data = JSON.parse(this.responseText);
                    drawChart(data);
                }
            };
            xhr.open("GET", "http://localhost:8080/PHP2/MyProject-update/Admin/Controller/process.php?option=" + selectedOption, true);
            xhr.send();
        }

        function drawChart(data) {
            var tenhh = [];
            var soluongban = [];

            for (var i = 0; i < data.length; i++) {
                tenhh.push(data[i].tenhh);
                soluongban.push(parseInt(data[i].soluong));
            }

            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Tên MH');
            data.addColumn('number', 'Số Lượng Bán');
            for (var i = 0; i < tenhh.length; i++) {
                data.addRow([tenhh[i], soluongban[i]]);
            }

            var options = {
                title: 'Biểu Đồ Thống Kê Số Lượng bán Theo Ngày',
                width: 600,
                height: 500,
                backgroundColor: '#ffffff',
                is3D: true
            };

            var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }
    </script>
</body>
</html>
