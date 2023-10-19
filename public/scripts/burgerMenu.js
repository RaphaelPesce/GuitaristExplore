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












