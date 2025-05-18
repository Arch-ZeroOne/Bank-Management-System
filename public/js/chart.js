const ctx = document.getElementById("myChart");

requestData();

function requestData() {
    fetch("dashboard/getCount")
        .then((response) => {
            return response.json();
        })
        .then((data) => {
            const { basicCount, savingsCount, checkingCount } = data;
            drawPieChart(basicCount, savingsCount, checkingCount);
        });
    fetch("dashboard/getStatus")
        .then((response) => {
            return response.json();
        })
        .then((data) => {
            const { active, inactive } = data;
            drawDoughnutChart(active, inactive);
        });
}

function drawPieChart(basicCount, savingsCount, checkingCount) {
    new Chart(document.getElementById("pie-chart"), {
        type: "pie",
        data: {
            labels: ["Savings Account", "Checking Account", "Basic Account"],
            datasets: [
                {
                    label: "Count",
                    backgroundColor: ["red", "green", "blue"],
                    data: [savingsCount, checkingCount, basicCount],
                },
            ],
        },
        options: {
            title: {
                display: true,
                text: "Predicted world population (millions) in 2050",
            },
        },
    });
}

function drawDoughnutChart(active, inactive) {
    new Chart(document.getElementById("doughnut-chart"), {
        type: "doughnut",
        data: {
            labels: ["Active", "Inactive"],
            datasets: [
                {
                    label: "Count",
                    backgroundColor: ["#3e95cd", "#8e5ea2"],
                    data: [active, inactive],
                },
            ],
        },
        options: {
            title: {
                display: true,
                text: "Number of Active and Inactive Accounts",
            },
        },
    });
}
