//let table = new DataTable("#myTable");

//ColumnDefs - Takes the value that affects the width of the headers in the tables
//           - Also your customize settings for each header

//data - column of the table where we get our data
//name - used for sorting purposes
//title - header of the column

const updateModal = document.getElementById("update");
const addBtn = document.getElementById("add-user");
const addNewModal = document.getElementById("modal");
const closeAddModal = document.querySelectorAll("#quit");
const addNewBtn = document.getElementById("add");
const loader = document.getElementById("loader");

//handling the base url
function baseUrl() {
    //Equivalent to since we are in localhost : http://127.0.0.1:8000/
    return location.protocol + "//" + location.host + "";
}

let accountsTable = new DataTable("#myTable", {
    //ajax request for data
    ajax: baseUrl() + "/table/list",
    processing: true,
    serverSide: true,
    columnDefs: [{ targets: "_all", visible: true }],
    stateSave: true,

    //Table columns
    columns: [
        {
            data: "account_id",
            name: "account_id",
            title: "Account ID",
        },
        {
            data: "account_number",
            name: "account_number",
            title: "Account Number",
        },
        {
            data: "account_type",
            name: "account_type",
            title: "Account Type",
        },
        {
            data: "balance",
            name: "balance",
            title: "Balance",
        },
        {
            data: "opened_date",
            name: "opened_date",
            title: "Opened Date",
        },
        //Adding colors based on the data value
        {
            data: "status",
            title: "Status",
            render: function (data) {
                if (data === "Active") {
                    return `<span class="text-green-600 font-bold">${data}</span>`;
                } else if (data === "Inactive") {
                    return `<span class="text-yellow-600 font-bold" style="color:#FDCA40;">${data}</span>`;
                } else if (data === "Deleted") {
                    return `<span class="text-red-600 font-bold">${data}</span>`;
                }
            },
        },
        {
            data: "customer_id",
            name: "customer_id",
            title: "Customer ID",
        },
        //adding buttons
        {
            title: "Actions",
            data: "account_id",
            render: function (data) {
                return `
                <div class="flex justify-center gap-10 p-2 items-center w-full" style="gap:20px;">
                <i class="fa-solid fa-pencil edit-btn cursor-pointer text-lg"  id="edit"  title="Edit Details"  name="Edit"  data-id="${data}"> </i>
                <i class="fa-solid fa-user-slash cursor-pointer text-lg" name="Delete" id="delete" data-delete="${data}" title="Delete User"> </i>

                </div>`;
            },
        },
    ],
});

document.getElementById("myTable").addEventListener("click", (e) => {
    const update_id = e.target.dataset.id;
    const delete_id = e.target.dataset.delete;

    if (e.target.id === "edit") {
        handleFormValue(update_id);
    } else if (e.target.id === "delete") {
        const token = document.querySelector('input[name="_token"').value;
        showDeleteModal(delete_id, token);
    }
});
closeAddModal.forEach((btn) => {
    btn.addEventListener("click", () => {
        updateModal.style.top = "-900px";
        addNewModal.style.top = "-900px";
    });
});
addBtn.addEventListener("click", () => {
    Swal.fire({
        title: "Confirm?",
        text: "You won't be able to revert this!",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Add user",
    }).then((result) => {
        if (result.isConfirmed) {
            sendAddRequest();
            closeModal();
        }
    });
});
addNewBtn.addEventListener("click", () => {
    showAddModal();
});

async function handleFormValue(id) {
    showLoader();

    let deleted = false;
    const getData = await fetch(`user/${id}`);

    if (getData.ok) {
        closeLoader();
        const data = await getData.json();
        const status = data[0].status;
        console.log(status);

        if (status === "Deleted") {
            deleted = true;
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "User account  been deleted",
            });
        }
    }

    if (!deleted) {
        const request = await fetch(`user/${id}`);
        if (request.ok) {
            closeLoader();
            showModal();
            const data = await request.json();

            console.log(data);
            //Sets the value of the form from the data queried in the db
            document.getElementById("id").value = data[0].account_id;
            document.getElementById("number").value = Number(
                data[0].account_number
            );
            document.getElementById("plan").value = data[0].account_type;
            document.getElementById("status").value = data[0].status;
            document.getElementById("balance").value = Number(data[0].balance);
            document.getElementById("date").value = data[0].opened_date;
            document.getElementById("customer").value = Number(
                data[0].customer_id
            );
        }
    }
}

