
// Définir la valeur par défaut pour l'ID du guitariste
var defaultGuitaristId = document.getElementById('guitaristeSelect').value;
document.getElementById('id_guitariste_new_material').value = defaultGuitaristId;

// Définir la valeur par défaut pour la catégorie
var defaultCategory = document.querySelector('input[name="categorie"]:checked').value;
document.getElementById('categorie_new_material').value = defaultCategory;

document.getElementById('guitaristeSelect').addEventListener('change', function () {
    document.getElementById('id_guitariste_new_material').value = this.value;
});

document.querySelectorAll('input[name="categorie"]').forEach(input => {
    input.addEventListener('change', function () {
        document.getElementById('categorie_new_material').value = this.value;
        updateIdMaterielWhenReady();
    });
});

// Fonction pour vérifier si les options sont chargées
function areOptionsLoaded(selectElement) {
    return selectElement && selectElement.options && selectElement.options.length > 0;
}

// Fonction récursive pour mettre à jour l'id_materiel
function updateIdMaterielWhenReady() {
    var category = document.querySelector('input[name="categorie"]:checked').value;
    var selectElement;

    switch (category) {
        case "Guitare":
            selectElement = document.getElementById('guitareSelect');
            break;
        case "Amplificateur":
            selectElement = document.getElementById('amplificateurSelect');
            break;
        case "Effet":
            selectElement = document.getElementById('effetSelect');
            break;
    }

    if (areOptionsLoaded(selectElement)) {
        document.getElementById('id_materielExisting').value = selectElement.options[selectElement.selectedIndex].value;
    } else {
        // Réessayer après un court délai
        setTimeout(updateIdMaterielWhenReady, 100);
    }
}

// S'assurer que le DOM est entièrement chargé avant d'exécuter le script
document.addEventListener('DOMContentLoaded', function () {
    updateIdMaterielWhenReady();

    // Événements de changement pour les sélecteurs de matériel
    ['guitareSelect', 'amplificateurSelect', 'effetSelect'].forEach(selectId => {
        var selectElement = document.getElementById(selectId);
        if (selectElement) {
            selectElement.addEventListener('change', function () {
                updateIdMaterielWhenReady();
            });
        }
    });
});


