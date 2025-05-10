const destroy = document.getElementById("delete");
const pathname = window.location.href;

destroy.addEventListener("click", () => {
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
            Swal.fire({
                title: "Deleted!",
                text: "Your file has been deleted.",
                icon: "success",
            });
        }
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
} else {
    const update = document.getElementById("update");
    update.addEventListener("click", () => {
        Swal.fire({
            title: "Wanna update account?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Confirm",
        }).then((result) => {});
    });
}
