let countDisc = 0;
let jsonstr = {}


window.onload = function () {
    document.getElementById("jsoninput").value = "";
};

document.getElementById('to_main').addEventListener('click', (e) => {
    let name = document.getElementById('nameInput')
    name.value = name.value.trim()
    let login = document.getElementById('login')
    login.value = login.value.trim()
    let password = document.getElementById('password')
    password.value = password.value.trim()

    if (name.value.trim() === "") {
        e.preventDefault();
    }
    if (login.value.trim() === "") {
        e.preventDefault();
    }
    if (password.value.trim() === "") {
        e.preventDefault();
    }
})
