const modalCad = document.querySelector(".modalBg");
const modalCadErro = document.querySelector(".modalBgErro");
const btnCad = document.querySelector(".signIn a");
const closeBtnCad = document.getElementById("closeBtnCad");
const closeBtnErro = document.getElementById("closeBtnErro");
const modalcadForm = document.querySelector(".modalcadForm");
const cadInputs = modalcadForm.querySelectorAll(".inputCad");

function modalLockin() {
	document.body.style.overflow = 'hidden';
	document.documentElement.style.overflow = 'hidden';
	document.documentElement.style.height = '100vh';
};
function modalUnlock() {
	document.body.style.overflow = '';
	document.documentElement.style.overflow = '';
	document.documentElement.style.height = '';
};

if(btnCad){
	abre_fecha_modal(btnCad, modalCad);
	xFecha_modal(closeBtnCad, modalCad, btnCad);
}
if(closeBtnErro){
	xFecha_modal(closeBtnErro, modalCadErro);
}
	
modalCad.addEventListener("click", checaClick);
if(modalCadErro){
	modalCadErro.addEventListener("click", checaClick);
}