const signInBtn = document.getElementById("signIn");
const signUpBtn = document.getElementById("signUp");
const fistForm = document.getElementById("form1");
const secondForm = document.getElementById("form2");
const container = document.querySelector(".container");

signInBtn.addEventListener("click", () => {
	container.classList.remove("right-panel-active");
});

signUpBtn.addEventListener("click", () => {
	container.classList.add("right-panel-active");
});

fistForm.addEventListener("submit", (e) => e.preventDefault());
secondForm.addEventListener("submit", (e) => e.preventDefault());


function bosKayıtKontrol(){
	var name = $('#name').val();
	var surname = $('#surname').val();
	var username = $('#username').val();
	var password = $('#password').val();
	var re_password = $('#re-password').val();

	if (name == ""){
		alert("Name kısmı boş.");
		return false;
	}
	else if (surname == "") {
		alert("Surname kısmı boş.");
		return false;
	}
	else if (username == "") {
		alert("username kısmı boş.");
		return false;
	}
	else if (password == "") {
		alert("password kısmı boş.");
		return false;
	}
	else if (re_password == "") {
		alert("Re-Password kısmı boş.");
		return false;
	}
	else{
		alert("Kayıt Olundu.");
		return true;
	}
}

function bosGirisKontrol(){
	var username = $('#loginUsername').val();
	var password = $('#loginPassword').val();
	if (username == "") {
		alert("Username yeri boş.");
		return false;
	}
	else if (password =="")
	{
		alert("Password yeri boş.");
		return false;
	}
}