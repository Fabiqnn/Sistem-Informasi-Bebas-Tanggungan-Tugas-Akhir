// validation

document.getElementById("login-form").addEventListener("submit", validation);

function validation() {
    event.preventDefault();

    let noInduk = document.getElementById("noInduk");
    let pass = document.getElementById("pass");

    noInduk.classList.remove("empty-input");
    pass.classList.remove("empty-input");

    if (noInduk.value === "") {
        noInduk.classList.add("empty-input");
    }

    if (pass.value === "") { 
        pass.classList.add("empty-input");
    }

    if (noInduk.value !== "" && pass.value !== "") {
        event.target.submit();
    }
}