document.querySelectorAll("#update-user").forEach((btn) => {
    btn.addEventListener("click", () => {
        showConfirmation();
    });
});

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

            sendUpdateRequest(payload, token, accId);
        }
    });
}

async function sendUpdateRequest(payload, token, accId) {
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
                    accountsTable.ajax.reload();
                    closeModal();
                }
            });
        }
    } catch (error) {
        console.log(error.data);
    }
}

//Currently Working in this function when an account is already deleted
function showDeleteModal(id, token) {
    let data = null,
        deleted = false;
    Swal.fire({
        title: "Wanna delete account?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Confirm",
    }).then((result) => {
        if (result.isConfirmed && !deleted) {
            sendDeleteRequest(id, token);
        }
    });
}

async function sendDeleteRequest(id, token) {
    let existing = false;
    const previousInfo = await fetch(`user/${id}`);
    showLoader();

    //Handles already deleted accounts
    if (previousInfo.ok) {
        const data = await previousInfo.json();
        const status = data[0].status;

        console.log(status);

        if (status === "Deleted") {
            existing = true;
            Swal.fire({
                icon: "error",
                title: "Account already deleted",
                text: "Users account is already deleted",
            });
            closeLoader();
        }
    }

    if (!existing) {
        console.log("Fired");
        const payload = {
            id: id,
            status: "Deleted",
        };
        const request = await fetch(`user/delete`, {
            method: "PATCH",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": token,
                Accept: "application/json",
            },
            body: JSON.stringify(payload),
        });

        if (request.ok) {
            closeLoader();
            Swal.fire({
                title: "Deletion Successfull!",
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
                    accountsTable.ajax.reload();
                }
            });
        } else {
            if (!request.ok) {
                const { message } = await request.json();
                Swal.fire({
                    title: "Unsuccessfull",
                    text: message,
                    icon: "error",
                });
            }
        }
    }

    async function sendAddRequest() {
        const balance = document.getElementById("initial-balance").value;
        const customer = document.getElementById("customer-id").value;
        const plan = document.getElementById("acc-plans").value;
        const token = document.querySelector('input[name="_token"').value;

        showLoader();

        const payload = {
            account_type: plan,
            balance: balance,
            customer_id: customer,
        };

        try {
            const request = await fetch("user/store", {
                method: "POST",
                headers: {
                    "CONTENT-TYPE": "application/json",
                    "X-CSRF-TOKEN": token,
                    Accept: "application/json",
                },
                body: JSON.stringify(payload),
            });

            if (!request.ok) {
                closeLoader();
                const { message } = await request.json();
                Swal.fire({
                    title: "Unsuccessfull",
                    text: message,
                    icon: "error",
                });
            }

            if (request.ok) {
                closeLoader();
                Swal.fire({
                    title: "User has been added Successfully!",
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
                        document.getElementById("initial-balance").value = "0";
                        document.getElementById("customer-id").value = "";
                        document.getElementById("acc-plans").value = "Savings";
                        accountsTable.ajax.reload();
                    }
                });
            }
        } catch (error) {
            console.log("Error");
        }
    }
}

function showModal() {
    updateModal.style.top = "0px";
}
function showAddModal() {
    addNewModal.style.top = "0px";
}

function closeModal() {
    updateModal.style.top = "-900px";
    addNewModal.style.top = "-900px";
}
function showLoader() {
    loader.classList.remove("invisible");
}

function closeLoader() {
    loader.classList.add("invisible");
}
