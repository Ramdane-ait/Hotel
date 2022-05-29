const modal = document.getElementById("myModal");


const btn = document.getElementById("verifier");


const span = document.getElementsByClassName("close")[0];


function verifier(id) {
  event.preventDefault();
  let typeId = document.getElementById('typeId');
  typeId.setAttribute('value',id);
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