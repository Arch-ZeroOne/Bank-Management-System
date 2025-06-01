function baseUrl() {
    //Equivalent to since we are in localhost : http://127.0.0.1:8000/
    return location.protocol + "//" + location.host + "";
}
const loansLoader = document.getElementById("loader");
const newLoanModal = document.getElementById("addNewLoans");
const updateLoanModal = document.getElementById("updateLoans");
const exitLoan = document.querySelectorAll("#exit-loans");
const addLoanBtn = document.getElementById("add-loan");
const addNewLoan = document.getElementById("add-new-loan");
const updateLoan = document.getElementById("update-loan");

let loansTable = new DataTable("#loansTable", {
    //our route where we request our data's

    ajax: baseUrl() + "/loans/list",
    processing: true,
    serverSide: true,
    columnDefs: [{ targets: "_all", visible: true }],
    stateSave: true,

    columns: [
        {
            data: "loan_id",
            name: "loan_id",
            title: "Loan ID",
        },
        {
            data: "loan_type",
            name: "loan_type",
            title: "Loan Type",
        },
        {
            data: "principal_amount",
            name: "principal_amount",
            title: "Principal Amount",
        },
        {
            data: "interest_rate",
            name: "interest_rate",
            title: "Interest Rate",
        },
        {
            data: "start_date",
            name: "start_date",
            title: "Start Date",
        },
        {
            data: "end_date",
            name: "end_date",
            title: "End Date",
        },
        {
            data: "status",
            name: "status",
            render: function (data) {
                if (data === "Paid") {
                    return `<span class="bg-green-100 text-green-600 font-bold px-3 py-1 rounded-full text-sm shadow-sm inline-block">${data}</span>`;
                } else if (data === "Unpaid") {
                    return `<span class="bg-yellow-100 text-yellow-600 font-bold px-3 py-1 rounded-full text-sm shadow-sm inline-block" style="color:#FDCA40;">${data}</span>`;
                } else {
                    return `<span class="bg-gray-100 text-gray-600 font-bold px-3 py-1 rounded-full text-sm shadow-sm inline-block">${data}</span>`;
                }
            },
            title: "Status",
        },
        {
            data: "customer_id",
            name: "customer_id",
            title: "Customer ID",
        },

        {
            title: "Actions",
            data: "loan_id",
            render: function (data) {
                return `
                <div class="flex justify-center gap-4  p-2 items-center w-full" id="toggle" >
                <i class="fa-solid fa-pencil edit-btn cursor-pointer text-lg"  id="edit-loan"  title="Edit Loan"  name="Edit"  data-id="${data}"> </i>
                <i class="fa-solid fa-user-check edit-btn cursor-pointer text-lg" id="paid" title="Mark Paid" data-paid="${data}"></i>
                <i class="fa-solid fa-user-xmark edit-btn cursor-pointer text-lg" id="unpaid" title="Mark Unpaid" data-unpaid="${data}"></i>
                </div>`;
            },
        },
    ],
});

document.getElementById("loansTable").addEventListener("click", (e) => {
    console.log(e.target.id);
    if (e.target.id === "paid") {
        Swal.fire({
            title: "Mark Status Paid?",
            text: "User's loan will be marked as Paid",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Confirm",
            cancelButtonText: "Cancel",
        }).then((result) => {
            if (result.isConfirmed) {
                showLoader();
                toggleStatus(true, e.target.dataset.paid);
            }
        });
    } else if (e.target.id === "unpaid") {
        Swal.fire({
            title: "Mark Status Unpaid?",
            text: "User's loan will be marked as Unpaid",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Confirm",
            cancelButtonText: "Cancel",
        }).then((result) => {
            if (result.isConfirmed) {
                showLoader();
                toggleStatus(false, e.target.dataset.unpaid);
            }
        });
    }

    if (e.target.id === "edit-loan") {
        handleFormValue(e.target.dataset.id);
    }
});
exitLoan.forEach((btn) => {
    btn.addEventListener("click", () => {
        closeLoanModal();
        closeEditModal();
    });
});
addLoanBtn.addEventListener("click", showLoanModal);
addNewLoan.addEventListener("click", showAddLoanConfirmation);
updateLoan.addEventListener("click", showUpdateConfirmation);

