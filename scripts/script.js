function toggleInputs() {
   
    const tipo = document.getElementById('tipo').value;
    const categoriaSelect = document.getElementById('categoriaElegida');
    const idJuegoInput = document.getElementById('id_juego');


    if (tipo === 'categoria') {
        idJuegoInput.disabled = true; // Habilita el input de ID Juego
        categoriaSelect.disabled = false; // Bloquea el select de Categoría
        categoriaSelect.value = ''; // Limpia el valor de categoría
    } else {
        idJuegoInput.disabled = false; // Bloquea el input de ID Juego
        idJuegoInput.value = ''; // Limpia el valor
        categoriaSelect.disabled = true; // Habilita el select de Categoría
    }

}