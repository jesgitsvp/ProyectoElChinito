
<script>
const toggleButton = document.querySelector('.toggle');
// Obtén una referencia al elemento con clase "profile"

// Agrega un controlador de eventos al botón de alternancia
toggleButton.addEventListener('click', function () {
    if (profileElement) {
        profileElement.style.visibility = profileElement.style.visibility === 'hidden' ? 'visible' : 'hidden';
    }
});

// Obtén una referencia al elemento con clase "profile"
const profileHeading = document.querySelector('.profile h4');
const profileDescription = document.querySelector('.profile p');

// Agrega un controlador de eventos al botón de alternancia
toggleButton.addEventListener('click', function () {
    if (profileHeading && profileDescription) {
        if (profileHeading.style.visibility === 'hidden' || profileHeading.style.visibility === '') {
            profileHeading.style.visibility = 'visible';
            profileDescription.style.visibility = 'visible';
        } else {
            profileHeading.style.visibility = 'hidden';
            profileDescription.style.visibility = 'hidden';
        }
    }
});
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</body>
