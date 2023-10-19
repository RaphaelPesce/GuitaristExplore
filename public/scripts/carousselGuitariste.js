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