<template>
  <Modal>
    <ModalHeader>
      <h3 class="modal-title">
        Editar Tratamiento Para el paciente N°: P_{{ data.persona.id_persona }}
      </h3>
    </ModalHeader>
    <ModalBody>
      <div class="my-4">
        <h4>Informacion Basica del Paciente:</h4>
        <p>
          Nombre y Apellido: {{ data.persona.nombre }} {{ data.persona.apellido }}<br />
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
          <label class="my-1">Seleccione fecha inicio del Tratamiento</label>
          <Datepicker
            :bootstrap-styling="true"
            format="yyyy-MM-dd"
            :language="es"
            :value="data.tratamiento.fecha_inicio"
            :disabled-dates="DisabledDates"
            @input="data.tratamiento.fecha_inicio = fixDate($event)"
          >
          </Datepicker>
          <label class="my-1">Seleccione fecha fin del Tratamiento</label>
          <Datepicker
            :bootstrap-styling="true"
            format="yyyy-MM-dd"
            :language="es"
            :value="data.tratamiento.fecha_fin"
            :disabled-dates="DisabledDates"
            @input="data.tratamiento.fecha_fin = fixDate($event)"
          >
          </Datepicker>
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
      <button @click="close('Modal closed')" class="btn btn-danger">
        Cerrar
      </button>
      <button @click="guardar" class="btn btn-primary">
        Guardar
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
import Datepicker from "vuejs-datepicker";
import moment from "moment";
import { en, es } from "vuejs-datepicker/dist/locale";
//Toasty Notifications
import Toast from "vue-toastification";
// Import the CSS or use your own!
import "vue-toastification/dist/index.css";

const options = {
  // You can set your default options here
};

Vue.use(Toast, options);

export default {
  components: { Modal, ModalHeader, ModalBody, ModalFooter, Datepicker },
  mixins: [ModalMixin],
  data() {
    return {      
      editedTratamiento: {
        fecha_inicio: "",
      },
      en: en,
      es: es,
      DisabledDates: {
        to: fechainicio(),
      },
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

  methods: {
    async guardar() {
        await axios.post("/tratamientos/" + this.data.tratamiento.id_tratamientos, { data: this.data.tratamiento, _method: 'put'});
        this.close('Modal closed');
        this.$toast('Tratamiento: T_' + this.data.tratamiento.id_tratamientos + ' Modificado Exitosamente!');
    },
    fixDate(event) {
      return moment(event).format("YYYY-MM-DD");
    },
    fechainicio() {
      return Date(moment(this.data.tratamiento.fecha_inicio).toDate());
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