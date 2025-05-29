function baseUrl() {
    //Equivalent to since we are in localhost : http://127.0.0.1:8000/
    return location.protocol + "//" + location.host + "";
}
const loansLoader = document.getElementById("loader");
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
                    return `<span class="text-green-600 font-bold">${data}</span>`;
                } else if (data === "Unpaid") {
                    return `<span class="text-red-600 font-bold">${data}</span>`;
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
                <i class="fa-solid fa-user-check edit-btn cursor-pointer text-lg" id="paid" title="Mark Paid" data-paid="${data}"></i>
                <i class="fa-solid fa-user-xmark edit-btn cursor-pointer text-lg" id="unpaid" title="Mark Unpaid" data-unpaid="${data}"></i>
                </div>`;
            },
        },
    ],
});

document.getElementById("loansTable").addEventListener("click", (e) => {
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
});

async function toggleStatus(status, id) {
    const loan_status = status ? "Paid" : "Unpaid";
    const token = document.querySelector(`input[name="_token"`).value;

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
function showLoader() {
    loansLoader.classList.remove("invisible");
}

function closeLoader() {
    loansLoader.classList.add("invisible");
}
