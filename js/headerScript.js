const navSticky = document.getElementById("stickyNav");
const menuBurguer = document.querySelector(".menu-burguer");
const menuBurguerIn = document.querySelector(".menu-burguer .linhas");
const sideMenu = document.querySelector(".side-menu");
const Body = document.querySelector("body");
const logarBtn = document.querySelector(".logIn a");
const logBtn = document.querySelector(".logIn");
const modalLog = document.querySelector(".modalH");
const btnCanc = document.getElementById("btnCanc");
const xMark = document.getElementById("closeMenuBurguer");
const contaIcon = document.querySelectorAll(".contaIcon");
const modalInfo_conta = document.querySelector(".modalInfo_conta");
const newLogin_modal = document.querySelector(".newLogin_modal");
const closenewLogin_modal = document.getElementById("closeModal_login");
const loginInputs = document.querySelectorAll(".loginInputs");
const perfilBtn = document.getElementById("iconConta_logado");
const perfilTooltip = document.querySelector(".perfilTooltip");

const allAs = document.querySelectorAll(".navA");

function getCurrentPage() {
	const currentUrl = document.location.href;
	let filename = currentUrl.split("/").pop();
	
	if(filename == ""){
		filename = "index.php";
	}
	
	for(let n=0;n < allAs.length;n++){
		if(allAs[n].getAttribute("href") == filename){
			allAs[n].classList.add("Current");
		}
		else{
			allAs[n].classList.remove("Current");
		}
	}	
}

getCurrentPage();

//Simular clique
var simulaClique = new MouseEvent("click", {
    "view": window,
    "bubbles": true,
    "cancelable": false
});

//função para limpar inputs após fechar
function limpaInputs(inputs) {
	if(inputs){
		for(let n=0; n < inputs.length; n++){
			inputs[n].value = "";
		};
	};
};

//Funcao para fechar os modals clicando no xis dos mesmos
function xFecha_modal(xis, modal_name, btn_abre){
	xis.addEventListener("click", function () {
		modal_name.setAttribute("data-state", "closing");
		modalUnlock();
		setTimeout(function(){
			modal_name.classList.remove("on");
			modal_name.setAttribute("data-state", "closed");
		}, 500);
		
		try{
			if(loginInputs){
				limpaInputs(loginInputs);
			}
			if(cadInputs){
				limpaInputs(cadInputs);
			}
		}catch{};
	
		if(btn_abre === undefined){
			return;
		} else {
			btn_abre.classList.remove("on");
		};
		
	});
	
};

//Funcao para abrir e fechar os modals clicando no botao que abriu
function abre_fecha_modal(btn_abre, modal_name){
	btn_abre.addEventListener("click", function () {
		if(btn_abre.classList.contains("on")){
			modal_name.setAttribute("data-state", "closing");
			modalUnlock();
			setTimeout(function(){
				modal_name.classList.remove("on");
				modal_name.setAttribute("data-state", "closed");
			}, 500);
			btn_abre.classList.remove("on");
		}else {
			modalLockin();
			btn_abre.classList.add("on");
			modal_name.classList.add("on");
		}
	});
}


//EventListener para detectar toda vez que scrollar no site
window.addEventListener("scroll", function() {
    navSticky.classList.toggle("sticky", window.scrollY > 110);
    sideMenu.classList.toggle("sticky", window.scrollY > 110);
    sideMenu.style.setProperty('--top-position', window.scrollY + "px");
});


//Menu Buguer, abrir o side-menu
menuBurguerIn.addEventListener("click", function () {
	xMark.setAttribute("data-state", "on");
	
    sideMenu.setAttribute("data-state", "on");
    sideMenu.classList.add("on");  
    menuBurguerIn.classList.add("on");
    
    setTimeout(function(){
        menuBurguer.classList.add("on");
    }, 1000);
    
})


//Xis do header, fechar o side-menu
xMark.addEventListener("click", function () {
	setTimeout(function(){
            sideMenu.setAttribute("data-state", "off");
			menuBurguer.classList.remove("on");
    }, 900);
	 
    sideMenu.classList.remove("on");  
    menuBurguerIn.classList.remove("on");
	xMark.setAttribute("data-state", "off");
});


