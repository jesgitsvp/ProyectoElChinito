<script src="../admin/Menu/menu.js"></script>

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

</body>
<!-- Bootstrap JavaScript Libraries -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
</script>
</body>

</html>