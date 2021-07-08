<template>
  <Modal>
    <ModalHeader>
      <h3 class="modal-title">
        Recipe del paciente N°: P_{{ data.persona.id_persona }}
      </h3>
    </ModalHeader>
    <ModalBody>
      <div class="row">
        <div class="col my-4">
          <h4>Informacion Basica del Paciente:</h4>
          <p>
            Nombre y Apellido: {{ data.persona.nombre }}
            {{ data.persona.apellido }}<br />
            Cedula: V-{{ data.persona.cedula }}<br />
            Edad: {{ data.persona.edad }}<br />
          </p>
        </div>
        <div class="col my-4">
          <h4>Detalles Tratamiento</h4>
          <p>
            Tratamiento N°: T_{{ data.tratamiento.id_tratamientos }} <br />
            Tipo de Tratamiento: {{ data.tratamiento.tipo_tratamiento }} <br />
            Medico Encargado: {{ data.tratamiento.mednombre }}
            {{ data.tratamiento.medapellido }}
          </p>
        </div>
      </div>

      <div class="card my-4 purplegradient">
        <div class="card-body">
          <h4 class="card-title">Recipe N°: R_{{ data.recipe.id_recipe }}</h4>
          <h5>Fecha Expedicion: {{ data.recipe.fecha_expedicion }}</h5>
          <div class="row mt-4">
            <div class="col-sm-9">
              <h4>Medicamentos e Indicaciones</h4>
              <p v-for="medicamento in data.medicamentos.data">
                <strong>Medicamento:</strong> {{ medicamento.medicamento }}
                <br />
                <strong>Tipo Medicamento:</strong>
                {{ medicamento.tipo_medicamento }} <br />
                <strong>Indicaciones:</strong> {{ medicamento.indicaciones }}
              </p>
            </div>
          </div>
        </div>
      </div>
    </ModalBody>
    <ModalFooter>
      <button @click="close('Modal closed')" class="btn btn-primary">
        Cerrar
      </button>
      <button @click="edit" class="btn btn-warning">Editar Recipe</button>
      <button
        onclick="window.print();return false;"
        type="button"
        class="btn btn-success"
      >
        Imprimir Recipe
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
      console.log(this.data);
    },
    addMedicamento: function () {
      this.nuevoRecipe.medicamentosInd.push({ value: " " });
      console.log(this.nuevoRecipe.medicamentosInd);
    },
    edit() {
      this.close("Modal closed");
      ModalOpService.editrec(this.data.recipe.id_recipe);
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