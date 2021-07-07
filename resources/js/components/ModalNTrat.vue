<template>
  <Modal>
    <ModalHeader>
      <h3 class="modal-title">
        Nuevo Tratamiento Para el paciente N°: P_{{ data.persona.id_persona }}
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
        <h4>Informacion Diagnostico</h4>
        <p>
          Diagnostico N° D_{{ data.diagnostico.id_diagnosticos }} <br>
          Fecha Diagnostico {{ data.diagnostico.fecha_diag}} <br>
          Patologia {{ data.diagnostico.nombre_patologia }}
        </p>
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
        <label for="">Seleccione el Tratamiento</label>
        <select name="" class="form-control" @change="getMedicosXEspecialidad" v-model="nuevoTratamiento.nombre_tratamiento">
          <option
            v-for="tipoTrat in data.tipos_trat.data"
            :key="tipoTrat.id_especialidad"
          >
            {{ tipoTrat.tipo_tratamiento }}
          </option>
        </select>
      </div>

      <div class="row mt-4">
        <div class="col-sm-9">
          <label>Medico Encargado</label>
          <select name="" class="form-control" v-model="nuevoTratamiento.medico">
            <option v-for="medico in medicos.data" :key="medico.id">
              {{ medico.mednom }} {{ medico.medap }}
            </option>
          </select>
        </div>
      </div>

      <div class="row mt-4">
        <div class="col-sm-9">
          <label>Seleccione fecha inicio del Tratamiento</label>
          <Datepicker 
            :bootstrap-styling="true"
            format="yyyy-MM-dd"
            :language="es"
            :value="fecha_inicio"       
            :disabled-dates="DisabledDates"
            @input="fecha_inicio = fixDate($event)"
          >
          </Datepicker>
        </div>
      </div>
      
      <div class="row mt-4">
        <div class="col-sm-9">
          <label>Seleccione fecha final del Tratamiento</label>
          <Datepicker 
            :bootstrap-styling="true"
            format="yyyy-MM-dd"
            :language="es"
            :value="fecha_fin"
            :disabled-dates="DisabledDates"
            @input="fecha_fin = fixDate($event)"
          >
          </Datepicker>
        </div>
      </div>
      
      <div class="row mt-4">
        <div class="col sm-9">
          <label>Ingrese El objetivo del tratamiento</label>
          <textarea class="form-control" cols="30" rows="10" v-model="nuevoTratamiento.objetivo"></textarea>
        </div>
      </div>
      
      <div class="row mt-4">
        <div class="col sm-9">
          <label>Ingrese los posibles riesgos del tratamiento</label>
          <textarea class="form-control" cols="30" rows="10" v-model="nuevoTratamiento.riesgos"></textarea>
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
      nuevoTratamiento: {
        id_diagnostico: "",
        nombre_tratamiento: "",
        fecha_inicio: "",
        fecha_fin: "",
        objetivo: "",
        riesgos: "",
        id_medico: "",
      },
      errors: [],
      medicos: [],
      en: en,
      es: es,
      fecha_inicio: Date.now(),
      fecha_fin: Date.now(),
      DisabledDates: {
        to: this.fechainicio(),
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
      medicos: [],
    },
    consulta: {
      id_consulta: "",
      sintomas: [],
      habitos: [],
    },
  },
  methods: {
    async showme() {
      if (
        this.nuevoTratamiento.nombre_tratamiento &&
        this.nuevoTratamiento.medico &&
        this.fecha_inicio &&
        this.fecha_fin &&
        this.nuevoTratamiento.objetivo &&
        this.nuevoTratamiento.riesgos
      ) {
        this.nuevoTratamiento.fecha_inicio = this.fecha_inicio;
        this.nuevoTratamiento.fecha_fin = this.fecha_fin;
        this.nuevoTratamiento.id_diagnostico =
          this.data.diagnostico.id_diagnosticos;
        var res = await axios.get("/getmed", {
          params: { nombre: this.nuevoTratamiento.medico },
        });
        this.nuevoTratamiento.id_medico = res.data;
        console.log(this.nuevoTratamiento);
        await axios.post("/tratamientos", this.nuevoTratamiento);
        this.close("Modal closed");
        this.$toast("Nuevo Tratamiento Guardado Exitosamente!");
      }
      if (!this.nuevoTratamiento.nombre_tratamiento) {
        this.$toast.error('El Tipo de Tratamiento es obligatorio.');
      }
      if (!this.nuevoTratamiento.medico) {
        this.$toast.error('El medico para el tratamiento es obligatorio.');
      }
      if(!this.fecha_inicio) {
        this.$toast.error('La fecha de inicio del tratamiento es obligatoria.');
      }
      if(!this.fecha_fin) {
        this.$toast.error('La fecha final del tratamiento es obligatoria.');
      }
      if (!this.nuevoTratamiento.objetivo) {
        this.$toast.error('El objetivo del tratamiento es obligatorio.');
      }
      if (!this.nuevoTratamiento.riesgos) {
        this.$toast.error('Los posibles riesgos del tratamiento son obligatorios.')
      }
    },
    fechainicio() {
      return new Date(moment(this.fecha_inicio).toDate());
    },
    async getMedicosXEspecialidad() {
      this.medicos = await axios.get("/esptrat", {
        params: { tipo_tratamiento: this.nuevoTratamiento.nombre_tratamiento },
      });
      console.log(this.medicos.data);
    },
    fixDate(event) {
      return moment(event).format("YYYY-MM-DD");
    },
    startDisabled() {
      return this.fecha_inicio;
    },
  },
  computed: {},
};
</script>

<style>
</style>