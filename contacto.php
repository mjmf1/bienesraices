<?php 
 include './includes/templates/header.php';
 ?>

    <main class="contenedor seccion">
        <h1>contacto</h1>
        <picture>
            <source srcset="build/img/destacada3.webp" type="image/webp">
        <source srcset="build/img/destacada3.jpg" type="image/jpeg">
        <img loading="lazy" src="build/img/destacada3.jpg" alt="imagen destacada 3">
        </picture>
        <h2>Llene el formulario de Contacto</h2>

        <form action="" class="formulario">
            <fieldset>
                <legend>Información Personal</legend>

                <label for="nombre">Nombre</label>
                <input type="text" placeholder="Tu Nombre" id="nombre">

                <label for="email">E-MAIL</label>
                <input type="email" placeholder="Tu E-MAIL" id="email">

                <label for="teléfono">Nombre</label>
                <input type="number" placeholder="Tu teléfono" id="teléfono">

                <label for="mensaje">Mensaje:</label>
                <textarea name="" id="mensaje" cols="" rows="" placeholder="Tu mensaje"></textarea>

            </fieldset>

            <fieldset>
                <legend>Información sobre la propiedad</legend>
                <label for="opciones">Vende ó Compra:</label>
                <select name="" id="">
                    <option value="" disabled selected>--Selecciona--</option>
                    <option value="compra">Compra</option>
                    <option value="vende">Vende</option>
                </select>
                <label for="presupuesto">PRECIO O PRESUPUESTO</label>
                <input type="number" placeholder="Tu Precio o Presupuesto es" id="presupuesto">
            </fieldset>
            <fieldset>
                <legend>Información sobre la propiedad</legend>
                <p>Como desea ser contactado</p>
                <div class="forma-contacto">
                    <label for="contactar-teléfono">Teléfono</label>
                    <input name="contacto" type="radio" value="telefono" id="contactar-teléfono">

                    <label for="contactar-email">E-mail</label>
                    <input name="contacto" type="radio" value="email" id="contactar-email">
                </div>
                <p>Si eligió teléfono, elija la fecha y la hora</p>

                <label for="fecha">Fecha:</label>
                <input type="date" id="fecha">

                <label for="hora">Hora:</label>
                <input type="time" id="hora" min="8:00" max="17:00">

            </fieldset>
            <input type="submit" value="Enviar" class="boton-verde">
        </form>
    </main>

    <?php 
 include './includes/templates/footer.php';
 ?>