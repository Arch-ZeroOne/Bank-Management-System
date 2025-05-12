// We acquired the id by embedding the id to the id property of the button
// Ajax operation for getting form datas
document.querySelectorAll(".edit-btn").forEach((btn) => {
    btn.addEventListener("click", (e) => {
        let id = e.target.id;
        fetch(`user/${id}`)
            .then((response) => {
                return response.json();
            })
            .then((data) => {
                console.log(data[0].balance);
                document.getElementById("id").value = data[0].account_id;
                document.getElementById("number").value = Number(
                    data[0].account_number
                );
                document.getElementById("balance").value = Number(
                    data[0].balance
                );
                document.getElementById("date").value = data[0].opened_date;
                document.getElementById("customer").value = Number(
                    data[0].customer_id
                );
            });
    });
});
document.querySelectorAll("#update-user").forEach((btn) => {
    btn.addEventListener("click", (e) => {
        const id = e.target.id;

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
                const accId = document.getElementById("id").value;
                const accNum = document.getElementById("number").value;
                const balance = document.getElementById("balance").value;
                const opDate = document.getElementById("date").value;
                const customer = document.getElementById("customer").value;
                const plan = document.getElementById("plan").value;
                const status = document.getElementById("status").value;
                const token = document.querySelector(
                    'input[name="_token"'
                ).value;

                const split = opDate.split("-");

                console.log(split);

                const payload = {
                    id: Number(accId),
                    number: Number(accNum),
                    plan: plan,
                    balance: Number(balance),
                    date: opDate,
                    status: status,
                    customer_id: Number(customer),
                };

                sendRequest();

                async function sendRequest() {
                    try {
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
                            const response = await request.json();
                            window.location.reload();
                        }
                    } catch (error) {
                        console.log("Error occured");
                    }
                }
            }
        });
    });
});
