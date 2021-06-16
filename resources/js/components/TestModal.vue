<template>
  <Modal>
    <ModalHeader>
      <h3>Detalles Paciente N°{{data.id_persona}} :</h3>
    </ModalHeader>
    <ModalBody>
      <h4>Nombres y Apellidos:</h4>
      <p>{{data.nombre}} {{data.apellido}}</p>
      <h4>Cedula:</h4>
      <p>{{data.cedula}}</p>
      <h4>Genero:</h4>
      <p>{{data.genero}}</p>
      <h4>Edad:</h4>
      <p>{{data.edad}}</p>
      <h4>Numero Telefonico:</h4>
      <p>{{data.telefono}}</p>
      <h4>Dirección:</h4>
      <p>{{data.direccion}}</p>
      <h4>Antecedentes Personales</h4>
      
    </ModalBody>
    <ModalFooter>
      <button @click="close('Modal closed')" class="btn btn-primary">Cerrar</button>
      <!-- <button @click="dismiss('Modal dismissed')" class="btn btn-primary">Dismiss Modal</button> -->
    </ModalFooter>
  </Modal>
</template>

<script>
import Modal from './Modals/Modal.vue';
import ModalHeader from './Modals/ModalHeader.vue';
import ModalFooter from './Modals/ModalFooter.vue';
import ModalBody from './Modals/ModalBody.vue';
import ModalMixin from './Modals/mixins/ModalMixin';
export default {
  components: { Modal, ModalHeader, ModalBody, ModalFooter },
  mixins: [ModalMixin],
  props: {
    data: {
      nombre: ""
    }
  },
  methods: {
    
  }
}
</script>