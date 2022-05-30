const modal = document.getElementById("myModal");


const btn = document.getElementById("verifier");


const span = document.getElementsByClassName("close")[0];


function verifier(id,prix) {
  event.preventDefault();
  let idType = document.getElementById('idType');
  idType.setAttribute('value',id);
  let prixInput = document.getElementById('prix');
  prixInput.setAttribute('value',prix);
  modal.style.display = "block";
}


span.onclick = function() {
  modal.style.display = "none";
}

window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
} 