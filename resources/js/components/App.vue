<template>
  <div>
    <TabNav
      :tabs="[
        'Pacientes',
        'Consultas',
        'Diagnosticos',
        'Tratamientos',
        'Recipes',
      ]"
      :selected="selected"
      @selected="setSelected"
    >
      <Tab :isSelected="selected === 'Pacientes'">
        <p></p>
        <h1>Buscar Paciente</h1>
        <p>
          Para ver mas informacion del paciente que desea presione doble click
          sobre su nombre.
        </p>
        <div>
          <input
            type="text"
            name="cedula"
            @keyup="onTextChange()"
            class="form-control mb-4"
            v-model="cedula"
            placeholder="Buscar por Numero de Cedula"
          />
        </div>
        <!-- The table -->
        <!-- ------------------------------ -->
        <!-- ------------------------------ -->
        <!-- ------------------------------ -->
        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th>#</th>
              <th>Nombre</th>
              <th>Apellido</th>
              <th>Cedula</th>
              <th>Genero</th>
              <th>Edad</th>
              <!-- <th scope="col">Acciones</th> -->
            </tr>
          </thead>
          <tbody>
            <tr
              v-for="(persona, index) in personas"
              v-bind:style="{ '--index': index }"
              class="tr-anim"
              :key="persona.id_persona"
              @click="selectRow(persona)"
              @dblclick="addModal"
              :class="{ highlight: persona.id_persona == selectedUser }"
            >
              <td>P_{{ persona.id_persona }}</td>
              <td>{{ persona.nombre }}</td>
              <td>{{ persona.apellido }}</td>
              <td>{{ persona.cedula }}</td>
              <td>{{ persona.genero }}</td>
              <td>{{ persona.edad }}</td>
            </tr>
          </tbody>
        </table>
        <!-- ------------------------------ -->
        <!-- ------------------------------ -->
        <!-- End of the table -->
      </Tab>
      <Tab :isSelected="selected === 'Consultas'">
        <div class="row my-3">
          <div class="col">
            <PerfilPaciente
              v-if="selectedUser"
              :data="persona"
            ></PerfilPaciente>
            <button @click="nuevaConsulta" class="btn btn-success">
              Nueva Consulta
            </button>
          </div>
          <div class="col">
            <div class="mx-auto" style="width: 200px">
              <h5 class="text-center" style="margin-top: 40%">
                Abajo se muestra una tabla con todas las consultas de este
                paciente de no ser asi, usted podra crear una nueva consulta con
                el botón Nueva Consulta
              </h5>
            </div>
          </div>
        </div>
        <!-- <h4 v-if="selectedUser">Paciente Seleccionado: {{persona.nombre}} {{persona.apellido}} {{persona.cedula}}</h4> -->
        <!-- The table -->
        <!-- ------------------------------ -->
        <!-- ------------------------------ -->
        <!-- ------------------------------ -->
        <table v-if="consultas" class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col">Numero Consulta</th>
              <th scope="col">Fecha Consulta</th>
              <th scope="col">Medico De La Consulta</th>
              <th scope="col">Especialidad Consulta</th>
              <th scope="col">Cantidad de Procedimientos</th>
            </tr>
          </thead>
          <tbody>
            <tr
              v-for="(consulta, index) in consultas"
              v-bind:style="{ '--index': index }"
              class="tr-anim"
              :key="consulta.id_consulta"
              :ref="'ref_' + index"
              @mouseover="divDragOver($event, index)"
              @click="selectRowConsulta(consulta)"
              @dblclick="verConsulta"
              :class="{ highlightCons: consulta.id_consulta == selectedCons }"
            >
              <td scope="row">C_{{ consulta.id_consulta }}</td>
              <td scope="row">{{ consulta.fecha_consulta }}</td>
              <td scope="row">{{ consulta.nombre }} {{ consulta.apellido }}</td>
              <td scope="row">{{ consulta.nombre_especialidad }}</td>
              <td scope="row">{{ consulta.procedimientos }}</td>
            </tr>
          </tbody>
        </table>
        <!-- ------------------------------ -->
        <!-- ------------------------------ -->
        <!-- End of the table -->
      </Tab>
      <Tab :isSelected="selected === 'Diagnosticos'">
        <p></p>
        <div class="row my-3">
          <div class="col">
            <PerfilPaciente
              v-if="selectedUser"
              :data="persona"
            ></PerfilPaciente>
            <button
              @click="nuevoDiagnostico"
              type="button"
              class="btn btn-success"
            >
              Nuevo Diagnostico
            </button>
          </div>
          <div class="col">
            <div class="mx-auto" style="width: 200px">
              <h5 class="text-center" style="margin-top: 20%">
                Abajo se muestra una tabla con todos los diagnosticos de la
                consulta seleccionada perteneciente a este paciente, de no ser
                asi, usted podra crear un nuevo diagnostico con el botón Nuevo
                Diagnostico
              </h5>
            </div>
          </div>
        </div>
        <!-- The table -->
        <!-- ------------------------------ -->
        <!-- ------------------------------ -->
        <!-- ------------------------------ -->
        <table v-if="diagnosticos" class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col">Numero Consulta</th>
              <th scope="col">Numero Diagnostico</th>
              <th scope="col">Fecha Diagnostico</th>
              <th scope="col">Codigo CIE (Patologia)</th>
              <th scope="col">Estado de Salud</th>
            </tr>
          </thead>
          <tbody>
            <tr
              v-for="(diagnostico, index) in diagnosticos"
              v-bind:style="{ '--index': index }"
              class="tr-anim"
              :key="diagnostico.id_diagnosticos"
              @click="selectRowDiag(diagnostico)"
              @dblclick="verDiagnostico"
              :class="{
                highlightDiag: diagnostico.id_diagnosticos == selectedDiag,
              }"
            >
              <td>C_{{ selectedCons }}</td>
              <td>D_{{ diagnostico.id_diagnosticos }}</td>
              <td>{{ diagnostico.fecha_diag }}</td>
              <td>{{ diagnostico.codigo_cie }}</td>
              <td>{{ diagnostico.estado_de_salud }}</td>
            </tr>
          </tbody>
        </table>
        <!-- ------------------------------ -->
        <!-- ------------------------------ -->
        <!-- End of the table -->
      </Tab>
      <Tab :isSelected="selected === 'Tratamientos'">
        <p></p>
        <div class="row my-3">
          <div class="col">
            <PerfilPaciente
              v-if="selectedUser"
              :data="persona"
            ></PerfilPaciente>
            <button
              @click="nuevoTratamiento()"
              type="button"
              class="btn btn-success my-2"
            >
              Nuevo Tratamiento
            </button>
          </div>
          <div class="col">
            <div class="mx-auto" style="width: 200px">
              <h5 class="text-center" style="margin-top: 20%">
                Abajo se muestra una tabla con todos los diagnosticos de la
                consulta seleccionada perteneciente a este paciente, de no ser
                asi, usted podra crear un nuevo diagnostico con el botón Nuevo
                Diagnostico
              </h5>
            </div>
          </div>
        </div>
        <!-- The table -->
        <!-- ------------------------------ -->
        <!-- ------------------------------ -->
        <!-- ------------------------------ -->
        <table v-if="tratamientos" class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col">Numero Diagnostico</th>
              <th scope="col">Numero Tratamiento</th>
              <th scope="col">Fecha Inicio</th>
              <th scope="col">Fecha Fin</th>
              <th scope="col">Medico Encargado</th>
            </tr>
          </thead>
          <tbody>
            <tr
              v-for="(tratamiento, index) in tratamientos"
              v-bind:style="{ '--index': index }"
              class="tr-anim"
              :key="tratamiento.id"
              @click="selectRowTrat(tratamiento)"
              @dblclick="verTratamiento"
              :class="{
                highlightTrat: tratamiento.id_tratamientos == selectedTrat,
              }"
            >
              <td>D_{{ selectedDiag }}</td>
              <td>T_{{ tratamiento.id_tratamientos }}</td>
              <td>{{ tratamiento.fecha_inicio }}</td>
              <td>{{ tratamiento.fecha_fin }}</td>
              <td>{{ tratamiento.mednombre }} {{ tratamiento.medapellido }}</td>
            </tr>
          </tbody>
        </table>
        <!-- ------------------------------ -->
        <!-- ------------------------------ -->
        <!-- End of the table -->
      </Tab>
      <Tab :isSelected="selected === 'Recipes'">
        <p></p>
        <div class="row my-3">
          <div class="col">
            <PerfilPaciente
              v-if="selectedUser"
              :data="persona"
            ></PerfilPaciente>
            <button
              @click="
                modificar = false;
                nuevoRecipe();
              "
              type="button"
              class="btn btn-success my-2"
            >
              Nuevo Recipe
            </button>
          </div>
          <div class="col">
            <div class="mx-auto" style="width: 200px">
              <h5 class="text-center" style="margin-top: 30%">
                Abajo se muestra una tabla con todos los recipes del tratamiento
                seleccionado de no ser asi, puede oprimir el boton de nuevo
                recipe para ingresar los datos de un nuevo recipe en el
                formulario
              </h5>
            </div>
          </div>
        </div>
        <!-- The table -->
        <!-- ------------------------------ -->
        <!-- ------------------------------ -->
        <!-- ------------------------------ -->
        <table v-if="recipes" class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col">Numero Tratamiento</th>
              <th scope="col">Numero Recipe</th>
              <th scope="col">Fecha Expedicion</th>
              <th scope="col">Cantidad De Medicamentos</th>
            </tr>
          </thead>
          <tbody>
            <tr
              v-for="(recipe, index) in recipes"
              v-bind:style="{ '--index': index }"
              class="tr-anim"
              :key="recipe.id_recipe"
              @click="selectRowRecipe(recipe)"
              @dblclick="verRecipe(selectedRecipe)"
              :class="{ highlightRecipe: recipe.id_recipe == selectedRecipe }"
            >
              <td>T_{{ recipe.id_tratamientos }}</td>
              <td>R_{{ recipe.id_recipe }}</td>
              <td>{{ recipe.fecha_expedicion }}</td>
              <td>{{ recipe.medicamentos }}</td>
            </tr>
          </tbody>
        </table>
        <!-- ------------------------------ -->
        <!-- ------------------------------ -->
        <!-- End of the table -->
      </Tab>
    </TabNav>

    <ModalRoot></ModalRoot>
  </div>
