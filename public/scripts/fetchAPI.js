// RECUPERATION LISTE MATERIEL PAR GUITARISTE VIA FETCH API

// Fonction qui récupère et affiche le matériel d'un guitariste spécifié par son ID
function fetchGuitaristEquipment(id_guitariste) {
    // Utilisation de la Fetch API pour obtenir les détails du matériel pour le guitariste spécifié
    fetch(`../public/index.php?controller=materiel&action=getMaterielForGuitariste&id=${id_guitariste}`)
        .then(response => {
            // Vérification si la requête a réussi
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            // Conversion de la réponse en JSON
            return response.json();
        })
        .then(data => {
            // Récupération de la div où la liste du matériel sera affichée
            var materielDiv = document.getElementById("materielList");
            // Réinitialisation du contenu de la div
            materielDiv.innerHTML = "";
            // Parcours des éléments reçus pour ajouter chaque élément de matériel à la div
            data.forEach(materiel => {
                materielDiv.innerHTML += `<p>${materiel.nom_materiel}</p>`;
            });
        })
        .catch(error => {
            // En cas d'erreur avec l'opération de récupération, affichage de l'erreur dans la console
            console.error('There was a problem with the fetch operation:', error.message);
        });
}

// Écouteur d'événement pour le changement de sélection dans le menu déroulant des guitaristes
document.getElementById("guitaristeSelect").addEventListener("change", function () {
    // Appel de la fonction pour afficher le matériel du guitariste sélectionné
    fetchGuitaristEquipment(this.value);
});

// Fonction exécutée au chargement de la page
window.onload = function () {
    // Récupération de l'ID du guitariste actuellement sélectionné dans la liste déroulante
    var defaultGuitarist = document.getElementById("guitaristeSelect").value;
    // Appel de la fonction pour afficher le matériel du guitariste par défaut
    fetchGuitaristEquipment(defaultGuitarist);
};
