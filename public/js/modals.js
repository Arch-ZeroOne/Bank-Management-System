const modal = document.getElementById("modal");
const modal_trigger = document.getElementById("add-new");
const table = document.getElementById("myTable");
const close = document.getElementById("quit");
const addUser = document.getElementById("add-user");

modal_trigger.addEventListener("click", () => {
    modal.style.top = "0px";
});
addUser.addEventListener("click", () => {
    modal.style.top = "-900px";
});
close.addEventListener("click", () => {
    modal.style.top = "-900px";
});
