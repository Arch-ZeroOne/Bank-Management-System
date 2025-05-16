//let table = new DataTable("#myTable");

//ColumnDefs - Takes the value that affects the width of the headers in the tables
//           - Also your customize settings for each header

//data - column of the table where we get our data
//name - used for sorting purposes
//title - header of the column

function baseUrl() {
    //Equivalent to since we are in localhost : http://127.0.0.1:8000/
    return location.protocol + "//" + location.host;
}

console.log(`${baseUrl()}/user/list`);

new DataTable("#myTable", {
    //our route where we request our data's

    ajax: `${baseUrl()}/user/list`,
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
            data: "account_status",
            name: "account_status",
            title: "Status",
        },
        {
            data: "customer_id",
            name: "customer_id",
            title: "Customer ID",
        },
    ],
});
