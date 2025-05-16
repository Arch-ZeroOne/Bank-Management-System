//let table = new DataTable("#myTable");

//ColumnDefs - Takes the value that affects the width of the headers in the tables
//           - Also your customize settings for each header

//data - column of the table where we get our data
//name - used for sorting purposes
//title - header of the column

function baseUrl() {
    //Equivalent to since we are in localhost : http://127.0.0.1:8000/
    return location.protocol + "//" + location.host + "";
}

new DataTable("#myTable", {
    //our route where we request our data's

    ajax: baseUrl() + "/table/list",
    processing: true,
    serverSide: true,
    columnDefs: [{ targets: "_all", visible: true }],

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
        {
            data: "status",
            name: "status",
            title: "Status",
        },
        {
            data: "customer_id",
            name: "customer_id",
            title: "Customer ID",
        },
        {
            title: "Actions",
            data: "customer_id",
            render: function (data) {
                return `
                <div class="flex justify-center gap-10 p-2 items-center w-full">
                <i class="fa solid fa-edit cursor-pointer edit-btn " name="Edit" id="${data}"  ></i>
                <i class="fa solid fa-trash cursor-pointer" name="Delete"id"${data}"></i> 
                </div>`;
            },
        },
    ],
});

document.getElementById("myTable").addEventListener("click", (e) => {
    const id = e.target.id;

    console.log(id);
});
