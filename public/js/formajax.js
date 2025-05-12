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
                document.getElementById("acc-id").value = data[0].account_id;
                document.getElementById("acc-number").value = Number(
                    data[0].account_number
                );
                document.getElementById("balance").value = Number(
                    data[0].balance
                );
                document.getElementById("opened-date").value =
                    data[0].opened_date;
                document.getElementById("customer-id").value = Number(
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
                const accId = document.getElementById("acc-id").value;
                const accNum = document.getElementById("acc-number").value;
                const balance = document.getElementById("balance").value;
                const opDate = document.getElementById("opened-date").value;
                const cusId = document.getElementById("customer-id").value;
                const type = document.getElementById("acc-plans").value;
                const status = document.getElementById("status").value;

                const payload = {
                    account_id: accId,
                    account_number: accNum,
                    account_type: type,
                    balance: balance,
                    opened_date: opDate,
                    status: status,
                    customer_id: cusId,
                };

                console.log(payload);
            }
        });
    });
});
