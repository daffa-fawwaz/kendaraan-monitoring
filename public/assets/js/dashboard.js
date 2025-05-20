document.addEventListener("DOMContentLoaded", function () {
    const canvas = document.getElementById("usageChart");
    const ctx = canvas.getContext("2d");

    const usageDataRaw = canvas.getAttribute("data-usage");
    const usageData = JSON.parse(usageDataRaw);

    const monthlyData = [];
    for (let i = 1; i <= 12; i++) {
        monthlyData.push(usageData[i] ?? 0);
    }

    new Chart(ctx, {
        type: "bar",
        data: {
            labels: [
                "Jan", "Feb", "Mar", "Apr", "Mei", "Jun",
                "Jul", "Agu", "Sep", "Okt", "Nov", "Des"
            ],
            datasets: [{
                label: "Jumlah Booking",
                data: monthlyData,
                backgroundColor: "rgba(59, 130, 246, 0.7)",
                borderColor: "rgba(37, 99, 235, 1)",
                borderWidth: 1,
                borderRadius: 6,
                barPercentage: 0.6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            },
            plugins: {
                legend: {
                    labels: {
                        color: "#e5e7eb"
                    }
                }
            }
        }
    });
});