async function toggleStatus(status, id) {
    const loan_status = status ? "Paid" : "Unpaid";
    const token = document.querySelector(`input[name="_token"`).value;
    let proceed = true;

    const getOldDetails = await fetch(`loans/${id}`);

    if (getOldDetails.ok) {
        const data = await getOldDetails.json();
        const status = data[0].status;
        closeLoader();

        if (status === "Paid" && loan_status === "Paid") {
            Swal.fire({
                title: "Account already marked Paid",
                icon: "error",
                text: "Account status is already paid please take another action",
            });
            proceed = false;
        } else if (status === "Unpaid" && loan_status === "Unpaid") {
            Swal.fire({
                title: "Account already marked Unpaid",
                icon: "error",
                text: "Account status is already Unpaid please take another action",
            });
            proceed = false;
        }
    }

    if (proceed) {
        const payload = {
            id: id,
            status: loan_status,
        };

        const request = await fetch("loans/update", {
            method: "PATCH",
            headers: {
                "X-CSRF-TOKEN": token,
                "CONTENT-TYPE": "application/json",
                Accept: "application/json",
            },
            body: JSON.stringify(payload),
        });

        if (request.ok) {
            closeLoader();
            let timerInterval;
            Swal.fire({
                title: "Status Updated!",
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
                    loansTable.ajax.reload();
                }
            });
        }
    }
}

function showAddLoanConfirmation() {
    Swal.fire({
        title: "Confirm?",
        text: "Loan will be added",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Confirm",
        cancelButtonText: "Cancel",
    }).then((result) => {
        if (result.isConfirmed) {
            showLoader();
            sendAddRequest();
        }
    });
}

async function sendAddRequest() {
    const loan_type = document.getElementById("loan-type").value;
    const principal_amount = document.getElementById("principal-amount").value;
    const rate = document.getElementById("interest-rate").value;
    const start_date = document.getElementById("start-date").value;
    const end_date = document.getElementById("end-date").value;
    const customer_id = document.getElementById("loan-customer-id").value;
    const token = document.querySelector('input[name="_token"').value;

    showLoader();

    const payload = {
        loan_type: loan_type,
        principal_amount: principal_amount,
        interest_rate: rate,
        start_date: start_date,
        end_date: end_date,
        customer_id: customer_id,
    };

    try {
        const request = await fetch("loans/insert", {
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
            closeLoanModal();
            closeLoader();
            Swal.fire({
                title: "Loan has been added Successfully!",
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
                    loansTable.ajax.reload();
                }
            });
        }
    } catch (error) {
        console.log("Error");
    }
}

async function handleFormValue(id) {
    showLoader();

    const request = await fetch(`loans/${id}`);

    if (request.ok) {
        closeLoader();
        showEditModal();
        const data = await request.json();

        //Sets the value of the form from the data queried in the db
        document.getElementById("update-loan-id").value = data[0].loan_id;
        document.getElementById("update-customer-id").value =
            data[0].customer_id;
        document.getElementById("update-loan-type").value = data[0].loan_type;
        document.getElementById("update-principal-amount").value =
            data[0].principal_amount;
        document.getElementById("update-interest-rate").value =
            data[0].interest_rate.toFixed(1);

        document.getElementById("update-start-date").value = data[0].start_date;
        document.getElementById("update-end-date").value = data[0].end_date;
    }
}

function showUpdateConfirmation() {
    Swal.fire({
        title: "Confirm?",
        text: "You cannot revert this action",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Confirm",
        cancelButtonText: "Cancel",
    }).then((result) => {
        if (result.isConfirmed) {
            const loan_id = document.getElementById("update-loan-id").value;
            const customerId =
                document.getElementById("update-customer-id").value;
            const loanType = document.getElementById("update-loan-type").value;
            const principalAmount = document.getElementById(
                "update-principal-amount"
            ).value;
            const interestRate = document.getElementById(
                "update-interest-rate"
            ).value;
            const startDate =
                document.getElementById("update-start-date").value;
            const endDate = document.getElementById("update-end-date").value;
            const token = document.querySelector('input[name="_token"').value;
            const payload = {
                loan_id: loan_id,
                customer_id: Number(customerId),
                customer_id: Number(customerId),
                loan_type: loanType,
                principal_amount: Number(principalAmount),
                interest_rate: interestRate,
                start_date: startDate,
                end_date: endDate,
            };
            sendUpdateRequest(payload, token);
        }
    });
}

async function sendUpdateRequest(payload, token) {
    try {
        //AJAX patch operation
        const request = await fetch(`loans/edit`, {
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
                title: "Loan Details updated!",
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
                    loansTable.ajax.reload();
                    closeEditModal();
                }
            });
        }
    } catch (error) {}
}

function showLoader() {
    loansLoader.classList.remove("invisible");
    loansLoader.classList.add("visible");
}

function closeLoader() {
    loansLoader.classList.remove("visible");
    loansLoader.classList.add("invisible");
}

function showLoanModal() {
    newLoanModal.classList.remove("invisible");
    newLoanModal.classList.add("visible");
}

function closeLoanModal() {
    newLoanModal.classList.add("invisible");
    newLoanModal.classList.remove("visible");
}

function showEditModal() {
    updateLoanModal.classList.add("visible");
    updateLoanModal.classList.remove("invisible");
}

function closeEditModal() {
    updateLoanModal.classList.add("invisible");
    updateLoanModal.classList.remove("visible");
}
