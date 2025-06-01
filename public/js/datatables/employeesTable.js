function baseUrl() {
    //Equivalent to since we are in localhost : http://127.0.0.1:8000/
    return location.protocol + "//" + location.host + "";
}

const addEmployee = document.getElementById("add-employee");
const addNewEmployeeModal = document.getElementById("addNewEmployeeModal");
const exitAdd = document.getElementById("exit-employee");
const addEmployeeConfirm = document.getElementById("confirm-add-employee");
const updateEmployeeModal = document.getElementById("update-employee-modal");
const submitUpdateForm = document.getElementById("submitEmployeeFormV2");
const closeUpdateForm = document.getElementById("closeEmployeeFormV2");
const loaderSpinnerEmployees = document.getElementById("loader");

let employeesTable = new DataTable("#employeesTable", {
    //our route where we request our data's

    ajax: baseUrl() + "/employees/list",
    processing: true,
    serverSide: true,
    columnDefs: [{ targets: "_all", visible: true }],
    stateSave: true,

    columns: [
        {
            data: "employee_id",
            name: "employee_id",
            title: "Employee ID",
        },
        {
            data: "first_name",
            name: "first_name",
            title: "First Name",
        },
        {
            data: "last_name",
            name: "last_name",
            title: "Last Name",
        },
        {
            data: "email",
            name: "email",
            title: "Email",
        },
        {
            data: "phone_number",
            name: "phone_number",
            title: "Phone Number",
        },
        {
            data: "position",
            name: "position",
            title: "Position",
        },
        {
            data: "hire_date",
            name: "hire_date",
            title: "Hire Date",
        },
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

        {
            title: "Actions",
            data: "employee_id",
            render: function (data) {
                return `
                <div class="flex justify-center gap-6 p-2 items-center w-full"     >
                <i class="fa-solid fa-marker  text-lg" id="edit-employee" data-id="${data}"></i>
                <i class="fa-solid fa-trash text-lg" id="delete-employee" data-delete="${data}"></i>

                </div>`;
            },
        },
    ],
});

// Handle Action Clicks (Edit/Delete)
document.getElementById("employeesTable").addEventListener("click", (e) => {
    const { id, delete: deleteId } = e.target.dataset;
    if (e.target.id === "edit-employee")
        loadEmployeeForEdit(e.target.dataset.id);
    if (e.target.id === "delete-employee") console.log(e.target.dataset.delete);
    confirmDeleteEmployee(e.target.dataset.delete);
});

addEmployee.addEventListener("click", openAddEmployeeModal);
exitAdd.addEventListener("click", closeAddEmployeeModal);
closeUpdateForm.addEventListener("click", closeAllEmployeeModals);

// Modal Open/Close Events
btnCloseModals.forEach((btn) =>
    btn.addEventListener("click", closeAllEmployeeModals)
);
submitUpdateForm.addEventListener("click", confirmUpdateEmployee);

addEmployeeConfirm.addEventListener("click", confirmAddEmployee);

document.querySelectorAll("#update-employee").forEach((btn) => {
    btn.addEventListener("click", confirmUpdateEmployee);
});

// Modal Controls
function openUpdateEmployeeModal() {
    updateEmployeeModal.classList.replace("invisible", "visible");
}

function closeUpdateEmployeeModal() {
    updateEmployeeModal.classList.replace("visible", "invisible");
}

function openAddEmployeeModal() {
    addNewEmployeeModal.classList.replace("invisible", "visible");
}

function closeAddEmployeeModal() {
    addNewEmployeeModal.classList.replace("visible", "invisible");
}

function closeAllEmployeeModals() {
    closeAddEmployeeModal();
    closeUpdateEmployeeModal();
}

// Loader Controls
function showLoader() {
    loaderSpinner.classList.remove("invisible");
}

function hideLoader() {
    loaderSpinner.classList.add("invisible");
}

// Confirmations
function confirmAddEmployee() {
    Swal.fire({
        title: "Confirm?",
        text: "You won't be able to revert this!",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Add employee",
    }).then((result) => {
        if (result.isConfirmed) {
            submitAddEmployee();
            closeAddEmployeeModal();
        }
    });
}

