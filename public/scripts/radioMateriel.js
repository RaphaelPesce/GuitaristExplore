document.querySelectorAll('input[name="categorie"]').forEach((input) => {
    input.addEventListener('change', function () {
        document.getElementById('guitareSelectDiv').style.display = 'none';
        document.getElementById('amplificateurSelectDiv').style.display = 'none';
        document.getElementById('effetSelectDiv').style.display = 'none';

        switch (this.value) {
            case 'Guitare':
                document.getElementById('guitareSelectDiv').style.display = 'block';
                break;
            case 'Amplificateur':
                document.getElementById('amplificateurSelectDiv').style.display = 'block';
                break;
            case 'Effet':
                document.getElementById('effetSelectDiv').style.display = 'block';
                break;
        }
    });
});