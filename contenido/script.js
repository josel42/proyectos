document.getElementById('formulario').addEventListener('submit', function(event) {
    event.preventDefault();
    var formData = new FormData(this);
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'guardar_contenido.php', true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            alert('Contenido guardado exitosamente');
            document.getElementById('formulario').reset();
        } else {
            alert('Hubo un error al guardar el contenido');
        }
    };
    xhr.send(formData);
});
