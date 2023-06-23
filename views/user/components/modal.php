<div class="modal fade modal-general" id="modal-add-user" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">
              <img src="../../assets/img/icons/square-plus.svg" alt="">
              Agregar nuevo usuario
            </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="../../controller/user.php?action=store" method="post" id="form-add-user" class="form-general">
            <label for="" class="title-i">Primer nombre <span>*</span></label>
            <label for="" class="title-i">Segundo nombre</label>
            <label for="" class="title-i">Primer apellido <span>*</span></label>
            <label for="" class="title-i">Segundo apellido</label>
            <div class="form-floating form-lotus">
                <input type="text" class="form-control" id="ft_name" placeholder="Primer nombre" name="ft_name" required>
                <label for="floatingInput">Primer nombre</label>
                <div id="validationServer03Feedback" class="invalid-feedback">
                    Ingrese un nombre válido
                </div>
            </div>
            <div class="form-floating form-lotus">
                <input type="text" class="form-control" id="sd_name" placeholder="Segundo nombre" name="sd_name">
                <label for="floatingInput">Segundo nombre</label>
                <div id="validationServer03Feedback" class="invalid-feedback">
                    Ingrese un nombre válido
                </div>
            </div>
            <div class="form-floating form-lotus">
                <input type="text" class="form-control" id="ft_lastname" placeholder="Primer apellido" name="ft_lastname" required>
                <label for="floatingInput">Primer apellido</label>
                <div id="validationServer03Feedback" class="invalid-feedback">
                    Ingrese un nombre válido
                </div>
            </div>
            <div class="form-floating form-lotus">
                <input type="text" class="form-control" id="st_lastname" placeholder="Segundo apellido" name="st_lastname">
                <label for="floatingInput">Segundo apellido</label>
                <div id="validationServer03Feedback" class="invalid-feedback">
                    Ingrese un nombre válido
                </div>
            </div>

            <label for="" class="title-i">Número de documento <span>*</span></label>
            <label for="" class="title-i"></label>
            <label for="" class="title-i">Dirección</label>
            <label for="" class="title-i"></label>
            <div class="form-floating form-lotus form-clm-tw">
                <input type="number" class="form-control" id="cedula" placeholder="Número de documento" name="cedula"  onkeydown="return event.keyCode !== 69">
                <label for="floatingInput">Número de documento</label>
                <div id="validationServer03Feedback" class="invalid-feedback">
                    Ingrese un telefóno válido
                </div>
            </div>
            <div class="form-floating form-lotus form-clm-th">
                <input type="text" class="form-control" id="address" placeholder="Dirección" name="address">
                <label for="floatingInput">Dirección</label>
                <div id="validationServer03Feedback" class="invalid-feedback">
                    Ingrese una dirección válida
                </div>
            </div>

            <label for="" class="title-i">Correo electrónico <span>*</span></label>
            <label for="" class="title-i"></label>
            <label for="" class="title-i"></label>
            <label for="" class="title-i">Número de telefónico<span>*</span></label>
            <div class="form-floating form-lotus form-cl-twh form-cl">
                <input type="email" class="form-control" id="email" placeholder="Email" name="email">
                <label for="floatingInput">Email</label>
                <div id="validationServer03Feedback" class="invalid-feedback">
                    Ingrese una correo válido
                </div>
            </div>
            <div class="form-floating form-lotus form-sele">
                <input type="number" class="form-control" id="phone" placeholder="Número telefónico" name="phone"  onkeydown="return event.keyCode !== 69">
                <label for="floatingInput">Número telefónico</label>
                <div id="validationServer03Feedback" class="invalid-feedback">
                    Ingrese un telefóno válido
                </div>
            </div>

            <label for="" class="title-i">Rol <span>*</span></label>
            <label for=""></label>
            <label for=""></label>
            <label for=""></label>
            <div class="form-floating form-lotus rol-form-ge">
                <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="role">
                    <option selected disabled>Elegir una opción</option>
                    <option value="1">Administrador</option>
                    <option value="4">Administrador con límites</option>
                    <option value="5">Cliente</option>
                    <option value="6">Empleado</option>
                </select>
                <label for="floatingSelect">Rol</label>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary" >Crear</button>
        </form>
      </div>
    </div>
  </div>
</div>



<!-- Notificacion usuario nuevo -->
<div class="toast-container position-fixed bottom-0 end-0 p-3">
  <div id="notiuseradd" class="toast toast-lotus" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
      <img src="../../assets/img/icons/lotus.svg" class="rounded me-2 img-lotus-toas" alt="...">
      <strong class="me-auto">Lotus</strong>
      <small>Ahora</small>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
      ¡Usuario creado con éxito!
    </div>
  </div>
</div>
<!-- Notificacion usuario nuevo -->


<!-- Modal eliminar usuario -->
<div class="modal modal-general modal-delete" tabindex="-1" id="modal-delete-user">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title">
            <img src="../../assets/img/icons/circle-trash.svg" alt="">
            Eliminar usuario
        </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>¿Seguro que quiere eliminar al siguiente usuario? <br> <b id="name-user-delete"></b>?</p>
      </div>
      <form action="../../controller/user.php?action=delete" method="post" id="form-delete-user">
        <input type="text" name="id" id="id_user_delete" style="display: none;">
      </form>
      <div class="modal-footer modal-foo-c">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-danger" id="btn-eliminar-user">Eliminar</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal eliminar usuario -->