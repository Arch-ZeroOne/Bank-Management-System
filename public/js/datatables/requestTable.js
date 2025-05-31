function baseUrl() {
    //Equivalent to since we are in localhost : http://127.0.0.1:8000/
    return location.protocol + "//" + location.host + "";
}

const addRequest = document.getElementById("addRequest");
const addRequestModal = document.getElementById("addRequestModal");
const addRequestBtn = document.getElementById("add-request");
const exit = document.getElementById("exit-request");
const editModal = document.getElementById("editRequestModal");
const updateRequest = document.getElementById("update-request");

let requestTable = new DataTable("#requestTable", {
    //our route where we request our data's

    ajax: baseUrl() + "/loanrequests/getAll",
    processing: true,
    serverSide: true,
    columnDefs: [{ targets: "_all", visible: true }],
    stateSave: true,

    columns: [
        {
            data: "loan_approval_id",
            name: "loan_approval_id",
            title: "Request ID",
        },
        {
            data: "approval_date",
            name: "approval_date",
            title: "Request Date",
        },

        {
            data: "employee_id",
            name: "employee_id",
            title: "Employee ID",
        },
        {
            data: "loan_id",
            name: "loan_id",
            title: "Loan ID",
        },
        {
            data: "status",
            name: "status",

            render: function (data) {
                if (data === "Approved") {
                    return `<span class="text-green-600 font-bold">${data}</span>`;
                } else if (data === "Ongoing") {
                    return `<span class=" font-bold" style="color:#F7B05B">${data}</span>`;
                } else if (data === "Rejected") {
                    return `<span class="text-red-600 font-bold">${data}</span>`;
                }
            },
            title: "Status",
        },

        {
            title: "Actions",
            data: "loan_approval_id",
            render: function (data) {
                return `
                <div class="flex justify-center gap-10 p-2 items-center w-full" style="gap:20px; ">
                <i class="fa-regular fa-thumbs-up edit-btn text-lg" id="approve" title="Approve Request" data-approve="${data}"> </i>
                <i class="fa-regular fa-thumbs-down edit-btn text-lg" id="decline" title="Decline Request"data-decline="${data}"></i>
                <i class="fa-solid fa-pencil text-lg" id="edit-request" title="Edit Request" data-edit="${data}"></i>
                </div>`;
            },
        },
    ],
});

document.getElementById("requestTable").addEventListener("click", (e) => {
    if (e.target.id === "approve") {
        showApproveConfirmation(e.target.dataset.approve);
    } else if (e.target.id === "decline") {
        showDeclineConfirmation(e.target.dataset.decline);
    } else if (e.target.id === "edit-request") {
        handleFormRequestValue(e.target.dataset.edit);
    }
});

addRequest.addEventListener("click", showAddRequestModal);
exit.addEventListener("click", () => {
    closeAddRequestModal();
    closeEditModal();
});
addRequestBtn.addEventListener("click", showAddConfirmation);
updateRequest.addEventListener("click", showUpdateConfirmation);

async function handleFormRequestValue(id) {
    showLoader();
    try {
        const request = await fetch(`loanrequests/${id}`);

        if (request.ok) {
            closeLoader();

            const data = await request.json();
            console.log(data);
            document.getElementById("request-id").value =
                data[0].loan_approval_id;
            document.getElementById("request-date").value =
                data[0].approval_date;
            document.getElementById("employee-request-id").value =
                data[0].employee_id;
            document.getElementById("loan-id").value = data[0].loan_id;
            document.getElementById("request-status").value = data[0].status;

            showEditModal();
        }
    } catch (error) {}
}

function showApproveConfirmation(id) {
    Swal.fire({
        title: "Approve Request?",
        text: "User's loan will be approved",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Approve",
        cancelButtonText: "Cancel",
    }).then((result) => {
        if (result.isConfirmed) {
            sendRequest(true, id);
        }
    });
}

function showEditConfirmation() {}

