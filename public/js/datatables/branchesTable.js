function baseUrl() {
    //Equivalent to since we are in localhost : http://127.0.0.1:8000/
    return location.protocol + "//" + location.host + "";
}

let branchesTable = new DataTable("#branchesTable", {
    //our route where we request our data's

    ajax: baseUrl() + "/branches/list",
    processing: true,
    serverSide: true,
    columnDefs: [{ targets: "_all", visible: true }],
    stateSave: true,

    columns: [
        {
            data: "branch_id",
            name: "branch_id",
            title: "Branch ID",
        },
        {
            data: "branch_name",
            name: "branch_name",
            title: "Branch Name",
        },
        {
            data: "address",
            name: "address",
            title: "Address",
        },
        {
            data: "city",
            name: "city",
            title: "City",
        },
        {
            data: "state",
            name: "state",
            title: "State",
        },
        {
            data: "zip_code",
            name: "zip_code",
            title: "Zip Code",
        },

        {
            title: "Actions",
            data: "branch_id",
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
