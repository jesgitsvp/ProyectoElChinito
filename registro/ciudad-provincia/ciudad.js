const ciudadSelect = document.getElementById('ciudad');
const provinciaSelect = document.getElementById('provincia');
const ciudadesProvincias = {
    ica: ['Chincha', 'Pisco', 'Ica', 'Palpa', 'Nazca'],
    lima: ['Miraflores', 'Breña'],
};

ciudadSelect.addEventListener('change', function () {
    console.log('Cambio de ciudad detectado'); 
    const ciudadSeleccionada = ciudadSelect.value.toLowerCase(); // Convertir a minúsculas
    const provincias = ciudadesProvincias[ciudadSeleccionada] || [];

    provinciaSelect.innerHTML = '';

    for (const provincia of provincias) {
        const option = document.createElement('option');
        option.value = provincia;
        option.text = provincia;
        provinciaSelect.appendChild(option);
    }
});
