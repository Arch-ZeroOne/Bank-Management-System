function baseUrl() {
    //Equivalent to since we are in localhost : http://127.0.0.1:8000/
    return location.protocol + "//" + location.host + "";
}

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
            data: "status",
            name: "status",
            title: "Status",
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
            title: "Actions",
            data: "loan_approval_id",
            render: function (data) {
                return `
                <div class="flex justify-center gap-10 p-2 items-center w-full" style="gap:20px; ">
                <i class="fa-solid fa-thumbs-up text-green-600 cursor-pointer" id="approve" title="Approve Request" data-approve="${data}"></i>
                <i class="fa-solid fa-thumbs-down text-red-500 cursor-pointer" id="decline" title="Decline Request"data-decline="${data}" ></i>

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
    }
});

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
            }
        });
    }
}
