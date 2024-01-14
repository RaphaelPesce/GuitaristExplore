//------------------------------------------------------------------------  CHANGEMENT DE DATE DU COPYRIGHT FOOTER  ------------------------------------------------------------------

// Récupère l'année actuelle
const year = new Date().getFullYear();

// Récupère l'élément HTML avec l'ID "copyright"
const copyrightElement = document.querySelector("#copyright");

// Met à jour le texte de l'élément avec le copyright en utilisant l'année actuelle
copyrightElement.innerText = `Copyright © ${year} GuitaristExplore`;