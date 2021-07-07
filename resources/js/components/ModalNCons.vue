<template>
  <Modal>
    <ModalHeader>
      <h3 class="modal-title">
        Nueva Consulta Para el paciente N°: P_{{ data.id_persona }}
      </h3>
    </ModalHeader>
    <ModalBody>
      <div class="my-4">
        <h4>Informacion Basica del Paciente:</h4>
        <p>
          Nombre y Apellido: {{ data.nombre }} {{ data.apellido }}<br />
          Cedula: V-{{ data.cedula }}<br />
          Edad: {{ data.edad }}<br />
        </p>
      </div>
      <div class="my-4">
        <h4 class="my-2">Especialidad Consulta</h4>
        <select name="" class="form-control" id="" v-model="especialidad">
          <option
            v-for="especialidad in especialidades.especialidades"
            :key="especialidad.id_especialidad"
          >
            {{ especialidad.nombre_especialidad }}
          </option>
        </select>
      </div>

      <div class="row mt-4">
        <div class="col-sm-9">
          <h4 class="my-2">Sintomas <button class="btn btn-primary ml-3" @click="addSintoma">+</button></h4>          
          <div class="row">
            <div class="col col-md-9" v-for="sintoma in nuevaConsulta.sintomas">
            <h6 class="my-2">Sintoma</h6>
              <select
                class="form-control mt-2"
                name=""
                id=""
                v-model="sintoma.value"
              >
                <option
                  v-for="sintomaArr in sintomasArr.sintomas"
                  :key="sintomaArr.id_sintoma"
                >
                  {{ sintomaArr.sintoma }}
                </option>
              </select>
            </div>
          </div>
        </div>
      </div>

      <div class="row mt-4">
        <div class="col-sm-9">
          <h4 class="my-2">Habitos <button class="btn btn-primary ml-3" @click="addHabito">+</button></h4>          
          <div class="row">
            <div class="col col-md-9" v-for="habito in nuevaConsulta.habitos">
              <h6 class="my-2">Habito</h6>
              <select
                class="form-control mt-2"
                name=""
                id=""
                v-model="habito.value"
              >
                <option
                  v-for="habitoArr in habitosArr.habitos"
                  :key="habitoArr.id_habito"
                >
                  {{ habitoArr.habito }}
                </option>
              </select>
            </div>
          </div>
        </div>
      </div>

      <div class="row mt-4">
        <div class="col-sm-9">
          <h4 class="my-2">Procedimientos <button class="btn btn-primary" @click="addProceso">+</button></h4>          
          <div class="row">
            <div class="col col-md-9" v-for="proceso in nuevaConsulta.procesos">
              <h6 class="my-2">Procedimiento</h6>
              <select
                class="form-control mt-2"
                name=""
                id=""
                v-model="proceso.value"
              >
                <option
                  v-for="procesosArr in procesosArr.procesos"
                  :key="procesosArr.id_procesos"
                >
                  {{ procesosArr.proceso }}
                </option>
              </select>
              <h6 class="my-2">Resultado</h6>
              <input
                type="text"
                class="form-control mt-2"
                v-model="proceso.resultado"
              />
            </div>
          </div>
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
      nuevaConsulta: {
        id_paciente: "",
        sintomas: [],
        habitos: [],
        procesos: [],
        especialidad: "",
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
    },
    consulta: {
      id_consulta: "",
      sintomas: [],
      habitos: [],
    },
  },
  methods: {
    async showme() {
      this.nuevaConsulta.id_paciente = this.data.id_persona;
      this.nuevaConsulta.especialidad = this.especialidad;
      await axios.post("/consultas", this.nuevaConsulta);
      this.close('Modal closed');
      this.$toast('Nueva Consulta Registrada Exitosamente!');
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
};
</script>

<style>
</style>