//Modal de logar
//function debounce para a pessoa nao ficar spammando o botao
function debounce(func, wait, immediate) {
    var timeout;
    return function() {
        var context = this, args = arguments;
        var later = function() {
            timeout = null;
            if (!immediate) func.apply(context, args);
        };
        var callNow = immediate && !timeout;
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
        if (callNow) func.apply(context, args);
    };
};

//função para checar se o clique foi no elemento, ou fora do mesmo
function checaClick(ev) {
  if (ev.target !== this) return;
  else{
	  if(perfilBtn){
		if(perfilBtn.classList.contains("on")){
			perfilTooltip.setAttribute("data-state", "closing");
			perfilTooltip.addEventListener("animationend", () => {
				perfilTooltip.classList.remove("on");
				perfilTooltip.setAttribute("data-state", "closed");
			}, {once:true});
		}
		
		if(perfilBtn.classList.contains("on") == false){
			perfilTooltip.classList.add("on");
		};
		
		perfilBtn.classList.toggle("on");
		return
	 };
	  //Clica fora modal de cadastro
	  if(modalCad.classList.contains("on")){
		closeBtnCad.dispatchEvent(simulaClique);
		return;
	  };
	  //Clica fora modal de erro
	  if(modalCadErro && modalCadErro.classList.contains("on")){
		closeBtnErro.dispatchEvent(simulaClique);
		return;
	  };
	   //Clica fora modal de login (telas menores) 
	  if(newLogin_modal.classList.contains("on")){
		closenewLogin_modal.dispatchEvent(simulaClique);
		return;
	  };
	  //Clica fora modal de info
	  if(contaIcon[0].classList.contains("on") || contaIcon[1].classList.contains("on")){
		  closeInfoModal.dispatchEvent(simulaClique);
		  return;
	  };
	  //Modal de Login (telas maiores) 
	  if(logarBtn){
		  if(logarBtn.classList.contains("on")){
				modalLog.setAttribute("data-state", "closing");
				modalLog.addEventListener("animationend", () => {
					modalLog.classList.remove("on");
					modalLog.setAttribute("data-state", "closed");
				}, {once:true});
			};
			
			if(logarBtn.classList.contains("on") == false){
				modalLog.classList.add("on");
			};
			
			logarBtn.classList.toggle("on");
			logBtn.classList.toggle("on");
			return;
	  };	 
  };
};

//variavel que junta o debounce com o checaClick
const debounced = debounce(checaClick, 200);

//Checa o click no botao de login
try{
	logarBtn.addEventListener("click", debounced);
}catch{};
//checa o click no botao de perfil
try{
	perfilBtn.addEventListener("click", debounced);
}catch{};

//Conta Icon
//variaveis
const closeInfoModal = document.getElementById("closeModal_conta");
const spanLink = document.querySelectorAll("span.link");

if(contaIcon[1]){
	//fecha modal info
	xFecha_modal(closeInfoModal, modalInfo_conta, contaIcon[0]);
	xFecha_modal(closeInfoModal, modalInfo_conta, contaIcon[1]);
	//fecha modal login (telas maiores)
	xFecha_modal(closenewLogin_modal, newLogin_modal);
	//abre ou fecha modal info clicando no botao de abrir
	abre_fecha_modal(contaIcon[0], modalInfo_conta);
	abre_fecha_modal(contaIcon[1], modalInfo_conta);

	//Link do modal info, esse abaixo é para mandar pro entrar
	spanLink[0].addEventListener("click", () => {
		closeInfoModal.dispatchEvent(simulaClique);
		if(window.innerWidth <= 840){
			modalLockin();
			newLogin_modal.classList.add("on");
		}else {
			logarBtn.dispatchEvent(simulaClique);
		}
	});

	//Link do modal info, esse abaixo é para mandar pro cadastrar
	spanLink[1].addEventListener("click", () => {
		closeInfoModal.dispatchEvent(simulaClique);
		btnCad.dispatchEvent(simulaClique);
	});

	//Linkando o click no modalInfo e modal de Login para mandar pro checaClick
	modalInfo_conta.addEventListener("click", checaClick);
	newLogin_modal.addEventListener("click", checaClick);
}
	

