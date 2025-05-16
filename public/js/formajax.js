// We acquired the id by embedding the id to the id property of the button
// Ajax operation for getting form datas

// We acquire data when the update button is clicked
document.querySelectorAll(".edit-btn").forEach((btn) => {
    console.log("Clicked");
    btn.addEventListener("click", (e) => {
        handleFormValue(e);
    });
});

document.querySelectorAll("#update-user").forEach((btn) => {
    btn.addEventListener("click", () => {
        showConfirmation();
    });
});

function handleFormValue(e) {
    let id = e.target.id;
    fetch(`user/${id}`)
        .then((response) => {
            return response.json();
        })
        .then((data) => {
            //Sets the value of the form from the data queried in the db
            console.log(data);
            document.getElementById("id").value = data[0].account_id;
            document.getElementById("number").value = Number(
                data[0].account_number
            );
            document.getElementById("plan").value = data[0].account_type;
            document.getElementById("status").value = data[0].account_status;
            document.getElementById("balance").value = Number(data[0].balance);
            document.getElementById("date").value = data[0].opened_date;
            document.getElementById("customer").value = Number(
                data[0].customer_id
            );
        });
}

function showConfirmation() {
    Swal.fire({
        title: "Confirm?",
        text: "You won't be able to revert this!",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Update user",
    }).then((result) => {
        if (result.isConfirmed) {
            //Gets the current form value
            const accId = document.getElementById("id").value;
            const accNum = document.getElementById("number").value;
            const balance = document.getElementById("balance").value;
            const opDate = document.getElementById("date").value;
            const customer = document.getElementById("customer").value;
            const plan = document.getElementById("plan").value;
            const status = document.getElementById("status").value;
            const token = document.querySelector('input[name="_token"').value;

            //Payload to be passed in laravel
            const payload = {
                id: Number(accId),
                number: Number(accNum),
                plan: plan,
                balance: Number(balance),
                date: opDate,
                status: status,
                customer_id: Number(customer),
            };

            sendRequest(payload, token, accId);
        }
    });
}

async function sendRequest(payload, token, accId) {
    try {
        //AJAX patch operation
        const request = await fetch(`user/${accId}`, {
            method: "PATCH",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": token,
                Accept: "application/json",
            },
            body: JSON.stringify(payload),
        });

        if (request.ok) {
            // base route :  "http://127.0.0.1:8000/user";
            let timerInterval;
            Swal.fire({
                title: "User updated!",
                html: "<h1>Please wait shortly</h1>",
                timer: 2000,
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading();
                    const timer = Swal.getPopup().querySelector("b");
                    timerInterval = setInterval(() => {
                        timer.textContent = `${Swal.getTimerLeft()}`;
                    }, 100);
                },
                willClose: () => {
                    clearInterval(timerInterval);
                },
            }).then((result) => {
                /* Read more about handling dismissals below */
                if (
                    result.dismiss === Swal.DismissReason.timer ||
                    result.dismiss === Swal.DismissReason.backdrop ||
                    result.dismiss === Swal.DismissReason.cancel ||
                    result.dismiss === Swal.DismissReason.close ||
                    result.dismiss === Swal.DismissReason.esc
                ) {
                    window.location = "http://127.0.0.1:8000/user";
                }
            });
        }
    } catch (error) {
        console.log(error.data);
    }
}
