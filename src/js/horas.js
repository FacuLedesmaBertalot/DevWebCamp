(function() {
    const horas = document.querySelector('#horas');

    if (horas) {

        const categoria = document.querySelector('[name="categoria_id"]');
        const dias = document.querySelectorAll('[name="dia"]');
        const inputHiddenDia = document.querySelector('[name="dia_id"]'); 
        const inputHiddenHora = document.querySelector('[name="hora_id"]'); 

        // Valores originales
        const diaOriginal = inputHiddenDia.value;
        const horaOriginal = inputHiddenHora.value;
        const categoriaOriginal = categoria.value;

        categoria.addEventListener('change', terminoBusqueda);
        dias.forEach(dia => dia.addEventListener('change', terminoBusqueda));

        let busqueda = {
            categoria_id: +categoria.value || '',
            dia: +inputHiddenDia.value || ''
        }

        if (!Object.values(busqueda).includes('')) {
            (async () => {
                await buscarEventos();
                const id = inputHiddenHora.value;

                const horaSeleccionada = document.querySelector(`#listado-horas li[data-hora-id="${id}"]`);
                
                if(horaSeleccionada) {
                    horaSeleccionada.classList.remove('horas__hora--deshabilitada');
                    horaSeleccionada.classList.add('horas__hora--seleccionada');
                    
                    horaSeleccionada.addEventListener('click', seleccionarHora);
                }
            })();
        }

        function terminoBusqueda(e) {
            busqueda[e.target.name] = e.target.value;

            // Reiniciar los campos ocultos (pero no los originales)
            inputHiddenHora.value = '';
            inputHiddenDia.value = ''; 
            
            const horaPrevia = document.querySelector('.horas__hora--seleccionada');
            if (horaPrevia) {
                horaPrevia.classList.remove('horas__hora--seleccionada');
            }

            if (Object.values(busqueda).includes('')) {
                return;
            }
            buscarEventos();
        }

        async function buscarEventos() {
            const { dia, categoria_id } = busqueda;
            const url = `/api/eventos-horario?dia_id=${dia}&categoria_id=${categoria_id}`;

            try {
                const resultado = await fetch(url);
                const eventos = await resultado.json();
                obtenerHorasDisponibles(eventos);
            } catch (error) {
                console.log(error);
            }
        }

        function obtenerHorasDisponibles(eventos) {
            // Reiniciar las horas
            const listadoHoras = document.querySelectorAll('#listado-horas li');
            listadoHoras.forEach(li => {
                li.classList.add('horas__hora--deshabilitada');
                li.removeEventListener('click', seleccionarHora); 
            });

            // Comprobar eventos ya tomados
            let horasTomadas = eventos.map(evento => evento.hora_id);

            // Verificar si estamos en día/categoría original para liberar mi propia hora
            if (String(busqueda.dia) === String(diaOriginal) && 
                String(busqueda.categoria_id) === String(categoriaOriginal)) {
                
                horasTomadas = horasTomadas.filter(horaId => String(horaId) !== String(horaOriginal));
            }
            
            const listadoHorasArray = Array.from(listadoHoras);
            const resultado = listadoHorasArray.filter( li => !horasTomadas.includes(li.dataset.horaId));
            
            resultado.forEach(li => {
                li.classList.remove('horas__hora--deshabilitada');
                li.addEventListener('click', seleccionarHora);
            });
        } 

        
        function seleccionarHora(e) {
            // Deshabilitar hora previa visualmente
            const horaPrevia = document.querySelector('.horas__hora--seleccionada');
            if (horaPrevia) {
                horaPrevia.classList.remove('horas__hora--seleccionada');
            }

            // Agregar clase de seleccionado
            e.target.classList.add('horas__hora--seleccionada');
            
            // Asignar al input hidden
            inputHiddenHora.value = e.target.dataset.horaId;

            // Llenar el campo oculto de dia (por si acaso se perdió la referencia)
            inputHiddenDia.value = document.querySelector('[name="dia"]:checked').value;
        }
    } 

})();