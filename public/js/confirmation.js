// Confirmation Modals
document.addEventListener("DOMContentLoaded", () => {
    const deleteFormInstance = document.querySelectorAll(".delete-account");
    const updateFormInstance = document.querySelectorAll(".update-account");
    const updateModal = document.getElementById("update");

    deleteFormInstance.forEach((form) => {
        form.addEventListener("submit", (e) => {
            e.preventDefault();

            Swal.fire({
                title: "Wanna delete account?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Confirm",
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });

    updateFormInstance.forEach((form) => {
        form.addEventListener("submit", (e) => {
            e.preventDefault();
            updateModal.style.top = "0px";
        });
    });
});
