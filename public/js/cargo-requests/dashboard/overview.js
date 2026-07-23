const ctx = document.getElementById("requestsOverviewChart");

const lineChart = new Chart(ctx,{
    type: "line",

    data: {
        labels: [],

        datasets: [
            {
                label: "Pending",
                data: [0, 0, 0, 0.5, 0.8, 0, 0],
                borderColor: "#F59E0B",
                backgroundColor: "#F59E0B",
                borderWidth: 2,
                tension: 0,
                pointRadius: 3,
                pointHoverRadius: 4,
                fill: false,
            },
            {
                label: "Approved",
                data: [1, 2, 2, 1, 2, 1, 0],
                borderColor: "#22C55E",
                backgroundColor: "#22C55E",
                borderWidth: 2,
                tension: 0,
                pointRadius: 3,
                fill: false,
            },
            {
                label: "Rejected",
                data: [1, 1, 2, 0, 1, 1, 1.2],
                borderColor: "#EF4444",
                backgroundColor: "#EF4444",
                borderWidth: 2,
                tension: 0,
                pointRadius: 3,
                fill: false,
            },
            {
                label: "Total",
                data: [2.2, 3.2, 4.1, 2.2, 4.1, 2.2, 1.2],
                borderColor: "#3B82F6",
                backgroundColor: "#3B82F6",
                borderWidth: 2,
                tension: 0,
                pointRadius: 3,
                fill: false,
            },
        ],
    },

    options: {
        responsive: true,
        maintainAspectRatio: false,

        interaction: {
            intersect: false,
            mode: "index",
        },

        plugins: {
            legend: {
                position: "top",
                labels: {
                    boxWidth: 18,
                    boxHeight: 2,
                    usePointStyle: false,
                    padding: 20,
                    color: "#6B7280",
                    font: {
                        size: 12,
                    },
                },
            },
        },

        scales: {
            x: {
                grid: {
                    color: "#F3F4F6",
                    drawBorder: false,
                },
                ticks: {
                    color: "#9CA3AF",
                },
            },

            y: {
                beginAtZero: true,
                max: 5,
                ticks: {
                    stepSize: 1,
                    color: "#9CA3AF",
                },
                grid: {
                    color: "#F3F4F6",
                    drawBorder: false,
                },
            },
        },

        elements: {
            line: {
                cubicInterpolationMode: "default",
            },
        },
    },
});

const pie = document.getElementById("statusChart");

const pieChart = new Chart(pie,{
    type: "doughnut",

    data: {
        labels: ["Pending", "Approved", "Rejected"],
        datasets: [{
            data: [1, 2, 2],
            backgroundColor: [
                "#F59E0B",
                "#22C55E",
                "#EF4444"
            ],
            borderWidth: 0
        }]
    },

    plugins: [ChartDataLabels],

    options: {
        responsive: true,
        maintainAspectRatio: false,

        cutout: "62%",

        plugins: {

            legend: {
                display: false
            },

            datalabels: {

                color: "#fff",

                font: {
                    weight: "bold",
                    size: 13
                },

                formatter: (value, context) => {

                    const total = context.dataset.data.reduce((a, b) => a + b);

                    return Math.round(value / total * 100) + "%";

                }

            }

        }

    }

});
fetch('/api/dashboard/statistics', {
    headers: {
        "Authorization": `Bearer ${localStorage.getItem("token")}`,
        "Accept": "application/json"
    }
})
    .then(response => response.json())
    .then(data => {

        // Line Chart
        lineChart.data.labels = data.labels;

        lineChart.data.datasets[0].data = data.lineChart.pending;
        lineChart.data.datasets[1].data = data.lineChart.approved;
        lineChart.data.datasets[2].data = data.lineChart.rejected;
        lineChart.data.datasets[3].data = data.lineChart.total;

        lineChart.update();

        // Pie Chart
        pieChart.data.datasets[0].data = [
            data.pieChart.pending,
            data.pieChart.approved,
            data.pieChart.rejected
        ];

        pieChart.update();

        // Legend
        document.getElementById('pendingValue').textContent =
            data.pieChart.pending;

        document.getElementById('approvedValue').textContent =
            data.pieChart.approved;

        document.getElementById('rejectedValue').textContent =
            data.pieChart.rejected;

        document.getElementById('totalValue').textContent =
            data.pieChart.total;

    });

