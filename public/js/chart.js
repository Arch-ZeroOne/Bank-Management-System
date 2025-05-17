const ctx = document.getElementById("myChart");

new Chart(ctx, {
    type: "bar",
    data: {
        labels: ["Savings", "Checking", "Basic"],
        datasets: [
            {
                label: "# of Savings Account",

                data: [12, 19, 3, 5, 2, 3],
                borderWidth: 1,
                backgroundColor: ["red", "blue", "yellow"],
                borderWidth: 1,
            },
        ],
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
            },
        },
    },
});


function requestData(){
    
}