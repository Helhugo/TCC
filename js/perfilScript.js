const asidePerfil_lis = document.querySelectorAll(".sideMenu_perfil ul li");
const mainMenu_slide = document.querySelector(".mainMenu_slide");
const editInfoBtn = document.querySelector(".formEdit_btn");
const formsInputs = document.querySelectorAll(".inputsInfo");
const btnEnv = document.getElementById("btnEnv");
const editName = document.getElementById("editName");
const h2Name = document.querySelector(".nomePerfil form h2");
const formName = document.querySelector(".formName");
const saveBtn_name = document.querySelector(".btnSave_name");

function checaUrl() {
	let href = document.location.href;
	href = href.split("#").pop();
	if(href == "perfil"){
		asidePerfil_lis[0].dispatchEvent(simulaClique);
	}
	if(href == "pedidos"){
		asidePerfil_lis[1].dispatchEvent(simulaClique);
	}
	if(href == "infos"){
		asidePerfil_lis[2].dispatchEvent(simulaClique);
	}
}

checaUrl();
window.addEventListener('popstate', checaUrl);

for(let n=0; n < formsInputs.length; n++){
	formsInputs[n].setAttribute("disabled", "true");
}

function actived(li){
	for(let n=0; n < asidePerfil_lis.length; n++){
		asidePerfil_lis[n].classList.remove("on");
	}
	
	li.classList.add("on");
	
	if(asidePerfil_lis[0].classList.contains("on")){
		mainMenu_slide.setAttribute("data-state", "perfil");
	}
	if(asidePerfil_lis[1].classList.contains("on")){
		mainMenu_slide.setAttribute("data-state", "pedidos");
	}
	if(asidePerfil_lis[2].classList.contains("on")){
		mainMenu_slide.setAttribute("data-state", "infos");
	}
	if(asidePerfil_lis[3].classList.contains("on")){
		mainMenu_slide.setAttribute("data-state", "reviews");
	}
}

editName.addEventListener("click", function() {
	if(editName.classList.contains("N_hidden")){
		editName.classList.remove("N_hidden");
		h2Name.classList.remove("N_hidden");
		formName.classList.add("N_hidden");
		saveBtn_name.classList.add("N_hidden");
		
		formName.setAttribute("disabled", "true");
	} else {
		editName.classList.add("N_hidden");
		h2Name.classList.add("N_hidden");
		formName.removeAttribute("disabled");
		formName.classList.remove("N_hidden");
		saveBtn_name.classList.remove("N_hidden");
	}
});

editInfoBtn.addEventListener("click", function() {	
	if(editInfoBtn.classList.contains("on")){
		for(let n=0; n < formsInputs.length; n++){
			formsInputs[n].setAttribute("disabled", "true");
		}
		btnEnv.classList.remove("on");
		btnEnv.innerHTML = "Editar";
		editInfoBtn.classList.remove("on");
	} else {
		editInfoBtn.classList.add("on");
		btnEnv.classList.add("on");
		btnEnv.innerHTML = "Cancelar";
		
		for(let n=0; n < formsInputs.length; n++){
			formsInputs[n].removeAttribute("disabled");
		}
	}
});

function delFav(del) {
	let cut = del.parentNode.innerHTML.split(" ", 3);
	let string = cut.toString().replaceAll(',', ' ');
	
	const favForm = document.querySelector(".favForm");
	const favSabor = document.getElementById("favSabor");

	favSabor.setAttribute("value", string);
	favForm.submit();
}