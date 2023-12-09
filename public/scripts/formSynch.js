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
    });
});