</template>
<script>
import TabNav from "./TabNav.vue";
import Tab from "./Tab.vue";
import ModalRoot from "./Modals/ModalRoot.vue";
import ModalOpService from "./Modals/services/modal.opservice";
import TestModal from "./TestModal.vue";
//Modales Consultas//
import ModalNCons from "./ModalNCons.vue";
import ModalVerConsulta from "./ModalVerConsulta.vue";
import ModalEditarConsulta from "./ModalEditConsulta.vue";
//Modales Diagnosticos//
import NuevoDiagnostico from "./ModalNDiagnostico.vue";
import ModalVerDiagnostico from "./ModalVerDiagnostico.vue";
import ModalEditarDiagnostico from "./ModalEditDiagnostico.vue";
//Modales Tratamiento//
import ModalNuevoTratamiento from "./ModalNTrat.vue";
import ModalVerTratamiento from "./ModalVerTratamiento.vue";
import ModalEditTratamiento from "./ModalEditTrat.vue";
//Modales Recipes//
import ModalNuevoRecipe from "./ModalNRecipe.vue";
import ModalVerRecipe from "./ModalVerRecipe.vue";
import ModalEditarRecipe from "./ModalEditarRecipe.vue";
import ModalService from "./Modals/services/modal.service";
import PerfilPaciente from "./PerfilPaciente.vue";
//Toasty Notifications
import Toast from "vue-toastification";
// Import the CSS or use your own!
import "vue-toastification/dist/index.css";

