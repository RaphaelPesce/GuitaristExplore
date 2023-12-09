// Fonction pour charger le matériel disponible pour chaque catégorie
function loadAvailableMaterial(id_guitariste) {
    ['guitare', 'amplificateur', 'effet'].forEach(categorie => {
        fetch(`../public/index.php?controller=materiel&action=getAvailableMaterielForGuitariste&id=${id_guitariste}&categorie=${categorie}`)
            .then(response => response.json())
            .then(data => {
                let selectElement = document.getElementById(`${categorie}Select`);
                selectElement.innerHTML = data.map(item => `<option value="${item.id_materiel}">${item.nom_materiel}</option>`).join('');
            })
            .catch(error => console.error(`Error fetching ${categorie} material:`, error));
    });
}

// Écouteur d'événement pour le changement de sélection dans le menu déroulant des guitaristes
document.getElementById("guitaristeSelect").addEventListener("change", function () {
    loadAvailableMaterial(this.value);
});

// Fusion des fonctions window.onload
window.onload = function () {
    var defaultGuitarist = document.getElementById("guitaristeSelect").value;
    loadAvailableMaterial(defaultGuitarist);
};


