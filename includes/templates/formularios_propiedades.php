
      <fieldset>
         <legend>Información General</legend>

         <label for="titulo">Titulo:</label>
         <input type="text" id="titulo" name="titulo" placeholder="Titulo de la Propiedad" value="<?php echo s($propiedad->titulo); ?>">

         <label for="precio">Precio:</label>
         <input type="number" id="precio" name="precio" placeholder="Precio de la Propiedad" value="<?php echo s($propiedad->precio); ?>"

         <label for="imagen">Imagen:</label>
          <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">

          <?php if($propiedad->imagen){ ?>
            <img src="/bienesraices/imagenes/<?php echo $propiedad->imagen?>" class="imagen-small" alt="imagen">
          <?php } ?>

         <label for="descripcion">descripción:</label>
         <textarea id="descripcion" name="descripcion"><?php echo s($propiedad->descripcion); ?></textarea>

      </fieldset>

      <fieldset>
         <legend>Información Propiedades</legend>

         <label for="habitaciones">Habitaciones:</label>
         <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej:5" min="1" max="6" value="<?php echo s($propiedad->habitaciones); ?>">

         <label for="wc">Baños:</label>
         <input type="number" id="wc" name="wc" placeholder="Ej:2" min="1" max="4" value="<?php echo s($propiedad->wc); ?>">

         <label for="estacionamiento">Estacionamiento:</label>
         <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Ej:3" min="1" max="3" value="<?php echo s($propiedad->estacionamiento); ?>">

      </fieldset>

      <fieldset>
         <legend>Vendedor</legend>

      </fieldset>