const allCB = document.querySelectorAll("input[type='checkbox']");
const tipoEsp = document.getElementById("chevronEspecial");
const tipoNorm = document.getElementById("chevronNormal");
const tipoEsptxt = document.getElementById("txtEspecial");
const tipoNormtxt = document.getElementById("txtNormal");
const saboresEsp = document.querySelector(".filtroSabores.especiais");
const saboresNorm = document.querySelector(".filtroSabores.normais");
const allTitulo_tipo = document.querySelectorAll(".tituloTipo");
const allProdutos = document.querySelectorAll(".produto");
const allProdsabor = document.querySelectorAll(".saborProd");
const allProdnota = document.querySelectorAll(".notaProd");
const medidaInput = document.getElementById("medidaInput");
const resetMedidor = document.getElementById("resetMedidor");
const btnFiltrar = document.querySelector(".btnFiltrar");
const filtroAside = document.querySelector(".filtro_Aside");
const filtroBG = document.querySelector(".filtroBG");
var listaCB = [];

if(tipoEsp !== null){
	function expandeTipo(tipo) {
		tipo.addEventListener("click", () => {
			if(tipo.parentNode.parentNode.className == "tipoEspecial"){
				saboresEsp.classList.toggle("on");
				allTitulo_tipo[0].classList.toggle("on");
			}
			else { 
				saboresNorm.classList.toggle("on");
				allTitulo_tipo[1].classList.toggle("on");
			}
		});
	};

	expandeTipo(tipoEsp); 
	expandeTipo(tipoNorm);
	expandeTipo(tipoEsptxt);
	expandeTipo(tipoNormtxt);
}

function clickCB(cb) {
	cbValue = cb.value;
	lastWord = cbValue.split(' ').pop();
	
	if(cb.checked){
		listaCB.push(lastWord);
		for(var n=0; n < allProdutos.length; n++){
			if(listaCB.includes(allProdsabor[n].value)){
				try {
					allProdsabor[n].parentNode.classList.remove("hiddenCB");
				} catch{};
			}else{
				allProdsabor[n].parentNode.classList.add("hiddenCB");
			};
		};
	} else {
		listaCB = listaCB.filter(e => e !== lastWord)
		for(let n=0; n < allProdutos.length; n++){
			if(listaCB.includes(allProdsabor[n].value)){
				allProdsabor[n].parentNode.classList.remove("hiddenCB");
			}else{
				allProdsabor[n].parentNode.classList.add("hiddenCB");
			};
		};
	};
	
	if(listaCB == ""){
		for(let n=0; n < allProdutos.length; n++){
			allProdsabor[n].parentNode.classList.remove("hiddenCB");		
		};
	};
};

function checaNota(nota) {
	resetMedidor.setAttribute("data-state", "on");
	for(let n=0; n < allProdnota.length; n++){
		if(nota.value < allProdnota[n].value){
			allProdnota[n].parentNode.classList.add("hiddenRange");		
		}else{
			allProdnota[n].parentNode.classList.remove("hiddenRange");	
		}
	}
}

resetMedidor.addEventListener("click", function () {
	medidaInput.value = 1;
	for(let n=0; n < allProdnota.length; n++){
		try{
			allProdnota[n].parentNode.classList.remove("hiddenRange");	
		} catch {}
	}
	resetMedidor.setAttribute("data-state", "off");
});

btnFiltrar.addEventListener("click", () => {
	if(!btnFiltrar.classList.contains("on")){
		modalLockin();
	}else{
		modalUnlock();
	}
	btnFiltrar.classList.toggle("on");
	filtroAside.classList.toggle("show");
	filtroBG.classList.toggle("on");
	
});

window.addEventListener("scroll", function() {
    btnFiltrar.classList.toggle("sticky", window.scrollY > 110);
	filtroAside.classList.toggle("sticky", window.scrollY > 110);
});

filtroBG.addEventListener("click", () => btnFiltrar.dispatchEvent(simulaClique));

window.addEventListener("resize", (e) => {
    if (window.innerWidth > 768 && btnFiltrar.classList.contains("on")){
		btnFiltrar.dispatchEvent(simulaClique);
	}
});