const user = getUser();


document.querySelectorAll('.user-name').forEach(el => {
    el.textContent = user.name;
});

document.querySelectorAll('.user-email').forEach(el => {
    el.textContent = user.email;
});

document.querySelectorAll('.user-avatar').forEach(el => {
    el.textContent = user.name.charAt(0).toUpperCase();
});

const menuBtn = document.getElementById("userMenuBtn");
const dropdown = document.getElementById("userDropdown");


menuBtn.addEventListener("click", function (e) {
    e.stopPropagation();
    dropdown.classList.toggle("hidden");
});

document.addEventListener("click", function () {
    dropdown.classList.add("hidden");
});
