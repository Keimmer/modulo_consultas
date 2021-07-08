<template>
  <Modal>
    <ModalHeader>
      <h3 class="modal-title">
        Diagnostico del paciente N°: P_{{ data.persona.id_persona }}
      </h3>
    </ModalHeader>
    <ModalBody>
      <div class="my-4">
        <h4>Datos del Paciente:</h4>
        <p>
          Nombre y Apellido: {{ data.persona.nombre }} {{ data.persona.apellido }}<br />
          Cedula: V-{{ data.persona.cedula }}<br />
          Edad: {{ data.persona.edad }}<br />
        </p>
      </div>
      <div class="my-4">
        <h4>Informacion Consulta</h4>
        <p>
          Consulta N°: C_{{ data.consulta[0].id_consulta }} <br>
          Fecha Consulta {{data.consulta[0].fecha_consulta}} <br>
          
        </p>
        <h5>Sintomas</h5>
          <p v-for="sintoma in getSintomas"><strong> Sintoma: </strong>{{sintoma}}</p>
      </div>

      <div class="my-4">
        <h4>Informacion Diagnostico</h4>
        <p>
          <strong>Diagnostico N°: </strong>D_{{ data.diagnostico.id_diagnosticos }} <br>
          <strong>Fecha Diagnostico: </strong>{{ data.diagnostico.fecha_diag}} <br>
          <strong>Patologia: </strong>{{ data.diagnostico.nombre_patologia }} <br>
          <strong>Codigo_CIE: </strong>{{ data.diagnostico.codigo_cie }} <br>
          <strong>Estado De Salud: </strong>{{ data.diagnostico.estado_de_salud }}
        </p>
      </div>

      
    </ModalBody>
    <ModalFooter>
      <button @click="close('Modal closed')" class="btn btn-primary">
        Cerrar
      </button>
      <button @click="edit" class="btn btn-warning">
        Editar Diagnostico
      </button>
      <button
        onclick="window.print();return false;"
        type="button"
        class="btn btn-success"
      >
        Imprimir Diagnostico
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
import ModalOpService from "./Modals/services/modal.opservice";
import uniq from "lodash/uniq";
//Toasty Notifications
import Toast from "vue-toastification";
// Import the CSS or use your own!
import "vue-toastification/dist/index.css";

const options = {
  // You can set your default options here
};

Vue.use(Toast, options);

export default {
  components: { Modal, ModalHeader, ModalBody, ModalFooter },
  mixins: [ModalMixin],
  data() {
    return {
      nuevoDiagnostico: {
        id_consulta: "",
        patologia: "",
        estadoDeSalud: "",
      },
      errors: [],
      sintomas: [],
      habitos: [],
      procesos: [],
      especialidad: "",
      codigoCIE: "",
    };
  },
  props: {
    especialidades: "",
    sintomasArr: "",
    habitosArr: "",
    procesosArr: "",
    data: {
      nombre: "",
    },
    consulta: {
      id_consulta: "",
      sintomas: [],
      habitos: [],
    },
  },
  methods: {
    edit() {
      this.close("Modal closed");
      ModalOpService.editdiag(this.data);
    },
  },
  computed: {
    getSintomas() {
      return uniq(this.data.consulta.map(({ sintoma }) => sintoma));
    },
  },
};
</script>

<style>
</style>