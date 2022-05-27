const cards = [];

function addons(addon){
    
    if (!addon.classList.toggle('clicked')){
        cards.splice(cards.indexOf(addon.id),1);
    } else {
        cards.push(addon.id);
    }
    
}

function confirmer(src) {
    
        if (cards != []){
            src += '?addons=' + cards.join(','); 
        }
        window.location.href = src;
}