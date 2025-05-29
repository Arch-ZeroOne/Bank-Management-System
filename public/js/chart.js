getBalanceByType();

function getBalanceByType() {
    fetch("dashboard/types")
        .then((response) => {
            return response.json();
        })
        .then((data) => {
            console.log(data);
        });
}

new Chart(document.getElementById("total-balance"), {
    type: "doughnut",
    data: {
        labels: ["Basic", "Foreign Currency", "Savings"],
        datasets: [
            {
                label: "Population (millions)",
                backgroundColor: ["#3e95cd", "#8e5ea2", "#3cba9f"],
                data: [2478, 5267, 734],
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
