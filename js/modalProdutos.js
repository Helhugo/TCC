const modalProd = document.querySelector(".modalBgProd");
const closeBtnProd = document.getElementById("closeBtnProd");
const title = document.querySelector(".modalProd_name");
const price = document.querySelector(".modalProd_preco");
const nota = document.querySelector(".modalProd_nota");
const desc = document.querySelector(".modalProd_desc");
const img = document.querySelector(".modalProd_img");
const notaContainer = document.getElementById("notaContainer");
const reviewContainer = document.querySelector(".container_reviews");
const container_Criar = document.querySelector(".container_Criar");
const criarReview_Icon = document.getElementById("criarReview_Icon");
const produto = document.querySelectorAll(".produto");
const produtoImg = document.querySelectorAll(".prodImg");
const modalExit = document.querySelector(".modalExit");
const newSabor = document.getElementById("newSabor");
const reviews = document.querySelector(".reviews");
const hiddenFav = document.querySelector(".hiddenFav");

for(let n = 0; n < produto.length; n++){
	const thisBtnVM = produto[n].querySelector(".btnVer");
	produtoImg[n].addEventListener("click", function () {
		verMais(thisBtnVM);
	});
}

function fechaCriarFora() {
	if(container_Criar.classList.contains("on")){
		abreCriar();
	};
};

function verMais(v) {
	modalProd.classList.add("on");
	modalLockin();
	
	while (reviewContainer.firstChild) {
		reviewContainer.removeChild(reviewContainer.lastChild);
	}
	
	const inputNoReview = v.parentNode.parentNode.parentNode.querySelector(".inputNoReview");
	const infosGroup = document.querySelector(".infosGroup");
	
	if(inputNoReview){
		reviews.setAttribute("data-state", "noReview");
		
		let noReview = document.createElement("div");
		noReview.className = "noReview";
		
		let noReviewH2 = document.createElement("h2");
		noReviewH2.innerHTML = "Este produto ainda não possui nenhuma review. <br> <button>Seja o primeiro!</button>";
		
		noReview.appendChild(noReviewH2);
		reviewContainer.appendChild(noReview);
		
		noReviewH2.addEventListener("click", abreCriar);
	}
	else {
		reviews.setAttribute("data-state", "Reviews");
		const review = v.parentNode.parentNode.parentNode.querySelector(".hiddenReview");
		if(review.firstChild){
			const reviews_Array = Array.from(review.querySelectorAll("input"));
			const slice_num = 3;
			
			for(r = 0; r < reviews_Array.length; r += slice_num){
				const reviewDivido = reviews_Array.slice(r, r + slice_num);
				
				let perfil = document.createElement("div");
				perfil.className = "perfil";
				
				let divNotaPerfil = document.createElement("div");
				divNotaPerfil.className = "divNotaPerfil";
				
				let notaPerfilNum = document.createElement("h2");
				notaPerfilNum.innerHTML = reviewDivido[2].value;
				
				let notaPerfil = document.createElement("i");
				notaPerfil.className = "fa-solid fa-star";
				
				let divPerfil_txt = document.createElement("div");
				divPerfil_txt.className = "perfilTxts";
				let perfilNome = document.createElement("h2");
				perfilNome.innerHTML = reviewDivido[0].value;
				let perfilTxt = document.createElement("h3");
				perfilTxt.innerHTML = reviewDivido[1].value;
				
				divPerfil_txt.appendChild(perfilNome);
				divPerfil_txt.appendChild(perfilTxt);
				divNotaPerfil.appendChild(notaPerfilNum);
				divNotaPerfil.appendChild(notaPerfil);
				perfil.appendChild(divNotaPerfil);
				perfil.appendChild(divPerfil_txt);
				reviewContainer.appendChild(perfil);
				
			}
		}
	}
	
	const infos = v.parentNode.parentNode.parentNode.querySelectorAll(".modalInfo");
	const imgName = v.parentNode.parentNode.parentNode.querySelector(".modalInfo_img").src;

	while (notaContainer.firstChild) {
		notaContainer.removeChild(notaContainer.lastChild);
	}
	notaContainer.style.animation = "none";
	
	if(infos[0].innerHTML == 1){
		notaContainer.style.borderRadius = "100vw";
	}else{
		notaContainer.style.borderRadius = "";
	}
	
	for(let n=0; n < infos[0].innerHTML; n++){
		let stars = document.createElement("i");
		stars.className = "fa-solid fa-star";
		stars.setAttribute("editable", "off");
		notaContainer.appendChild(stars);
		stars.addEventListener("animationend", () => notaContainer.style.animation = "borderAnimation 1s ease-in-out forwards");
	}
	

	img.src = imgName;
	title.innerHTML = infos[1].innerHTML;
	desc.innerHTML = infos[2].innerHTML;
	price.innerHTML = infos[3].innerHTML;
	nota.innerHTML = infos[0].innerHTML;
	
	if(newSabor){
		newSabor.value = infos[1].innerHTML.split(' ').slice(0, -1).pop();
	}
}

