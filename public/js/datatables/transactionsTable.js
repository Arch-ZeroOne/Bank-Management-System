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
            render: function (data) {
                if (data === "Transfer") {
                    return `<span class="font-bold" style="color:#6BA259">${data}</span>`;
                } else if (data === "Deposit") {
                    return `<span class=" font-bold" style="color:#F7F39A">${data}</span>`;
                } else if (data === "Withdrawal") {
                    return `<span class="font-bold"  style="color:#38817A">${data}</span>`;
                }
            },
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
                <div class="flex justify-center gap-6 p-2 items-center w-full"     >
                <i class="fa-solid fa-marker  text-lg"></i>
                <i class="fa-solid fa-trash text-lg"></i>
    

                </div>`;
            },
        },
    ],
});
