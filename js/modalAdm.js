const modalAdm = document.querySelector(".modalBgAdm");
const label = document.getElementById("labelFotoID");



function fechaCriarFora() {
	if(container_Criar.classList.contains("on")){
		abreCriar();
	};
};

function verMaisAdm(v) {
	modalAdm.classList.add("on");
	modalLockin();

}

closeBtnProd.addEventListener("click", function () {
	modalAdm.setAttribute("data-state", "closing");
	modalUnlock();
	fechaCriarFora()
	setTimeout(function(){
		modalAdm.classList.remove("on");
		modalAdm.setAttribute("data-state", "closed");
	}, 1000);
});

function checaClickforaProd(click) {
  if (click.target !== this) return;
  else{
	modalAdm.setAttribute("data-state", "closing");
	modalUnlock();
	fechaCriarFora()
	setTimeout(function(){
		modalAdm.classList.remove("on");
		modalAdm.setAttribute("data-state", "closed");
	}, 1000);
  };
};

modalAdm.addEventListener("click", checaClickforaProd);
modalExit.addEventListener("click", checaClickforaProd);

function preview() {
	frame.src = URL.createObjectURL(event.target.files[0]);
	label.style.display = "none";
}