closeBtnProd.addEventListener("click", function () {
	modalProd.setAttribute("data-state", "closing");
	modalUnlock();
	fechaCriarFora()
	setTimeout(function(){
		modalProd.classList.remove("on");
		modalProd.setAttribute("data-state", "closed");
	}, 1000);
});

function checaClickforaProd(click) {
  if (click.target !== this) return;
  else{
	modalProd.setAttribute("data-state", "closing");
	modalUnlock();
	fechaCriarFora()
	setTimeout(function(){
		modalProd.classList.remove("on");
		modalProd.setAttribute("data-state", "closed");
	}, 1000);
  };
};

modalProd.addEventListener("click", checaClickforaProd);
modalExit.addEventListener("click", checaClickforaProd);

//Criar Review

function abreCriar() {
	const container_reviews = document.querySelector(".container_reviews");
	const notaCriar = document.querySelector(".notaContainer_Criar");
	const stars = document.querySelectorAll(".notaContainer_Criar i");
	
	if(reviews.classList.contains("disable_after")){
		reviews.classList.remove("disable_after");
	} else {
		reviews.classList.add("disable_after");
	}
	criarReview_Icon.className = container_Criar.classList.toggle("on") ? "fa-solid fa-times-circle" : "fa-solid fa-pencil";
	
	if(container_reviews.classList.contains("disabled")){
		container_reviews.classList.remove("disabled");
	} else {
		setTimeout(function(){
			container_reviews.classList.add("disabled");
		}, 300);
	}
	
	if (container_Criar.classList.contains("on")) {
		notaContainer.classList.add("off");
		if (notaCriar) {
			notaCriar.classList.add("on");
		}

		for(let i=0; i < stars.length; i++){
				
			stars[i].addEventListener('mouseenter', (e) => {
				let curr = 0;	
				stars[i].classList.add("hovered");
				while(stars[curr] != stars[i]){
					stars[curr].classList.add("hovered");
					curr += 1;
				}
			});
			stars[i].addEventListener('mouseleave', (e) => {
				let curr = 0;
				stars[i].classList.remove("hovered");
				while(stars[curr] != stars[i]){
					stars[curr].classList.remove("hovered");
					curr += 1;
				}
			});
		};

		stars.forEach((star, i) => {
			if (star.getAttribute("editable") !== "on") {
				star.setAttribute("editable", "on");
			}

			// Adicionar evento de clique apenas uma vez para cada estrela
			if (!star.dataset.clickEventAdded) {
				star.addEventListener('click', () => handleStarClick(stars, i));
				star.dataset.clickEventAdded = true;
			}
		});

	} else {
		try {
			newNota.value = "";
			userText.value = "";
		} catch (error) {}

		notaContainer.classList.remove("off");
		if (notaCriar) {
			notaCriar.classList.remove("on");
		}

		for(let n=0; n < stars.length; n++){
			stars[n].setAttribute("editable", "off");
			if(stars[n].classList.contains("clicked")){
				stars[n].classList.remove("clicked");
			}
		}
	}
}

// Função para tratar o clique nas estrelas
function handleStarClick(stars, index) {
	const newNota = document.getElementById("newNota");
	const clickedStar = stars[index];
	const rating = index + 1;

	if (clickedStar.classList.contains("clicked")) {
		// Se a estrela já estiver clicada, desmarque as estrelas subsequentes
		for (let j = index; j < stars.length; j++) {
			stars[j].classList.remove("clicked");
		}
		newNota.value = 0;
	} else {
		// Marque as estrelas até o índice clicado
		for (let j = 0; j <= index; j++) {
			stars[j].classList.add("clicked");
		}
		newNota.value = rating;
	}
}

function abreLogar(){
	modalProd.dispatchEvent(simulaClique);
	setTimeout(function(){
		if(window.innerWidth <= 840){
			modalLockin();
			newLogin_modal.classList.add("on");
		}else {
			logarBtn.dispatchEvent(simulaClique);
		}
	}, 700);
}