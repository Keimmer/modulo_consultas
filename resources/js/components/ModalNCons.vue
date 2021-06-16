<template>
  <Modal>
    <ModalHeader>
      <h3>Nueva Consulta Para el paciente N°:</h3>
    </ModalHeader>
    <ModalBody>
      <div class="my-4">
        <h4>Informacion Basica del Paciente:</h4>
        <p>
          Nombre y Apellido: <br />
          Cedula: <br />
          Edad: <br />
        </p>
      </div>
      <div class="my-4">
        <label for="">Especialidad Consulta</label>
        <select name="" class="form-control" id="">
          <option value="">Malestar General</option>
          <option value="">Cardiologia</option>
          <option value="">Oftalmologia</option>
        </select>
      </div>
      <div class="my-4">
        <label for="indicaciones">Sintomas</label>
        <input
          type="text"
          class="form-control"
          id="indicaciones"
          placeholder="Sintomas del Paciente"
        />
      </div>
      <div class="my-4">
        <label for="fecha">Habitos</label>
        <input
          type="text"
          class="form-control"
          id="fecha_expedicion"
          placeholder="Habitos del paciente"
        />
      </div>
      <div v-for="(habitos, habito) in habitos" :key="habito.habito_id">
        <div class="my-4">
          <label for="medicamentos">Procedimiento</label>
          <select
            v-model="habito.value"
            :key="index"
            class="form-control"
            name="medicamentos"
            id=""
          >
            <!-- <option
              v-for="procedimiento in procedimientos"
              :key="procedimiento.id_procedimiento"
              :v-model="procedimiento.id_procedimiento"
            >
              {{ procedimiento.nombre_procedimiento }}
            </option> -->
            <option value="">Temperatura</option>
            <option value="">Peso</option>
            <option value="">Presion Arterial</option>
          </select>
        </div>
        <div class="my-4">
          <label for="nombre_medicamento">Resultados</label>
          <input
            v-model="find.value2"
            :key="index"
            type="text"
            class="form-control"
            id="nombre_medicamento"
            placeholder="Resultado del procedimiento"
          />
        </div>
      </div>
      <button class="btn btn-primary" @click="addFind">
        Nuevo Procedimiento
      </button>
    </ModalBody>
    <ModalFooter>
      <button @click="close('Modal closed')" class="btn btn-primary">
        Cerrar
      </button>
      <!-- <button @click="dismiss('Modal dismissed')" class="btn btn-primary">Dismiss Modal</button> -->
    </ModalFooter>
  </Modal>
</template>

<script>
import Modal from "./Modals/Modal.vue";
import ModalHeader from "./Modals/ModalHeader.vue";
import ModalFooter from "./Modals/ModalFooter.vue";
import ModalBody from "./Modals/ModalBody.vue";
import ModalMixin from "./Modals/mixins/ModalMixin";
export default {
  components: { Modal, ModalHeader, ModalBody, ModalFooter },
  mixins: [ModalMixin],
  props: {
    data: {
      nombre: "",
    },
    consulta: {
      id_consulta: "",
      sintomas: "",
      habitos: "",

    },
  },
  methods: {

  },
};
</script>