const options = {
  // You can set your default options here
};

Vue.use(Toast, options);

export default {
  name: "App",
  components: { TabNav, Tab, ModalRoot, PerfilPaciente },
  data() {
    return {
      cedula: "",
      data: {
        key: "",
      },
      selected: "Pacientes",
      persona: {
        id_persona: "",
        nombre: "",
        apellido: "",
        cedula: "",
        direccion: "",
        telefono: "",
      },
      medico: {
        nombre: "Cistina",
        apellido: "Lopez",
      },
      consulta: {
        fecha_consulta: "xx/xx/xxxx",
        sintomas: "xxxxxx",
        habitos: "asd",
      },
      diagnostico: {
        id_diagnosticos: "",
      },
      tratamiento: {
        tipo_tratamiento: "xxxxxxx",
        fecha_inicio: "zzxxx",
        fecha_fin: "xxxzzz",
      },
      recipe: {
        indicaciones: "xxxxxxx",
        fecha_expedicion: "zzxxx",
        nombre_tipo_med: "xxxzzz",
      },
      medicamentos: {
        medicamento: "",
        tipo_medicamento: "",
      },
      verConsultaObj: {
        persona: "",
        consulta: "",
      },
      nuevoTratObj: {
        id_diag: "",
        tipos_trat: "",
      },
      nuevoRecipeObj: {},
      verRecipeObj: {},
      verDiagObj: {},
      id: 0,
      id_pers: 0,
      tablerow: false,
      modificar: true,
      porCedula: false,
      porNombre: false,
      cednom: 0,

      viewConsulta: false,
      vista: 0,

      modal: 0,
      verPer: 0,
      top: 0,
      left: 0,

      personas: [],
      selectedUser: null,
      consultas: [],
      consultass: [],
      diagnosticos: [],
      tratamientos: [],
      recipes: [],
      medicamentoss: [],
      finds: [],
      especialidades: [],
      sintomas: [],
      habitos: [],
      procesos: [],
      perced: "",
      selectedPersona: "",
      selectedCons: "",
      selectedDiag: "",
      selectedTrat: "",
      selectedRecipe: "",
    };
  },

  created() {
    ModalOpService.$on("editcons", ({ data }) => {
      this.editarConsulta();
    });
    ModalOpService.$on("editdiag", ({ data }) => {
      this.editarDiagnostico();
    });
    ModalOpService.$on("edittrat", ({ data }) => {
      this.editarTratamiento();
    });
    ModalOpService.$on("editrec", ({ data }) => {
      this.editarRecipe();
    });

    this.listarPers();
  },

  methods: {
    divDragOver(e, i) {
      let [div] = this.$refs["ref_" + i];
      let top = div.getBoundingClientRect().top;
      this.top = top;
      console.log(this.top);
    },
    async selectRowConsulta(consulta) {
      /* some styling positions */
      console.log(this.top);
      /* ////////////////////// */
      this.selectedCons = consulta.id_consulta;
      const resCons = await axios.get("/consultas", {
        params: { selectedCons: this.selectedCons },
      });
      this.consulta = resCons.data;
      console.log(this.consulta);
    },

    selectRowDiag(diagnostico) {
      this.selectedDiag = diagnostico.id_diagnosticos;
      this.diagnostico = diagnostico;
      console.log(this.selectedDiag);
    },

    selectRowTrat(tratamiento) {
      this.selectedTrat = tratamiento.id_tratamientos;
      this.tratamiento = tratamiento;
      console.log(this.tratamiento);
    },

    addModal() {
      if (this.selectedPersona) {
        ModalService.open(TestModal);
        ModalService.recievedata(this.persona);
      } else {
        this.$toast("Debe Seleccionar Un Paciente de la lista");
      }
    },
    async nuevaConsulta() {
      const res = await axios.get("/especialidades");
      this.especialidades = res.data;
      const resSint = await axios.get("/sintomas");
      this.sintomas = resSint.data;
      const resHab = await axios.get("/habitos");
      this.habitos = resHab.data;
      const resProc = await axios.get("/procesos");
      this.procesos = resProc.data;
      ModalService.open(ModalNCons);
      ModalService.recievedata(this.persona);
      ModalService.recieveEspecialidad(this.especialidades);
      ModalService.recieveSintomas(this.sintomas);
      ModalService.recieveHabitos(this.habitos);
      ModalService.recieveProcesos(this.procesos);
    },
    verConsulta() {
      ModalService.open(ModalVerConsulta);
      this.verConsultaObj.consulta = this.consulta;
      this.verConsultaObj.persona = this.persona;
      ModalService.recievedata(this.verConsultaObj);
    },
    async editarConsulta() {
      console.log("trying");
      ModalService.open(ModalEditarConsulta);
      this.verConsultaObj.consulta = this.consulta;
      this.verConsultaObj.persona = this.persona;
      const resProc = await axios.get("/procesos");
      this.verConsultaObj.procesos = resProc.data;
      ModalService.recievedata(this.verConsultaObj);
    },
    async nuevoDiagnostico() {
      ModalService.open(NuevoDiagnostico);
      this.verConsultaObj.consulta = this.consulta;
      this.verConsultaObj.persona = this.persona;
      this.verConsultaObj.patologias = await axios.get("/patologias");
      ModalService.recievedata(this.verConsultaObj);
    },
    verDiagnostico() {
      ModalService.open(ModalVerDiagnostico);
      this.verDiagObj.consulta = this.consulta;
      this.verDiagObj.persona = this.persona;
      this.verDiagObj.diagnostico = this.diagnostico;
      ModalService.recievedata(this.verDiagObj);
    },
    editarDiagnostico() {
      ModalService.open(ModalEditarDiagnostico);
      this.verDiagObj.consulta = this.consulta;
      this.verDiagObj.persona = this.persona;
      this.verDiagObj.diagnostico = this.diagnostico;
      ModalService.recievedata(this.verDiagObj);
    },

    async nuevoTratamiento() {
      ModalService.open(ModalNuevoTratamiento);
      this.nuevoTratObj.persona = this.persona;
      this.nuevoTratObj.diagnostico = this.diagnostico;
      this.nuevoTratObj.tipos_trat = await axios.get("/alltrat");
      ModalService.recievedata(this.nuevoTratObj);
    },

    verTratamiento() {
      ModalService.open(ModalVerTratamiento);
      this.nuevoRecipeObj.persona = this.persona;
      this.nuevoRecipeObj.tratamiento = this.tratamiento;
      ModalService.recievedata(this.nuevoRecipeObj);
    },

    editarTratamiento() {
      ModalService.open(ModalEditTratamiento);
      this.nuevoRecipeObj.persona = this.persona;
      this.nuevoRecipeObj.tratamiento = this.tratamiento;
      ModalService.recievedata(this.nuevoRecipeObj);
    },

    async nuevoRecipe() {
      ModalService.open(ModalNuevoRecipe);
      this.nuevoRecipeObj.persona = this.persona;
      this.nuevoRecipeObj.tratamiento = this.tratamiento;
      this.nuevoRecipeObj.medicamentos = await axios.get("/medicamentos");
      console.log(this.tratamiento);
      ModalService.recievedata(this.nuevoRecipeObj);
    },

    async verRecipe() {
      ModalService.open(ModalVerRecipe);
      this.verRecipeObj.persona = this.persona;
      this.verRecipeObj.tratamiento = this.tratamiento;
      this.verRecipeObj.recipe = this.recipe;
      this.verRecipeObj.medicamentos = await axios.get("/recipes", {
        params: { id_recipe: this.selectedRecipe },
      });
      ModalService.recievedata(this.verRecipeObj);
    },

    async editarRecipe() {
      ModalService.open(ModalEditarRecipe);
      this.verRecipeObj.persona = this.persona;
      this.verRecipeObj.tratamiento = this.tratamiento;
      this.verRecipeObj.recipe = this.recipe;
      this.verRecipeObj.medicamentos = await axios.get("/recipes", {
        params: { id_recipe: this.selectedRecipe },
      });
      this.verRecipeObj.addMedicamentos = await axios.get("/medicamentos");
      ModalService.recievedata(this.verRecipeObj);
    },

    selectRow(persona) {
      this.selectedUser = persona.id_persona;
      this.persona = persona;
      this.selectedPersona = persona.id_persona;
      console.log(this.selectedPersona);
    },

    selectRowRecipe(recipe) {
      console.log(recipe);
      this.selectedRecipe = recipe.id_recipe;
      this.recipe = recipe;
    },

    seleccionar(id_pers) {
      this.id_pers = id_pers;
    },

    onTextChange() {
      this.perced = this.cedula;
      this.listarPer();
    },

    setSelected(tab) {
      if (tab === "Pacientes") {
        this.selected = tab;
        this.listarPer();
        this.selectedCons = null;
        this.selectedDiag = null;
        this.selectedTrat = null;
        this.selectedRecipe = null;
        return;
      }
      if (tab === "Consultas" && this.selectedPersona) {
        this.selected = tab;
        this.listarCons();
        this.selectedDiag = null;
        this.selectedTrat = null;
        this.selectedRecipe = null;
        return;
      } else if (tab === "Consultas") {
        this.$toast("Debe seleccionar Un paciente Para ver o crear consultas");
      }
      if (tab === "Diagnosticos" && this.selectedPersona && this.selectedCons) {
        this.selected = tab;
        this.listarDiag();
        this.selectedTrat = null;
        this.selectedRecipe = null;
        return;
      } else if (tab === "Diagnosticos") {
        this.$toast(
          "Debe seleccionar Una consulta Para ver o crear diagnosticos"
        );
      }
      if (
        tab === "Tratamientos" &&
        this.selectedPersona &&
        this.selectedCons &&
        this.selectedDiag
      ) {
        this.selected = tab;
        this.listarTrat();
        this.selectedRecipe = null;
        return;
      } else if (tab === "Tratamientos") {
        this.$toast(
          "Debe seleccionar Un diagnostico Para ver o crear tratamientos"
        );
      }
      if (
        tab === "Recipes" &&
        this.selectedPersona &&
        this.selectedCons &&
        this.selectedDiag &&
        this.selectedTrat
      ) {
        this.selected = tab;
        this.listarRecipes();
        return;
      } else if (tab === "Recipes") {
        this.$toast("Debe seleccionar Un tratamiento Para ver o crear recipes");
      }
    },

    //listar Personas

    created() {},

    /* Listar Tratamientos */
    async listarTrat() {
      const res = await axios.get("/tratamientos", {
        params: { selectedDiag: this.selectedDiag },
      });
      this.tratamientos = res.data;
      if (this.tratamientos.length < 1) {
        this.tratamientos = false;
      }
    },

    /* Listar Recipes */
    async listarRecipes() {
      const res = await axios.get("/recipes", {
        params: { id_tratamiento: this.selectedTrat },
      });
      this.recipes = res.data;
      if (this.recipes.length < 1) {
        this.recipes = false;
      }
    },

    /* listar personas sin filtrar por cedula */
    async listarPers() {
      const res = await axios.get("/personas");
      this.personas = res.data;
    },

    /* listar personas filtrando por cedula */
    async listarPer() {
      const res = await axios.get("/personas", {
        params: { cedula: this.perced },
      });
      this.personas = res.data;
    },

    //listar Consultas

    async listarCons() {
      const res = await axios.get("/consultas", {
        params: { selectedPersona: this.selectedPersona },
      });
      this.consultas = res.data;
      if (this.consultas.length < 1) {
        this.consultas = false;
      }
    },

    //listar Diagnosticos

    async listarDiag() {
      const res = await axios.get("/diagnosticos", {
        params: { selectedConsulta: this.selectedCons },
      });
      this.diagnosticos = res.data;
      if (this.diagnosticos.length < 1) {
        this.diagnosticos = false;
      }
    },

    // metodos modal

    async guardar() {
      if (this.modificar) {
        console.log(this.persona.id_persona, this.persona);
        const res = await axios.put(
          "/personas/" + this.persona.id_persona,
          this.persona
        );
      } else {
        const res = await axios.post("/personas/", this.persona);
      }
      this.cerrarModal();
      this.listarPer();
    },

    async eliminar(id_persona) {
      console.log(id_persona);
      const res = await axios.delete("/personas/" + id_persona);
      this.listarPer();
    },

    async seleccionarMedicamentos() {
      const res = await axios.get("/medicamentos");
      this.medicamentoss = res.data;
    },
  },
};
</script>
<style>
#appx {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  color: #2c3e50;
  margin-top: 60px;
  display: flex;
  flex-direction: row;
  justify-content: center;
}
.mostrar {
  display: list-item;
  opacity: 1;
  background: rgba(75, 56, 143, 0.705);
}
.highlight {
  background-color: rgb(79, 139, 196);
  color: white;
}
.highlightCons {
  background-color: rgb(79, 139, 196);
  color: white;
}
.highlightDiag {
  background-color: rgb(79, 139, 196);
  color: white;
}
.highlightTrat {
  background-color: rgb(79, 139, 196);
  color: white;
}
.highlightRecipe {
  background-color: rgb(79, 139, 196);
  color: white;
}
tr:hover {
  cursor: pointer;
  background-color: rgb(159, 213, 255);
  transition: 0.1s;
}

