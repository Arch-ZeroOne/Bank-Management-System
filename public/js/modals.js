const addNewModal = document.getElementById("modal");
const trigger_btn = document.getElementById("add-new");
const close_btn = document.querySelectorAll("#quit");
const editModal = document.getElementById("update");

trigger_btn.addEventListener("click", () => {
    addNewModal.style.top = "0px";
});

close_btn.forEach((btn) => {
    btn.addEventListener("click", () => {
        addNewModal.style.top = "-900px";
        editModal.style.top = "-900px";
    });
});
