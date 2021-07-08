<template>
  <Modal>
    <ModalHeader>
      <h3 class="modal-title">
        Consulta N°: C_{{ data.consulta[0].id_consulta }}
      </h3>
    </ModalHeader>
    <ModalBody>
      <div class="row">
        <div class="col">
          <div class="card bluegradiente">
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
          <div class="card purplegradient">
            <div class="card-body">
              <h5 class="card-title">Fecha de la Consulta</h5>
              <p class="card-text">{{ data.consulta[0].fecha_consulta }}</p>
              <h5 class="card-title">Especialidad de la consulta</h5>
              <p class="card-text">
                {{ data.consulta[0].nombre_especialidad }}
              </p>
              <h5 class="card-title"><strong>Sintomas del Paciente</strong></h5>
              <p v-for="sintoma in getSintomas">
                <strong>Sintoma:</strong> {{ sintoma }}
              </p>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col">
          <div class="card purplegradient">
            <div class="card-body">
              <h5 class="card-title"><strong>Habitos del Paciente</strong></h5>
              <p
                v-for="habito in getHabitos"
                :key="habito.id_habito"
              >
                Habito: {{ habito }}
              </p>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card bluegradiente">
            <div class="card-body">
              <h5 class="card-title">Procedimientos en la Consulta</h5>
              <p
                class="card-text"
                v-for="(procedimiento, index) in getProcedimiento"
                :key="index"
              >
               <strong>Procedimiento: </strong> {{ procedimiento }} <br> <strong>Resultado: </strong> {{ data.consulta[index].resultado }}
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
      <button @click="edit" class="btn btn-warning">Editar</button>
      <button
        onclick="window.print();return false;"
        type="button"
        class="btn btn-success"
      >
        Imprimir Consulta
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
import ModalOpService from "./Modals/services/modal.opservice";
import uniq from "lodash/uniq";
export default {
  components: { Modal, ModalHeader, ModalBody, ModalFooter },
  mixins: [ModalMixin],
  props: {
    data: {},
    sintomasArr: "",
  },
  methods: {
    ver() {
      console.log(this.data);
    },
    edit() {
      this.close("Modal closed");
      ModalOpService.editcons(this.data);
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
.bluegradiente {
  background: -webkit-gradient(
    linear,
    left top,
    right top,
    from(#4361ee),
    to(#4895ef)
  );
  background: linear-gradient(to right, #4361ee, #4895ef);
  color: white;
}
.purplegradient {
  background: -webkit-gradient(
    linear,
    left top,
    right top,
    from(#560bad),
    to(#b5179e)
  );
  background: linear-gradient(to right, #560bad, #b5179e);
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