@keyframes slideInFromLeft {
  0% {
    transform: translateX(-200%);
    opacity: 0%;
  }
  100% {
    transform: translateX(0);
    opacity: 100%;
  }
}

.tr-anim {
  --index: 0;
  opacity: 0;
  -webkit-transition: opacity 1s;
  transition: opacity 1s;
  /* /////////ANIMATIONS///////////// */
  animation-duration: 0.7s;
  animation-timing-function: ease-out;
  animation-delay: calc(0.07s * var(--index));
  animation-iteration-count: 1;
  animation-name: slideInFromLeft;
  animation-fill-mode: forwards;
  /* /////////ANIMATIONS///////////// */
}
.trslt-btn {
  --pos: 16.66015625;
  /* /////////ANIMATIONS///////////// */
  top: (var(--pos));
  transform: scale(calc(var(--pos) * 0.01));
  position: absolute;
  animation-duration: 1s;
  animation-timing-function: ease-out;
  animation-delay: 0.07s;
  animation-iteration-count: 99;
  animation-name: slide;
  /* /////////ANIMATIONS///////////// */
}
[data-animation] {
  animation: var(--pos);
}
@keyframes slide {
  from {
    transform: translateY(0%);
  }
  to {
    transform: translateY(var(--pos));
  }
}
</style>