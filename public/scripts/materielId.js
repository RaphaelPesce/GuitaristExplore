// Mettre à jour id_materiel en fonction de la sélection du matériel
function updateMaterialId() {
    let categorie = document.querySelector('input[name="categorie"]:checked').value;
    let selectElement = document.querySelector('#' + categorie.toLowerCase() + 'Select');
    if (selectElement && selectElement.value) {
        document.getElementById('id_materiel').value = selectElement.value;
    }
}

// Attacher les écouteurs d'événements pour les sélections de matériel
document.getElementById('guitareSelect').addEventListener('change', updateMaterialId);
document.getElementById('amplificateurSelect').addEventListener('change', updateMaterialId);
document.getElementById('effetSelect').addEventListener('change', updateMaterialId);

// Appel initial pour définir la valeur correcte
updateMaterialId();


