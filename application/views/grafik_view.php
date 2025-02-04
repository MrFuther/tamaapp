<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grafik dengan Chart.js</title>
    <script src="<?php echo base_url('assets/js/Chart.min.js'); ?>"></script>
</head>
<body>
    <div style="width: 600px; margin: auto;">
        <canvas id="myChart"></canvas>
    </div>

    <script>
        const ctx = document.getElementById('myChart').getContext('2d');
        const chartData = <?php echo $chartData; ?>;
        
        new Chart(ctx, {
            type: 'bar', // Jenis grafik (bar, line, pie, dll)
            data: chartData,
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
