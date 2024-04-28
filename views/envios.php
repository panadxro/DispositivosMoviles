<div class="sect-comprar">
        <div id="formularioDatosPersonales">
          <form class="inicio" action="index.php?sec=recibo" method=POST id="datosPersonalesForm">
            <fieldset>
              <legend>Contacto</legend>
              <div class="entrada">
                <input name="email" placeholder="Email" id="email" type="email" required>
                <label for="email">Email</label>
              </div>
              <div>
                <input name="check" id="ofertas" type="checkbox">
                <label for="ofertas">Deseo recibir noticias y ofertas.</label>
              </div>
            </fieldset>
            <fieldset>
              <legend>Dirección de envío</legend>
              <div class="pais">
                <select name="pais" id="pais" required>
                  <option value="">Elije un país</option>
                  <option value="Alemania">Alemania</option>
                  <option value="Argentina">Argentina</option>
                  <option value="Australia">Australia</option>
                  <option value="Brasil">Brasil</option>
                  <option value="Estados Unidos">Estados Unidos</option>
                  <option value="Francia">Francia</option>
                  <option value="Reino Unido">Reino Unido</option>
                  <option value="Rusia">Rusia</option>
                </select>
              </div>
              <div class="entrada">
                <input name="nombre" placeholder="Nombre" id="nombre" type="text" required>
                <label for="nombre">Nombre</label>
              </div>
              <div class="entrada">
                <input name="apellido" placeholder="Apellido" id="apellido" type="text" required>
                <label for="apellido">Apellido</label>
              </div>
              <div class="entrada">
                <input name="direccion" placeholder="Dirección" id="direccion" type="text" required>
                <label for="direccion">Dirección</label>
              </div>
              <div class="entrada">
                <input name="ciudad" placeholder="Ciudad" id="ciudad" type="text" required>
                <label for="ciudad">Ciudad</label>
              </div>
              <div class="entrada">
                <input name="postal" placeholder="Codigo postal (opcional)" id="postal" type="text">
                <label for="postal">Codigo postal (opcional)</label>
              </div>
              <div class="entrada">
                <input name="telefono" placeholder="Teléfono" id="telefono" type="number" required>
                <label for="telefono">Teléfono</label>
              </div>
            </fieldset>
            <div class="form-submit">
              <a href="index.php" class="volver">Volver al inicio</a>
              <input class="boton" value="Enviar" type="submit">
            </div>
          </form>
        </div>
        </div>