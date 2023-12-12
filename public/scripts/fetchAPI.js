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



document.getElementById('guitaristeSelect').addEventListener('change', function () {
    loadEquipementForGuitariste(this.value);
});

var defaultGuitaristId = document.getElementById('guitaristeSelect').value;
if (defaultGuitaristId) {
    loadEquipementForGuitariste(defaultGuitaristId);
}

document.getElementById('equipementSelect').addEventListener('change', function () {
    updateHiddenInput(this.value);
});

function loadEquipementForGuitariste(id_guitariste) {
    fetch(`../public/index.php?controller=materiel&action=getMaterielForGuitariste&id=${id_guitariste}`)
        .then(response => response.json())
        .then(data => {
            updateEquipementSelect(data);
        })
        .catch(error => console.error('Error:', error));
}

function updateEquipementSelect(equipements) {
    const select = document.getElementById('equipementSelect');
    select.innerHTML = '';

    equipements.forEach(equipement => {
        const option = document.createElement('option');
        option.value = equipement.id_materiel;
        option.textContent = equipement.nom_materiel;
        select.appendChild(option);
    });

    if (equipements.length > 0) {
        updateHiddenInput(equipements[0].id_materiel);
    }
}

function updateHiddenInput(selectedEquipementId) {
    document.getElementById('id_materielReglage').value = selectedEquipementId;
}


// Ajout d'un écouteur d'événements sur le sélecteur d'équipement
document.getElementById('equipementSelect').addEventListener('change', function () {
    // Appel de la fonction pour vérifier si un réglage existe pour l'équipement et le guitariste sélectionnés
    checkReglageForMaterielAndGuitariste();
});

// Ajout d'un écouteur d'événements sur le sélecteur de guitariste
document.getElementById('guitaristeSelect').addEventListener('change', function () {
    // Appel de la fonction pour vérifier si un réglage existe pour l'équipement et le guitariste sélectionnés
    checkReglageForMaterielAndGuitariste();
});

// Fonction pour vérifier si un réglage existe pour un matériel et un guitariste donnés
function checkReglageForMaterielAndGuitariste() {
    // Récupération de l'ID du matériel sélectionné
    const id_materiel = document.getElementById('equipementSelect').value;
    // Récupération de l'ID du guitariste sélectionné
    const id_guitariste = document.getElementById('guitaristeSelect').value;

    // Vérification pour s'assurer qu'un matériel est sélectionné
    if (id_materiel) {
        // Appel de la fonction pour effectuer la vérification
        checkReglageForMateriel(id_materiel, id_guitariste);
    }
}

// Fonction pour envoyer une requête AJAX et vérifier l'existence d'un réglage
function checkReglageForMateriel(id_materiel, id_guitariste) {
    // Sélection de l'élément textarea pour les réglages
    const descriptionArea = document.getElementById('description');
    // Sélection de l'élément div pour afficher le message
    const messageDiv = document.getElementById('reglageMessage');

    // Désactiver temporairement le textarea
    descriptionArea.disabled = true;

    // Envoi d'une requête AJAX au serveur pour vérifier l'existence d'un réglage pour l'id_materiel et l'id_guitariste spécifiés
    fetch(`../public/index.php?controller=reglage&action=checkReglageForMateriel&id_materiel=${id_materiel}&id_guitariste=${id_guitariste}`)
        .then(response => response.json())
        .then(data => {
            // Réactiver le textarea
            descriptionArea.disabled = false;

            // Si un réglage existe pour le matériel et le guitariste sélectionnés
            if (data.hasReglage) {
                // Masquer le textarea
                descriptionArea.style.display = 'none';
                // Afficher le div du message
                messageDiv.style.display = 'block';
                // Définir le texte du message
                messageDiv.innerText = "Le matériel a déjà un réglage pour ce guitariste.";
            } else {
                // Sinon, afficher le textarea pour permettre la saisie d'un nouveau réglage
                descriptionArea.style.display = 'block';
                // Masquer le div du message
                messageDiv.style.display = 'none';
            }
        })
        .catch(error => {
            // Gestion des erreurs
            console.error('Error:', error);
            // Réactiver le textarea en cas d'erreur
            descriptionArea.disabled = false;
        });
}

