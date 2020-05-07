<?php 
    $players = getPlayers();
?>
<canvas id="myChart"></canvas>
<script>
const tabLogin = <?php echo json_encode(array_column($players, 'login')) ?>;
const tabScore = <?php echo json_encode(array_column($players, 'score')) ?>;
const ctx = document.getElementById('myChart').getContext('2d');
const myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: tabLogin,
        datasets: [{
            label: "L'évolution du score des joueurs",
            data: tabScore,
            backgroundColor: '#51BFD0',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>