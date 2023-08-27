const sideBar = document.getElementById("sidebar");
const bttn = document.getElementById("bttn");

bttn.addEventListener("click", () => {
    sideBar.classList.toggle("close");
})
