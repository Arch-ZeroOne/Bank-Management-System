const destroy = document.querySelectorAll(".delete");
const addBtn = document.getElementById("add-user");
const pathname = window.location.href;

destroy.forEach((item) => {
    item.addEventListener("click", () => {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Delete User",
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById("delete-account").submit();
            }
        });
    });
});

if (pathname.split("/").includes("loanrequests")) {
    const updateRequest = document.getElementById("request");
    updateRequest.addEventListener("click", () => {
        Swal.fire({
            title: "Wanna update request?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Confirm",
        }).then((result) => {});
    });
}

addBtn.addEventListener("click", () => {
    Swal.fire({
        title: "Confirm form submission?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Add User",
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById("add-modal").submit();
        }
    });
});
