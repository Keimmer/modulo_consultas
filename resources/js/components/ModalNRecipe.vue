<template>
  <Modal>
    <ModalHeader>
      <h3 class="modal-title">
        Nuevo Recipe Para el paciente N°: P_{{ data.persona.id_persona }}
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
          {{ data.tratamiento.medapellido }}
        </p>
      </div>

      <div class="row mt-4">
        <div class="col-sm-9">
          <label>Medicamentos</label>
          <button class="btn btn-primary" @click="addMedicamento">+</button>
          <div class="row">
            <div
              class="col col-md-9"
              v-for="MedInd in nuevoRecipe.medicamentosInd"
            >
              <label class="mt-2">Nombre Medicamento</label>
              <select
                class="form-control mb-2"
                name=""
                id="1"
                v-model="MedInd.value"
              >
                <option
                  v-for="(medicamento, index) in data.medicamentos.data"
                  :key="medicamento.medicamento"
                  @change="removeMed(index)"
                >
                  {{ medicamento.medicamento }}
                </option>
              </select>
              <label class="mt-2">Indicaciones</label>
              <input
                id="2"
                type="text"
                class="form-control mb-2"
                v-model="MedInd.indicaciones"
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
  methods: {
    async showme() {
      var err = 0;
      if (this.nuevoRecipe.medicamentosInd.length) {
        this.nuevoRecipe.medicamentosInd.forEach((medicamento) => {
          if (medicamento.value !== " " && medicamento.indicaciones) {
            console.log("ok");
          } else {
            this.$toast.error(
              "Cada medicamento debe estar seleccionado y tener las indicaciones correspondientes."
            );
            err++;
          }
        });
        if (err == 0) {
          this.nuevoRecipe.id_tratamiento =
          this.data.tratamiento.id_tratamientos;
          console.log(this.nuevoRecipe);
          await axios.post("/recipes", this.nuevoRecipe);
          this.close("Modal closed");
          this.$toast("Nuevo Recipe Registrado Exitosamente!");
        }
      } else {
        this.$toast.error("Debe agregar un medicamento como minimo.");
      }
    },
    addMedicamento: function () {
      this.nuevoRecipe.medicamentosInd.push({ value: " " });
      console.log(this.nuevoRecipe.medicamentosInd);
    },
    removeMed: function (index) {
      this.data.medicamentos.data.splice(index, 1);
    },
  },
};
</script>

<style>
</style>