<template>
  <Modal>
    <ModalHeader>
      <h3 class="modal-title">
        Editar Consulta N°: C_{{ data.consulta[0].id_consulta }}
      </h3>
    </ModalHeader>
    <ModalBody>
      <div class="row">
        <div class="col">
          <div class="card bluegradient" style="width: 18rem">
            <div class="card-body">
              <h5 class="card-title">Datos del Paciente</h5>
              <h6>Nombres y Apellidos:</h6>
              <p>{{ data.persona.nombre }} {{ data.persona.apellido }}</p>
              <h6>Cedula:</h6>
              <p>{{ data.persona.cedula }}</p>
              <h6>Genero:</h6>
              <p>{{ data.persona.genero }}</p>
              <h6>Edad:</h6>
              <p>{{ data.persona.edad }}</p>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card greengradient" style="width: 18rem">
            <div class="card-body">
              <h5 class="card-title">Fecha de la Consulta</h5>
              <p class="card-text">{{ data.consulta[0].fecha_consulta }}</p>
              <h5 class="card-title">Especialidad de la consulta</h5>
              <p class="card-text">
                {{ data.consulta[0].nombre_especialidad }}
              </p>
              <h5 class="card-title">Sintomas del Paciente</h5>
              <p class="card-text" v-for="sintoma in getSintomas">
                {{ sintoma }}
              </p>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col">
          <div class="card yellowgradient" style="width: 18rem">
            <div class="card-body">
              <h5 class="card-title">Habitos del Paciente</h5>
              <p
                class="card-text"
                v-for="habito in getHabitos"
                :key="habito.id_habito"
              >
                {{ habito }}
              </p>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card redgradient" style="width: 18rem">
            <div class="card-body">
              <h5 class="card-title">Procedimientos en la Consulta</h5>
              <p
                class="card-text"
                v-for="(procedimiento, index) in getProcedimiento"
                :key="index"
              >
                {{ procedimiento }} {{ data.consulta[index].resultado }}
              </p>
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
                  v-for="procesosArr in data.procesos"
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
      <button @click="guardar()" class="btn btn-success">
        Guardar Cambios
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
  data () {
    return {
      nuevaConsulta: {
        id_paciente: "",
        sintomas: [],
        habitos: [],
        procesos: [],
        especialidad: "",
        edit: true,
      }
    }
  },
  props: {
    data: {},
    sintomasArr: "",
  },
  methods: {
    async guardar() {
      this.nuevaConsulta.id_consulta = this.data.consulta[0].id_consulta;
      console.log(this.nuevaConsulta);
      await axios.post("/consultas", this.nuevaConsulta);
      this.close('Modal closed');
      this.$toast('Consulta: C_'+ this.nuevaConsulta.id_consulta +' Editada Exitosamente!')
    },
    addProceso: function () {
      this.nuevaConsulta.procesos.push({ value: " " });
    },
  },
  computed: {
    getSintomas() {
      return uniq(this.data.consulta.map(({ sintoma }) => sintoma));
    },
    getHabitos() {
      return uniq(this.data.consulta.map(({ habito }) => habito));
    },
    getProcedimiento() {
      return uniq(this.data.consulta.map(({ proceso }) => proceso));
    },
  },
};
</script>

<style>
.bluegradient {
  background: -webkit-gradient(
    linear,
    left top,
    right top,
    from(#78a3ff),
    to(#5a84ee)
  );
  background: linear-gradient(to right, #7f8eff, #9fbdff);
  color: white;
}
.greengradient {
  background: -webkit-gradient(
    linear,
    left top,
    right top,
    from(#83ff78),
    to(#5aee5a)
  );
  background: linear-gradient(to right, #5aff5a, #85ff8f);
  color: white;
}
.yellowgradient {
  background: -webkit-gradient(
    linear,
    left top,
    right top,
    from(#ffb978),
    to(#f3934a)
  );
  background: linear-gradient(to right, #ffac53, #ffc085);
  color: white;
}
.redgradient {
  background: -webkit-gradient(
    linear,
    left top,
    right top,
    from(#ff7878),
    to(#ee5a5a)
  );
  background: linear-gradient(to right, #ff5a5a, #ff8585);
  color: white;
}
</style>