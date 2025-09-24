// res/js/pms.js

document.addEventListener('DOMContentLoaded', () => {
    // Captura todos los enlaces que tienen la clase 'cambiaEstado-js'
    const statusLinks = document.querySelectorAll('.cambiaEstado-js');

    statusLinks.forEach(link => {
        link.addEventListener('click', (event) => {
            event.preventDefault(); // Evita que el enlace recargue la página

            // Obtiene los datos de los atributos 'data-*'
            const numeroHab = event.target.dataset.numero;
            const estadoActual = event.target.dataset.estadoActual;
            const estadoNuevo = event.target.dataset.estadoNuevo;

            // Llama a la función de cambio de estado
            cambiaEstadoHK(numeroHab, estadoActual, estadoNuevo);
        });
    });

    /**
     * Función que cambia el estado de una habitación.
     * En una aplicación real, aquí harías una llamada AJAX a una API.
     *
     * @param {string} numeroHab El número de la habitación.
     * @param {string} estadoActual El estado actual de la habitación.
     * @param {string} estadoNuevo El nuevo estado a aplicar.
     */

    function cambiaEstadoHK(habi, estado, cambio) {
        var web = $("#rutaweb").val();
        var pagina = $("#ubicacion").val();
        $.ajax({
            url: "res/php/cambiaEstadoHabitacion.php",
            type: "POST",
            data: {
                habi,
                cambio,
                estado,
            },
            success: function () {
                $(location).attr("href", "index.php");
            },
        });
    }
});