function confirmUpdateEmployee() {
    Swal.fire({
        title: "Confirm?",
        text: "You won't be able to revert this!",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Update employee",
    }).then((result) => {
        if (result.isConfirmed) submitUpdateEmployee();
    });
}

// Data Handlers
async function loadEmployeeForEdit(employeeId) {
    showLoader();
    openUpdateEmployeeModal();
    const res = await fetch(`employees/${employeeId}`);
    if (res.ok) {
        const [employee] = await res.json();
        employeeId = employee.employee_id;
        document.getElementById("employee-id").value = employee.employee_id;
        document.getElementById("employeeFirstNameV2").value =
            employee.first_name;
        document.getElementById("employeeLastNameV2").value =
            employee.last_name;
        document.getElementById("employeeEmailV2").value = employee.email;
        document.getElementById("employeePhoneV2").value =
            employee.phone_number;
        document.getElementById("employeePositionV2").value = employee.position;
        document.getElementById("employeeHireDateV2").value =
            employee.hire_date;
        document.getElementById("employeeBranchIdV2").value =
            employee.branch_id;
        hideLoader();
    }
}

async function submitAddEmployee() {
    const payload = {
        first_name: document.getElementById("emp-first-name").value.trim(),
        last_name: document.getElementById("emp-last-name").value.trim(),
        email: document.getElementById("emp-email").value.trim(),
        phone_number: document.getElementById("emp-phone-number").value.trim(),
        position: document.getElementById("emp-position").value,
        hire_date: document.getElementById("emp-hire-date").value,
        branch_id: parseInt(document.getElementById("emp-branch-id").value),
    };
    console.log(payload);
    const token = document.querySelector('input[name="_token"]').value;
    showLoader();
    const res = await fetch("employees/store", {
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
        showSuccessAndReload("Employee added successfully!");
    } else {
        const { message } = await res.json();
        Swal.fire({ title: "Unsuccessful", text: message, icon: "error" });
    }
}

async function submitUpdateEmployee() {
    showLoader();
    const payload = {
        first_name: document.getElementById("employeeFirstNameV2").value.trim(),
        last_name: document.getElementById("employeeLastNameV2").value.trim(),
        email: document.getElementById("employeeEmailV2").value.trim(),
        phone_number: document.getElementById("employeePhoneV2").value.trim(),
        position: document.getElementById("employeePositionV2").value.trim(),
        hire_date: document.getElementById("employeeHireDateV2").value,
        branch_id: parseInt(
            document.getElementById("employeeBranchIdV2").value
        ),
    };

    const token = document.querySelector('input[name="_token"]').value;

    const res = await fetch(
        `employees/${document.getElementById("employee-id").value}`,
        {
            method: "PATCH",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": token,
                Accept: "application/json",
            },
            body: JSON.stringify(payload),
        }
    );
    if (res.ok) {
        hideLoader();
        showSuccessAndReload("Employee updated!");
        closeUpdateEmployeeModal();
    }
}

async function confirmDeleteEmployee(employeeId) {
    showLoader();

    const token = document.querySelector('input[name="_token"]').value;
    const res = await fetch(`employees/${employeeId}`);
    if (res.ok) {
        hideLoader();
        const [employee] = await res.json();

        if (employee.status === "Inactive") {
            return Swal.fire({
                icon: "error",
                title: "Already Inactive",
                text: "Employee is already marked as inactive.",
            });
        }
    }

    Swal.fire({
        title: "Delete employee?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Confirm",
    }).then(async (result) => {
        if (result.isConfirmed) {
            await fetch(`employees/delete/${employeeId}`, {
                method: "PATCH",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": token,
                    Accept: "application/json",
                },
                body: JSON.stringify({ id: employeeId, status: "Inactive" }),
            });
            showSuccessAndReload("Employee deleted!");
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
        willClose: () => employeesTable.ajax.reload(),
    });
}

function showLoader() {
    loaderSpinnerEmployees.classList.remove("invisible");
}

function hideLoader() {
    loaderSpinner.classList.add("invisible");
}
