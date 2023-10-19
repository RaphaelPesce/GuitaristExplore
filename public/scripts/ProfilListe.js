//--------------------------------------------  LISTE DEROULANTE GUITARISTES POUR MAJ DANS PROFIL  -----------------------------------------------

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
document.querySelector('#updateGuitaristeButton').addEventListener('click', updateGuitariste);
document.querySelector('#updateMaterielButton').addEventListener('click', updateMateriel);
document.querySelector('#updateReglageButton').addEventListener('click', updateReglage);

