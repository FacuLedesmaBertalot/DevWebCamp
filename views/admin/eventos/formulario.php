<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Información Evento</legend>

    <div class="formulario__campo">
        <label for="nombre" class="formulario__label">Nombre Evento</label>
        <input
            type="text"
            name="nombre"
            id="nombre"
            class="formulario__input"
            placeholder="Nombre Evento">
    </div>

    <div class="formulario__campo">
        <label for="descripcion" class="formulario__label">Descripción</label>
        <textarea
            name="descripcion"
            id="descripcion"
            class="formulario__input"
            rows="8">
        </textarea>
    </div>

    <div class="formulario__campo">
        <label for="categoria" class="formulario__label">Categoría o Tipo de Evento</label>
        <select 
        class="formulario__select"
        id="categoria"
        name="categoria_id"
        >
            <option value="" selected disabled>-- Seleccionar --</option>
            <?php foreach ($categorias as $categoria) { ?>
                <option value="<?php echo $categoria->id; ?>">
                    <?php echo $categoria->nombre; ?>
                </option>
            <?php } ?>
        </select>
    </div>




</fieldset>