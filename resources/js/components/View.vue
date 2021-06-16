<template>
    <div v-if="modalVerPersona" id="vista" class="modal" :class="{ mostrar: verPer }">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Consulta</h4>
            <button
              @click="cerrarModal()"
              type="button"
              class="close"
              data-dismiss="modal"
            >
              &times;
            </button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <div class="my-4">
              <label for="nombre">Nombre</label>
              
            </div>
            <div class="my-4">
              <label for="apellido">Apellido</label>
              
            </div>
            <div class="my-4">
              <label for="cedula">Cedula</label>
             
            </div>
            <div class="my-4">
              <label for="direccion">direccion</label>
              
            </div>
            <div class="my-4">
              <label for="telefono">telefono</label>
              
            </div>
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <button
              @click="cerrarModal()"
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal"
            >
              Cancelar
            </button>
          </div>
        </div>
      </div>
    </div>
</template>
<script>
export default {
  data() {
      return {
            modalVerPersona: false,
            verPer: 0,
      }
  },
}

</script>
<style>
.mostrar {
  display: list-item;
  opacity: 1;
  background: rgba(75, 56, 143, 0.705);
}
</style>