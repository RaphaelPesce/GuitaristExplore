//-------------------------------------------------------------  MENU BURGER  --------------------------------------------------------------------

// Sélectionne l'icône du burger
const burgerIcon = document.querySelector('.burger-icon');

// Sélectionne la barre latérale
const sidebar = document.querySelector('.sidebar');

// Sélectionne tous les liens de la barre latérale
const links = document.querySelectorAll('.sidebar a');

// Ajoute un écouteur d'événement clic à l'icône du burger
burgerIcon.addEventListener('click', () => {
    // Ajoute ou supprime la classe 'open' de la barre latérale pour afficher ou masquer la sidebar
    sidebar.classList.toggle('open');
});

// Ajoute un écouteur d'événement clic à chaque lien de la barre latérale
links.forEach(link => {
    link.addEventListener('click', () => {
        // Supprime la classe 'open' de la barre latérale lorsqu'un lien est cliqué
        sidebar.classList.remove('open');
    });
});

// Ajoute un écouteur d'événement clic à l'ensemble du document
document.addEventListener('click', (event) => {
    const target = event.target;
    const isInsideSidebar = sidebar.contains(target);
    const isBurgerIcon = target.classList.contains('burger-icon');

    // Vérifie si l'élément cliqué se trouve à l'intérieur de la barre latérale ou s'il s'agit de l'icône du burger
    if (!isInsideSidebar && !isBurgerIcon) {
        // Supprime la classe 'open' de la barre latérale lorsque l'utilisateur clique à l'extérieur de celle-ci
        sidebar.classList.remove('open');
    }
});

//-------------------------------------------------------  CAROUSSEL FICHE GUITARISTE  -----------------------------------------------------------

// Sélectionne l'image principale du carrousel
const mainImage = document.querySelector('.carousel-main img');

// Sélectionne toutes les images miniatures et les convertit en un tableau
const thumbnails = Array.from(document.querySelectorAll('.carousel-thumbnails img'));

// Ajoute un écouteur d'événement clic à chaque image miniature
thumbnails.forEach((thumbnail, index) => {
    thumbnail.addEventListener('click', () => {
        // Définit la source de l'image principale avec la source de l'image miniature cliquée
        mainImage.src = thumbnail.src;

        // Supprime la classe 'active' de toutes les miniatures
        removeActiveClass();

        // Ajoute la classe 'active' à l'image miniature cliquée
        thumbnail.classList.add('active');
    });
});

// Fonction pour supprimer la classe 'active' de toutes les miniatures
function removeActiveClass() {
    thumbnails.forEach((thumbnail) => {
        thumbnail.classList.remove('active');
    });
}

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

//--------------------------------------------------  CHANGEMENT DE DATE DU COPYRIGHT FOOTER  ----------------------------------------------------

// Récupère l'année actuelle
const year = new Date().getFullYear();

// Récupère l'élément HTML avec l'ID "copyright"
const copyrightElement = document.querySelector("#copyright");

// Met à jour le texte de l'élément avec le copyright en utilisant l'année actuelle
copyrightElement.innerText = `Copyright © ${year} GuitaristExplore`;


//--------------------------------------------  LISTE DEROULANTE GUITARISTES POUR MAJ DANS PROFIF  -----------------------------------------------


// Fonction pour mettre à jour les informations d'un guitariste.
function updateGuitariste() {
    // On récupère l'élément de la page qui a l'ID 'guitaristeSelect'. C'est notre liste déroulante.
    let selectElement = document.querySelector('#guitaristeSelect');
    // On récupère la valeur de l'option actuellement sélectionnée dans la liste déroulante. C'est l'ID du guitariste.
    let guitaristeId = selectElement.value;
    // On redirige l'utilisateur vers la page de mise à jour du guitariste, en passant l'ID du guitariste en paramètre dans l'URL.
    window.location.href = "../public/index.php?controller=guitariste&action=updateGuitariste&id=" + guitaristeId;
}

// Fonction pour mettre à jour les informations du matériel d'un guitariste.
function updateMateriel() {
    // On récupère l'élément de la page qui a l'ID 'guitaristeSelect'. C'est notre liste déroulante.
    let selectElement = document.querySelector('#guitaristeSelect');
    // On récupère la valeur de l'option actuellement sélectionnée dans la liste déroulante. C'est l'ID du guitariste.
    let guitaristeId = selectElement.value;
    // On redirige l'utilisateur vers la page de mise à jour du matériel du guitariste, en passant l'ID du guitariste en paramètre dans l'URL.
    window.location.href = "../public/index.php?controller=materiel&action=updateMateriel&id=" + guitaristeId;
}

// Fonction pour mettre à jour les réglages d'un guitariste.
function updateReglage() {
    // On récupère l'élément de la page qui a l'ID 'guitaristeSelect'. C'est notre liste déroulante.
    let selectElement = document.querySelector('#guitaristeSelect');
    // On récupère la valeur de l'option actuellement sélectionnée dans la liste déroulante. C'est l'ID du guitariste.
    let guitaristeId = selectElement.value;
    // On redirige l'utilisateur vers la page de mise à jour des réglages du guitariste, en passant l'ID du guitariste en paramètre dans l'URL.
    window.location.href = "../public/index.php?controller=reglage&action=updateReglage&id=" + guitaristeId;
}

// Ajout des écouteurs d'événements une fois que le DOM est chargé
document.addEventListener('DOMContentLoaded', (event) => {
    document.querySelector('#updateGuitaristeButton').addEventListener('click', updateGuitariste);
    document.querySelector('#updateMaterielButton').addEventListener('click', updateMateriel);
    document.querySelector('#updateReglageButton').addEventListener('click', updateReglage);
});