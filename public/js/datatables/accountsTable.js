// Clean and unique variable/function names for modal and account table handling

// Element Selectors
const modalUpdateAccount = document.getElementById("update-account");
const modalAddAccount = document.getElementById("modal");
const btnOpenAddModal = document.getElementById("add-user");
const btnSubmitAddAccount = document.getElementById("add");
const loaderSpinner = document.getElementById("loader");
const btnCloseModals = document.querySelectorAll("#quit");

// Utility Function: Base URL
function getBaseUrl() {
    return `${location.protocol}//${location.host}`;
}

// Initialize DataTable
const accountTable = new DataTable("#myTable", {
    ajax: `${getBaseUrl()}/table/list`,
    processing: true,
    serverSide: true,
    stateSave: true,
    columnDefs: [{ targets: "_all", visible: true }],
    columns: [
        { data: "account_id", name: "account_id", title: "Account ID" },
        {
            data: "account_number",
            name: "account_number",
            title: "Account Number",
        },
        { data: "account_type", name: "account_type", title: "Account Type" },
        { data: "balance", name: "balance", title: "Balance" },
        { data: "opened_date", name: "opened_date", title: "Opened Date" },
        {
            data: "status",
            title: "Status",
            render: function (data) {
                if (data === "Active") {
                    return `<span class="bg-green-100 text-green-600 font-bold px-3 py-1 rounded-full text-sm shadow-sm inline-block">${data}</span>`;
                } else if (data === "Inactive") {
                    return `<span class="bg-yellow-100 text-yellow-600 font-bold px-3 py-1 rounded-full text-sm shadow-sm inline-block" style="color:#FDCA40;">${data}</span>`;
                } else {
                    return `<span class="bg-gray-100 text-gray-600 font-bold px-3 py-1 rounded-full text-sm shadow-sm inline-block">${data}</span>`;
                }
            },
        },
        { data: "customer_id", name: "customer_id", title: "Customer ID" },
        {
            title: "Actions",
            data: "account_id",
            render: (id) => `
                <div class="flex justify-center gap-5 p-2">
                    <i class="fa-solid fa-pencil edit-btn cursor-pointer text-lg" id="edit" data-id="${id}" title="Edit Details"></i>
                    <i class="fa-solid fa-user-slash cursor-pointer text-lg" id="delete" data-delete="${id}" title="Delete User"></i>
                </div>`,
        },
    ],
});

// Handle Action Clicks (Edit/Delete)
document.getElementById("myTable").addEventListener("click", (e) => {
    const { id, delete: deleteId } = e.target.dataset;
    if (e.target.id === "edit") loadAccountForEdit(id);
    if (e.target.id === "delete") confirmDeleteAccount(deleteId);
});

// Modal Open/Close Events
btnCloseModals.forEach((btn) => btn.addEventListener("click", closeAllModals));
btnSubmitAddAccount.addEventListener("click", openAddAccountModal);
btnOpenAddModal.addEventListener("click", confirmAddAccount);

document.querySelectorAll("#update-user").forEach((btn) => {
    btn.addEventListener("click", confirmUpdateAccount);
});

// Modal Controls
function openUpdateAccountModal() {
    modalUpdateAccount.classList.replace("invisible", "visible");
}

function closeUpdateAccountModal() {
    modalUpdateAccount.classList.replace("visible", "invisible");
}

function openAddAccountModal() {
    modalAddAccount.classList.replace("invisible", "visible");
}

function closeAddAccountModal() {
    modalAddAccount.classList.replace("visible", "invisible");
}

function closeAllModals() {
    closeAddAccountModal();
    closeUpdateAccountModal();
}

// Loader Controls
function showLoader() {
    loaderSpinner.classList.remove("invisible");
}

function hideLoader() {
    loaderSpinner.classList.add("invisible");
}

// Confirmations
function confirmAddAccount() {
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
            submitAddAccount();
            closeAddAccountModal();
        }
    });
}

function confirmUpdateAccount() {
    Swal.fire({
        title: "Confirm?",
        text: "You won't be able to revert this!",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Update user",
    }).then((result) => {
        if (result.isConfirmed) submitUpdateAccount();
    });
}

// Data Handlers
async function loadAccountForEdit(accountId) {
    showLoader();
    openUpdateAccountModal();
    const res = await fetch(`user/${accountId}`);
    if (res.ok) {
        const [account] = await res.json();
        document.getElementById("id").value = account.account_id;
        document.getElementById("number").value = account.account_number;
        document.getElementById("plan").value = account.account_type;
        document.getElementById("status").value = account.status;
        document.getElementById("balance").value = account.balance;
        document.getElementById("date").value = account.opened_date;
        document.getElementById("customer").value = account.customer_id;
        hideLoader();
    }
}

async function submitAddAccount() {
    const payload = {
        account_type: document.getElementById("acc-plans").value,
        balance: +document.getElementById("initial-balance").value,
        customer_id: +document.getElementById("customer-id").value,
    };
    const token = document.querySelector('input[name="_token"]').value;
    showLoader();
    const res = await fetch("user/store", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": token,
            Accept: "application/json",
        },
        body: JSON.stringify(payload),
    });
    hideLoader();
    if (res.ok) {
        showSuccessAndReload("User has been added Successfully!");
    } else {
        const { message } = await res.json();
        Swal.fire({ title: "Unsuccessful", text: message, icon: "error" });
    }
}

async function submitUpdateAccount() {
    const payload = {
        id: +document.getElementById("id").value,
        number: +document.getElementById("number").value,
        balance: +document.getElementById("balance").value,
        date: document.getElementById("date").value,
        customer_id: +document.getElementById("customer").value,
        plan: document.getElementById("plan").value,
        status: document.getElementById("status").value,
    };
    const token = document.querySelector('input[name="_token"]').value;

    const res = await fetch("user/update", {
        method: "PATCH",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": token,
            Accept: "application/json",
        },
        body: JSON.stringify(payload),
    });
    if (res.ok) {
        showSuccessAndReload("User updated!");
        closeUpdateAccountModal();
    }
}

async function confirmDeleteAccount(accountId) {
    const token = document.querySelector('input[name="_token"]').value;
    const res = await fetch(`user/${accountId}`);
    if (res.ok) {
        const [account] = await res.json();
        if (account.status === "Inactive") {
            return Swal.fire({
                icon: "error",
                title: "Already Inactive",
                text: "User account is already Inactive",
            });
        }
    }

    Swal.fire({
        title: "Wanna delete account?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Confirm",
    }).then(async (result) => {
        if (result.isConfirmed) {
            await fetch("user/delete", {
                method: "PATCH",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": token,
                    Accept: "application/json",
                },
                body: JSON.stringify({ id: accountId, status: "Inactive" }),
            });
            showSuccessAndReload("Deletion Successful!");
        }
    });
}

function showSuccessAndReload(message) {
    Swal.fire({
        title: message,
        html: "<h1>Please wait shortly</h1>",
        timer: 2000,
        timerProgressBar: true,
        didOpen: () => Swal.showLoading(),
        willClose: () => accountTable.ajax.reload(),
    });
}
