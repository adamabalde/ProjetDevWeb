document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('profil-link').addEventListener('click', function () {
        showSection('profil');
    });

    document.getElementById('entreprises-link').addEventListener('click', function () {
        showSection('entreprises');
    });

    document.getElementById('sujets-link').addEventListener('click', function () {
        showSection('sujets');
    });

    function showSection(sectionId) {
        var sections = document.querySelectorAll('.content-section');
        sections.forEach(function (section) {
            section.style.display = 'none';
        });

        document.getElementById(sectionId).style.display = 'block';
    }
});
document.addEventListener('DOMContentLoaded', () => {
    const postulerButtons = document.querySelectorAll('.btn-postuler');
    const choisirButtons = document.querySelectorAll('.btn-choisir');

    postulerButtons.forEach(button => {
        button.addEventListener('click', () => {
            const url = button.getAttribute('data-url');
            if (url) {
                window.location.href = url;
            }
        });
    });

    choisirButtons.forEach(button => {
        button.addEventListener('click', () => {
            const confirmAction = confirm("Voulez-vous vraiment choisir ce sujet?");
            if (confirmAction) {
                alert("Vous avez choisi ce sujet.");
            } else {
                alert("Action annulée.");
            }
        });
    });
});
