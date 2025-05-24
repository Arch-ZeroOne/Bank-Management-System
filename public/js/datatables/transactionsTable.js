function baseUrl() {
    //Equivalent to since we are in localhost : http://127.0.0.1:8000/
    return location.protocol + "//" + location.host + "";
}

let transactionTable = new DataTable("#transactionTable", {
    //our route where we request our data's

    ajax: baseUrl() + "/transactions/list",
    processing: true,
    serverSide: true,
    columnDefs: [{ targets: "_all", visible: true }],
    stateSave: true,

    columns: [
        {
            data: "transaction_id",
            name: "transaction_id",
            title: "Transaction ID",
        },
        {
            data: "transaction_date",
            name: "transaction_date",
            title: "Transaction Date",
        },
        {
            data: "transaction_type",
            name: "transaction_type",
            title: "Transaction Type",
        },
        {
            data: "amount",
            name: "amount",
            title: "Amount",
        },
        {
            data: "description",
            name: "description",
            title: "Description",
        },
        {
            data: "account_id",
            name: "account_id",
            title: "Account ID",
        },

        {
            title: "Actions",
            data: "loan_approval_id",
            render: function (data) {
                return `
                <div class="flex justify-center gap-10 p-2 items-center w-full" style="gap:10px; ">
                    <img class="edit-btn cursor-pointer h-20"  id="approve" title="Approve Request" data-approve="${data}" src="../../images/update.png" style="height:40px;"> 
                    <img class="edit-btn cursor-pointer h-20"  id="decline" title="Decline Request"data-decline="${data}" src="../../images/delete.png" style="height:40px;"> 

                </div>`;
            },
        },
    ],
});
