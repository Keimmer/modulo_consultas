<template>
  <Modal>
    <ModalHeader>
      <h3 class="modal-title">
        Nuevo Diagnostico Para el paciente N°: P_{{ data.persona.id_persona }}
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
          Consulta N°{{ data.consulta[0].id_consulta }} <br>
          Fecha Consulta {{data.consulta[0].fecha_consulta}} <br>
          Sintomas <br>
        </p>
          <p v-for="sintoma in getSintomas">{{sintoma}}</p>
      </div>
      <div class="my-4">
        <p v-if="errors.length">
        <b>Por favor, corrija el(los) siguiente(s) error(es):</b>
        <ul>
          <li v-for="error in errors">{{ error }}</li>
        </ul>
        </p>
      </div>
      <div class="my-4">
        <label for="">Patologia</label>
        <select name="" class="form-control" id="" v-model="nuevoDiagnostico.patologia">
          <option
            v-for="patologia in data.patologias.data"
            :key="patologia.id_especialidad"
          >
            {{ patologia.nombre_patologia }}
          </option>
        </select>
        <p>{{ codigoCIE }}</p>
      </div>

      <div class="row mt-4">
        <div class="col-sm-9">
          <label>Estado De Salud</label>
          <input type="text" class="form-control" v-model="nuevoDiagnostico.estadoDeSalud">
        </div>
      </div>

      
    </ModalBody>
    <ModalFooter>
      <button @click="close('Modal closed')" class="btn btn-primary">
        Cerrar
      </button>
      <button @click="showme" class="btn btn-success">Guardar</button>
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
    async showme() {
      if(this.nuevoDiagnostico.patologia && this.nuevoDiagnostico.estadoDeSalud) {
        this.nuevoDiagnostico.id_consulta = this.data.consulta[0].id_consulta;
        console.log(this.nuevoDiagnostico);
        await axios.post("/diagnosticos", this.nuevoDiagnostico);
        this.close('Modal closed');
        this.$toast('Nuevo Diagnostico Registrado Exitosamente!');
      }

      if (!this.nuevoDiagnostico.patologia) {
        this.errors.push('La patologia es obligatorio.');
      }
      if (!this.nuevoDiagnostico.estadoDeSalud) {
        this.errors.push('El estado de salud es obligatorio.');
      }
    },
    addSintoma: function () {
      this.nuevaConsulta.sintomas.push({ value: " " });
      console.log(this.nuevaConsulta.sintomas);
    },
    addHabito: function () {
      this.nuevaConsulta.habitos.push({ value: " " });
      console.log(this.nuevaConsulta.habitos);
    },
    addProceso: function () {
      this.nuevaConsulta.procesos.push({ value: " " });
      console.log(this.nuevaConsulta.procesos);
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