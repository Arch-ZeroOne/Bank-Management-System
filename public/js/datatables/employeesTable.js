function baseUrl() {
    //Equivalent to since we are in localhost : http://127.0.0.1:8000/
    return location.protocol + "//" + location.host + "";
}

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
            title: "Actions",
            data: "employee_id",
            render: function (data) {
                return `
                <div class="flex justify-center gap-6 p-2 items-center w-full"     >
                <i class="fa-solid fa-marker  text-lg"></i>
                <i class="fa-solid fa-trash text-lg"></i>

                </div>`;
            },
        },
    ],
});
