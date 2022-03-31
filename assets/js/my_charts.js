var ctx = document.getElementById('myChart').getContext('2d');
var earning = document.getElementById('earning').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'polarArea',
    data: {
        labels: ['Tahun', 'Bulan', ],
        datasets: [{
            label: 'Pendapatan',
            data: [110000, 20000],
            backgroundColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
    }
});

var myChart = new Chart(earning, {
    type: 'bar',
    data: {
        labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'Novembar', 'Desembar'],
        datasets: [{
            label: 'Pendapatan Tahunan',
            data: [8000, 7000, 5500, 6000, 7000, 8000, 10000, 12000, 14000, 16000, 18000, 19000],
            backgroundColor: [
                'rgba(253, 207, 0, 1)',
                'rgba(255, 252, 1, 1)',
                'rgba(155, 255, 0, 1)',
                'rgba(13, 211, 0, 1)',
                'rgba(9, 170, 212, 1)',
                'rgba(16, 0, 210, 1)',
                'rgba(123, 1, 255, 1)',
                'rgba(181, 0, 211, 1)',
                'rgba(209, 0, 163, 1)',
                'rgba(254, 0, 0, 1)',
                'rgba(255, 96, 4, 1)',
                'rgba(255, 156, 5, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
    }
});