function showDeclineConfirmation(id) {
    Swal.fire({
        title: "Decline Request?",
        text: "User's loan will be declined",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Decline",
        cancelButtonText: "Cancel",
    }).then((result) => {
        if (result.isConfirmed) {
            sendRequest(false, id);
        }
    });
}

async function sendRequest(status, id) {
    const getPrevious = await fetch(`loanrequests/${id}`);
    let decided = false;

    if (getPrevious.ok) {
        const data = await getPrevious.json();
        const status = data[0].status;

        if (status !== "Ongoing") {
            decided = true;
            Swal.fire({
                icon: "error",
                title: "Status already decided",
                text: "User request has already been decided by the admin",
            });
        }
    }

    if (!decided) {
        const accessToken = document.querySelector("input[name=_token]").value;
        const loanStatus = status ? "Approved" : "Rejected";

        const payload = {
            loan_approval_id: id,
            status: loanStatus,
        };

        const request = await fetch("loanrequests/update", {
            method: "PATCH",
            headers: {
                "X-CSRF-TOKEN": accessToken,
                "CONTENT-TYPE": "application/json",
                Accept: "application/json",
            },
            body: JSON.stringify(payload),
        });

        if (request.ok) {
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
                    requestTable.ajax.reload();
                    closeEditModal();
                }
            });
        }
    }
}
function showAddRequestModal() {
    addRequestModal.classList.remove("invisible");
    addRequestModal.classList.add("visible");
}

function closeAddRequestModal() {
    addRequestModal.classList.remove("visible");
    addRequestModal.classList.add("invisible");
}
function showEditModal() {
    editModal.classList.remove("invisible");
    editModal.classList.add("visible");
}
function closeEditModal() {
    editModal.classList.remove("visible");
    editModal.classList.add("invisible");
}
function showAddConfirmation() {
    Swal.fire({
        title: "Confirm Request?",
        text: "Request will be immediately added",
        icon: "question",
        showCancelButton: true,
    }).then((response) => {
        if (response.isConfirmed) {
            sendNewRequest();
        }
    });
}

async function sendNewRequest() {
    const requestDate = document.getElementById("request-date").value;
    const employee_id = document.getElementById("employee-id").value;
    const token = document.querySelector('input[name="_token"').value;

    const payload = {
        approval_date: requestDate,
        status: "Ongoing",
        employee_id: employee_id,
    };

    try {
        const request = await fetch("loanrequests/insert", {
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
                    requestTable.ajax.reload();
                    closeAddRequestModal();
                }
            });
        }
    } catch (error) {}
}
function showUpdateConfirmation() {
    Swal.fire({
        title: "Confirm?",
        text: "You won't be able to revert this!",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Update request",
    }).then((result) => {
        if (result.isConfirmed) {
            showLoader();
            //Gets the current form value
            const loan_approval_id =
                document.getElementById("request-id").value;
            const approval_date = document.getElementById("request-date").value;
            const employee_id = document.getElementById(
                "employee-request-id"
            ).value;
            const loan_id = document.getElementById("loan-id").value;
            const status = document.getElementById("request-status").value;
            const token = document.querySelector('input[name="_token"').value;

            //Payload to be passed in laravel
            const payload = {
                loan_approval_id: loan_approval_id,
                approval_date: approval_date,
                employee_id: employee_id,
                loan_id: loan_id,
                status: status,
            };

            sendUpdate(payload, token, loan_approval_id);
        }
    });
}
async function sendUpdate(payload, token, loan_approval_id) {
    try {
        //AJAX patch operation
        const request = await fetch(`loanrequests/edit`, {
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
                    requestTable.ajax.reload();
                    closeUpdateRequestModal();
                }
            });

            if (!request.ok) {
                console.log(request.json());
            }
        }
    } catch (error) {
        console.log(error.data);
    }
}
function showLoader() {
    loader.classList.remove("invisible");
}

function closeLoader() {
    loader.classList.add("invisible");
}
function closeUpdateRequestModal() {
    updateModal.classList.add("invisible");
}
