//--------------------------------------------------------  ONGLETS FICHE GUITARISTE  ------------------------------------------------------------

// Sélectionner tous les boutons d'onglet
let onglets = document.querySelectorAll('.onglet');

// Ajouter un gestionnaire d'événement clic à chaque bouton d'onglet
onglets.forEach(function (onglet, index) {
    onglet.addEventListener('click', function () {
        // Cacher tous les contenus d'onglets
        let contenusOnglets = document.querySelectorAll('.contenuOnglet');
        contenusOnglets.forEach(function (contenuOnglet) {
            contenuOnglet.style.display = 'none';
        });

        // Supprimer la classe 'actif' de tous les onglets
        onglets.forEach(function (onglet) {
            onglet.classList.remove('actif');
        });

        // Afficher le contenu de l'onglet sélectionné
        let contenuOnglet = document.querySelector('#contenuOnglet' + (index + 1));
        contenuOnglet.style.display = 'block';

        // Ajouter la classe 'actif' à l'onglet sélectionné
        onglet.classList.add('actif');
    });
});