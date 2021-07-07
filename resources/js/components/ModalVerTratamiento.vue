<template>
  <Modal>
    <ModalHeader>
      <h3 class="modal-title">
        Tratamiento Para el paciente N°: P_{{ data.persona.id_persona }}
      </h3>
    </ModalHeader>
    <ModalBody>
      <div class="my-4">
        <h4>Informacion Basica del Paciente:</h4>
        <p>
          Nombre y Apellido: {{ data.persona.nombre }} {{ data.persona.apellido
          }}<br />
          Cedula: V-{{ data.persona.cedula }}<br />
          Edad: {{ data.persona.edad }}<br />
        </p>
      </div>
      <div class="my-4">
        <h4>Detalles Tratamiento</h4>
        <p>
          Tratamiento N°: T_{{ data.tratamiento.id_tratamientos }} <br />
          Tipo de Tratamiento: {{ data.tratamiento.tipo_tratamiento }} <br />
          Medico Encargado: {{ data.tratamiento.mednombre }}
          {{ data.tratamiento.medapellido }} <br />
          Fecha Inicio Tratamiento: {{ data.tratamiento.fecha_inicio }} <br />
          Fecha Fin Tratamiento: {{ data.tratamiento.fecha_fin }} <br />
        </p>
      </div>

      <h5>Objetivos y riesgos del Tratamiento</h5>
      <div class="row">
        <div class="col m-2 card lb-gradient">
          <div class="card-body">
            <h5 class="card-title">Objetivos</h5>
            <p class="card-text">{{ data.tratamiento.objetivo }}</p>
          </div>
        </div>
        <div class="col m-2 card lb-gradient">
          <div class="card-body">
            <h5 class="card-title">Riesgos</h5>
            <p class="card-text">{{ data.tratamiento.riesgos }}</p>
          </div>
        </div>
      </div>
    </ModalBody>
    <ModalFooter>
      <button @click="close('Modal closed')" class="btn btn-primary">
        Cerrar
      </button>
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
  data() {
    return {
      nuevoRecipe: {
        id_tratamiento: "",
        medicamentosInd: [],
      },
      sintomas: [],
      habitos: [],
      procesos: [],
      especialidad: "",
    };
  },
  props: {
    especialidades: "",
    sintomasArr: "",
    habitosArr: "",
    procesosArr: "",
    data: {
      nombre: "",
      medicamentos: [],
    },
    consulta: {
      id_consulta: "",
      sintomas: [],
      habitos: [],
    },
  },
};
</script>

<style>
.lb-gradient {
  background: -webkit-gradient(
    linear,
    left top,
    right top,
    from(#78e6ff),
    to(#78efff)
  );
  background: linear-gradient(to right, #5ad3ff, #85f7ff);
  color: rgb(0, 0, 0);
}
</style>