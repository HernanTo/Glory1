<div class="modal modal-general" tabindex="-1" id="err_img_prod">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body modal_erro_img">
        <img src="../../assets/img/icons/remove.png" alt="">
        <h4>ERROR</h4>
        <p>Debe adjuntar solo imágenes</p>
      </div>
      <div class="modal-footer foo-modal-err">
        <button type="button" class="btn btn-secondary close-modal-err" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Notificacion Producto nuevo -->
<div class="toast-container position-fixed bottom-0 end-0 p-3">
  <div id="notiprodadd" class="toast toast-lotus" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
      <img src="../../assets/img/icons/lotus.svg" class="rounded me-2 img-lotus-toas" alt="...">
      <strong class="me-auto">Lotus</strong>
      <small>Ahora</small>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
      ¡Producto creado con éxito!
    </div>
  </div>
</div>
<!-- Notificacion Producto nuevo -->


<!-- Modal eliminar producto -->
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
        <p>¿Seguro que quiere eliminar el siguiente producto? <br> <b id="product-user-delete"></b>?</p>
      </div>
      <form action="../../controller/product.php?action=delete" method="post" id="form-delete-user">
        <input type="text" name="product_user_delete" id="product_user_delete" style="display: none;">
      </form>
      <div class="modal-footer modal-foo-c">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-danger" id="btn-eliminar-user">Eliminar</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal eliminar producto -->

<!-- Notificacion Producto nuevo -->
<div class="toast-container position-fixed bottom-0 end-0 p-3">
  <div id="notiprodelete" class="toast toast-lotus" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
      <img src="../../assets/img/icons/lotus.svg" class="rounded me-2 img-lotus-toas" alt="...">
      <strong class="me-auto">Lotus</strong>
      <small>Ahora</small>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
      ¡Producto eliminado con éxito!
    </div>
  </div>
</div>
<!-- Notificacion Producto nuevo -->