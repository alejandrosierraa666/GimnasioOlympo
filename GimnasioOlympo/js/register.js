let eye = document.getElementById("eye");
let passwd = document.getElementById("password");

eye.addEventListener("click", ()=>changeEye());

function changeEye(){
    if(eye.classList.contains("fa-eye")){
        eye.classList.remove("fa-eye");
        eye.classList.add("fa-eye-slash");
        passwd.type = "text";
    } else {
        eye.classList.remove("fa-eye-slash");
        eye.classList.add("fa-eye");
        passwd.type = "password";
    }
}