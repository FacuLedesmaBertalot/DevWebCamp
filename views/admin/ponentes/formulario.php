<fieldset>
    <legend>Información Personal</legend>

    <div class="formulario__campo">
        <label for="nombre" class="formulario__label">Nombre</label>
        <input 
            type="text" 
            name="nombre" 
            id="nombre"
            class="formulario__input"
            placeholder="Nombre Ponente"
            value="<?php echo $ponente->nombre ?? '';?>"
            > 
    </div>

    <div class="formulario__campo">
        <label for="apellido" class="formulario__label">Apellido</label>
        <input 
            type="text" 
            name="apellido" 
            id="apellido"
            class="formulario__input"
            placeholder="Apellido Ponente"
            value="<?php echo $ponente->apellido ?? '';?>"
            > 
    </div>
    
</fieldset>