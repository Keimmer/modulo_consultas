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
        <select
          name="LeaveType"
          @change="BuscarCedulaNombre($event)"
          class="form-control mb-4"
          v-model="cednom"
          placeholder="Seleccione"
        >
          <option value="1">Buscar por Cedula</option>
          <option value="2">Buscar por Nombre y Apellido</option>
        </select>
        <div v-if="porCedula">
          <input
            v-if="porCedula"
            type="text"
            name="cedula"
            @change="onTextChange()"
            class="form-control mb-4"
            v-model="cedula"
            placeholder="Cedula"
          />
        </div>
        <div v-if="porNombre">
          <input
            type="text"
            name="cedula"
            @change="onTextChange()"
            class="form-control mb-4"
            v-model="cedula"
            placeholder="Nombre"
          />
        </div>
        <!-- The table -->
        <!-- ------------------------------ -->
        <!-- ------------------------------ -->
        <!-- ------------------------------ -->
        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nombre</th>
              <th scope="col">Apellido</th>
              <th scope="col">Cedula</th>
              <th scope="col">Genero</th>
              <th scope="col">Edad</th>
              <!-- <th scope="col">Acciones</th> -->
            </tr>
          </thead>
          <tbody>
            <tr
              v-for="persona in personas"
              :key="persona.id_persona"
              @click="selectRow(persona)"
              :class="{ highlight: persona.id_persona == selectedUser }"
            >
              <th scope="row">{{ persona.id_persona }}</th>
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

        <!-- Boton para la ventana modal -->

        <button @click="addModal" class="btn btn-primary">Ver Paciente</button>
      </Tab>
      <Tab :isSelected="selected === 'Consultas'">
        <p></p>
        <PerfilPaciente v-if="selectedUser" :data="persona"></PerfilPaciente>
        <!-- <h4 v-if="selectedUser">Paciente Seleccionado: {{persona.nombre}} {{persona.apellido}} {{persona.cedula}}</h4> -->
        <!-- The table -->
        <!-- ------------------------------ -->
        <!-- ------------------------------ -->
        <!-- ------------------------------ -->
        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col">Numero Consulta</th>
              <th scope="col">Fecha Consulta</th>
              <th scope="col">Paciente</th>
              <th scope="col">Medico Tratante</th>
              <th scope="col">Especialidad Consulta</th>
              <th scope="col">Cantidad de Procedimientos</th>
            </tr>
          </thead>
          <tbody>
            <tr
              v-for="consulta in consultas"
              :key="consulta.id_consulta"
              @click="selectRowConsulta(consulta)"
              :class="{ highlightCons: consulta.id_consulta == selectedCons }"
            >
              <th scope="row">{{ consulta.id_consulta }}</th>
              <td>{{ consulta.fecha_consulta }}</td>
              <td>{{ consulta.sintomas }}</td>
              <td>{{ consulta.habitos }}</td>
            </tr>
          </tbody>
        </table>
        <!-- ------------------------------ -->
        <!-- ------------------------------ -->
        <!-- End of the table -->

        <button @click="nuevaConsulta" class="btn btn-danger">
          Nueva Consulta
        </button>
        <button @click="abrir()" type="button" class="btn btn-primary my-4">
          Ver Consulta
        </button>
        <button
          @click="abrirEditarConsulta()"
          type="button"
          class="btn btn-primary my-4"
        >
          Editar Consulta
        </button>
        <button
          @click="imprimirConsulta()"
          type="button"
          class="btn btn-success my-4"
        >
          Imprimir Consulta
        </button>
      </Tab>
      <Tab :isSelected="selected === 'Diagnosticos'">
        <p></p>
        <!-- The table -->
        <!-- ------------------------------ -->
        <!-- ------------------------------ -->
        <!-- ------------------------------ -->
        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col">Numero Consulta</th>
              <th scope="col">Numero Diagnostico</th>
              <th scope="col">Fecha Diagnostico</th>
              <th scope="col">Patologia</th>
              <th scope="col">Estado de Salud</th>
            </tr>
          </thead>
          <tbody>
            <tr
              v-for="diagnostico in diagnosticos"
              :key="diagnostico.id_diagnosticos"
            >
              <th scope="row">{{ diagnostico.id_diagnosticos }}</th>
              <td>{{ diagnostico.fecha_diag }}</td>
              <td>{{ diagnostico.nombre_patologia }}</td>
              <td>{{ diagnostico.estado_de_salud }}</td>
            </tr>
            <tr>
              <td>1234</td>
              <td>1236</td>
              <td>10/5/2020</td>
              <td>Dengue</td>
              <td>Mal</td>
            </tr>
            <tr>
              <td>1235</td>
              <td>1238</td>
              <td>10/5/2020</td>
              <td>Cancer</td>
              <td>Mal</td>
            </tr>
            <tr>
              <td>1234</td>
              <td>1236</td>
              <td>10/5/2020</td>
              <td>Fiebre Amarilla</td>
              <td>Mal</td>
            </tr>
          </tbody>
        </table>
        <!-- ------------------------------ -->
        <!-- ------------------------------ -->
        <!-- End of the table -->

        <button
          @click="abrirNuevoDiagnostico()"
          type="button"
          class="btn btn-success my-4"
        >
          Nuevo Diagnostico
        </button>
        <button
          @click="abrirVerDiagnostico()"
          type="button"
          class="btn btn-primary my-4"
        >
          Ver Diagnostico
        </button>
        <button
          @click="abrirEditarDiagnostico()"
          type="button"
          class="btn btn-primary my-4"
        >
          Editar Diagnostico
        </button>
        <button
          @click="imprimirDiagnostico()"
          type="button"
          class="btn btn-success my-4"
        >
          Imprimir Diagnostico
        </button>
      </Tab>
      <Tab :isSelected="selected === 'Tratamientos'">
        <p></p>
        <!-- The table -->
        <!-- ------------------------------ -->
        <!-- ------------------------------ -->
        <!-- ------------------------------ -->
        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col">Numero Tratamiento</th>
              <th scope="col">Numero Diagnostico</th>
              <th scope="col">Paciente</th>
              <th scope="col">Fecha Inicio</th>
              <th scope="col">Tipo de Tratamiento</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="tratamiento in tratamientos" :key="tratamiento.id">
              <th scope="row">{{ tratamiento.id_tratamientos }}</th>
              <td>{{ tratamiento.tipo_tratamiento }}</td>
              <td>{{ tratamiento.fecha_inicio }}</td>
              <td>{{ tratamiento.fecha_fin }}</td>
            </tr>
            <tr>
              <td>3214</td>
              <td>3221</td>
              <td>Pedro Perez</td>
              <td>6/5/2021</td>
              <td>Farmacologia</td>
            </tr>
            <tr>
              <td>3263</td>
              <td>3213</td>
              <td>Richard Blanco</td>
              <td>20/10/2021</td>
              <td>Farmacologia</td>
            </tr>
            <tr
              @click="selectRow(persona)"
              :class="{ highlight: persona.id_persona == selectedUser }"
            >
              <td>3213</td>
              <td>3211</td>
              <td>Laura Lovera</td>
              <td>10/5/2021</td>
              <td>Farmacologia</td>
            </tr>
          </tbody>
        </table>
        <!-- ------------------------------ -->
        <!-- ------------------------------ -->
        <!-- End of the table -->

        <!-- Botones de tratamientos -->

        <button
          @click="abrirNuevoTratamiento()"
          type="button"
          class="btn btn-success my-4"
        >
          Nuevo Tratamiento
        </button>
        <button
          @click="abrirVerTratamiento()"
          type="button"
          class="btn btn-primary my-4"
        >
          Ver Tratamiento
        </button>
        <button
          @click="abrirEditarTratamiento()"
          type="button"
          class="btn btn-primary my-4"
        >
          Editar Tratamiento
        </button>
        <button
          @click="imprimirTratamiento()"
          type="button"
          class="btn btn-success my-4"
        >
          Imprimir Tratamiento
        </button>
      </Tab>
      <Tab :isSelected="selected === 'Recipes'">
        <p></p>
        <!-- The table -->
        <!-- ------------------------------ -->
        <!-- ------------------------------ -->
        <!-- ------------------------------ -->
        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col">Numero Recipe</th>
              <th scope="col">Numero Tratamiento</th>
              <th scope="col">Nombre Paciente</th>
              <th scope="col">Fecha Expedicion</th>
              <th scope="col">Cantidad De Medicamentos</th>
            </tr>
          </thead>
          <tbody>
            <!-- <tr
              v-for="recipe in recipes"
              :key="recipe.id_recipes"
              @click="selectRowRecipe(recipe)"
              :class="{ highlight: recipe.id_recipes == selectedUser }"
            >
              <th scope="row">{{ recipe.id_recipes }}</th>
              <td>{{ recipe.indicaciones }}</td>
              <td>{{ recipe.fecha_expedicion }}</td>
              <td>{{ recipe.nombre_tipo_med }}</td>
              <td>{{ recipe.medicamento }}</td>
            </tr> -->

            <tr>
              <td>1514</td>
              <td>1520</td>
              <td>Alberto Rodriguez</td>
              <td>12/6/2020</td>
              <td>3</td>
            </tr>
            <tr>
              <td>1516</td>
              <td>1530</td>
              <td>Clara Clayton</td>
              <td>2/10/2020</td>
              <td>3</td>
            </tr>
            <tr
              @click="selectRowRecipe(recipe)"
              :class="{ highlight: recipe.id_recipes == selectedUser }"
            >
              <td>1523</td>
              <td>1540</td>
              <td>Manuel Alvarado</td>
              <td>6/6/2020</td>
              <td>3</td>
            </tr>
          </tbody>
        </table>
        <!-- ------------------------------ -->
        <!-- ------------------------------ -->
        <!-- End of the table -->

        <!-- Boton para la ventana modal -->
        <button
          @click="
            modificar = false;
            abrirModalRecipe();
          "
          type="button"
          class="btn btn-success my-4"
        >
          Nuevo Recipe
        </button>
        <button
          @click="
            modificar = false;
            abrirVerRecipe();
          "
          type="button"
          class="btn btn-primary my-4"
        >
          Ver Recipe
        </button>
        <button
          @click="
            modificar = false;
            abrirModalRecipe();
          "
          type="button"
          class="btn btn-success my-4"
        >
          Imprimir Recipe
        </button>
        <button
          @click="
            modificar = false;
            abrirModalRecipe();
          "
          type="button"
          class="btn btn-warning my-4"
        >
          Editar Recipe
        </button>
      </Tab>
    </TabNav>

    <!-- ------------------------------------------------------------- -->
    <!-- ------------------------------------------------------------- -->
    <!-- ------------------------------------------------------------- -->
    <!-- ------------------------------------------------------------- -->
    <!-- --------------------Ventana Modal Persona-------------------- -->
    <!-- ------------------------------------------------------------- -->
    <!-- ------------------------------------------------------------- -->
    <!-- ------------------------------------------------------------- -->

    <!-- ------------------------------------------------------------- -->
    <!-- ------------------------------------------------------------- -->
    <!-- ------------------------------------------------------------- -->
    <!-- ------------------------------------------------------------- -->
    <!-- --------------------Ventana Modal Consulta------------------- -->
    <!-- ------------------------------------------------------------- -->
    <!-- ------------------------------------------------------------- -->
    <!-- ------------------------------------------------------------- -->

    <div
      v-if="viewConsulta"
      id="vista"
      class="modal"
      :class="{ mostrar: vista }"
    >
      <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Consulta</h4>
            <button
              @click="cerrarModal()"
              type="button"
              class="close"
              data-dismiss="modal"
            >
              &times;
            </button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <h4>Consulta Numero: 1346</h4>
            <p>
              Especialidad de la consulta: malestar general <br />
              Fecha de la consulta: 6/12/2020 <br />
              Medico que atendio: Gonzalo Gomez
            </p>
            <div class="my-4">
              <label for="nombre">Nombre y apellido del paciente: </label>
              <p>Keimmer Altuve</p>
            </div>
            <div class="my-4">
              <label for="apellido">Cedula: </label>
              <p>V-22760305</p>
            </div>
            <div class="my-4">
              <label for="cedula">Alergias: </label>
              <p>Alergico al cianuro</p>
            </div>
            <div class="my-4">
              <label for="direccion">Habitos</label>
              <p>Fumador Frecuente</p>
            </div>
            <div class="my-4">
              <label for="telefono">Sintomas</label>
              <p>Dolor de cabeza</p>
            </div>
            <div class="my-4">
              <label for="telefono">Procedimientos de la consulta</label>
              <p>Temperatura: 37c</p>
            </div>
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <button
              @click="cerrarModal()"
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal"
            >
              Cancelar
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- ------------------------------------------------------------- -->
    <!-- ------------------------------------------------------------- -->
    <!-- ------------------------------------------------------------- -->
    <!-- ------------------------------------------------------------- -->
    <!-- ----------------Ventana Modal Nuevo Recipe ------------------ -->
    <!-- ------------------------------------------------------------- -->
    <!-- ------------------------------------------------------------- -->
    <!-- ------------------------------------------------------------- -->

    <div v-if="modalRecipe" class="modal" :class="{ mostrar: modal }">
      <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Editar Recipe</h4>
            <button
              @click="cerrarModal()"
              type="button"
              class="close"
              data-dismiss="modal"
            >
              &times;
            </button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <p>
              Numero Tratamiento: 1523 <br />
              Tipo de Tratamiento: Farmacoterapia<br />
              Fecha de la consulta: 6/12/2020 <br />
              Medico que atendio: Gonzalo Gomez
            </p>
            <div class="my-4">
              <label for="nombre">Nombre y apellido del paciente: </label>
              <p>Manuel Alvarado</p>
            </div>
            <div class="my-4">
              <label for="apellido">Cedula: </label>
              <p>V-25195492</p>
            </div>
            <div class="my-4">
              <label for="fecha">Fecha de Expedicion</label>
              <input
                v-model="recipe.fecha_expedicion"
                type="text"
                class="form-control"
                id="fecha_expedicion"
                placeholder="Fecha expedicion recipe"
              />
            </div>
            <div v-for="(find, index) in finds" :key="index">
              <div class="my-4">
                <label for="medicamentos">Medicamento</label>
                <select
                  v-model="find.value"
                  :key="index"
                  class="form-control"
                  name="medicamentos"
                  id=""
                >
                  <option
                    v-for="medicamento in medicamentoss"
                    :key="medicamento.id_tipo_medicamento"
                    :v-model="medicamento.id_tipo_medicamento"
                  >
                    {{ medicamento.medicamento }} -
                    {{ medicamento.tipo_medicamento }}
                  </option>
                  <option value="">Agregar</option>
                </select>
              </div>
              <div class="my-4">
                <label for="nombre_medicamento">Indicaciones</label>
                <input
                  v-model="find.value2"
                  :key="index"
                  type="text"
                  class="form-control"
                  id="nombre_medicamento"
                  placeholder="Indicaciones para los medicamentos"
                />
              </div>
            </div>
            <button class="btn btn-primary" @click="addFind">
              Agregar Medicamento
            </button>
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <button
              @click="cerrarModal()"
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal"
            >
              Cancelar
            </button>
            <button
              @click="guardar()"
              type="button"
              class="btn btn-success"
              data-dismiss="modal"
            >
              Guardar
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- -------------------Modal Editar Consulta-------------------- -->
    <!-- -------------------Modal Editar Consulta-------------------- -->
    <!-- -------------------Modal Editar Consulta-------------------- -->
    <!-- -------------------Modal Editar Consulta-------------------- -->
    <!-- -------------------Modal Editar Consulta-------------------- -->

    <div v-if="modalEditarConsulta" class="modal" :class="{ mostrar: modal }">
      <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Editar Consulta</h4>
            <button
              @click="cerrarModal()"
              type="button"
              class="close"
              data-dismiss="modal"
            >
              &times;
            </button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <div class="my-4">
              <h4>Informacion Basica del Paciente:</h4>
              <p>
                Nombre y apellido: Keimmer Altuve <br />
                Cedula: V-22760305 <br />
                Edad: 26 <br />
              </p>
            </div>
            <div class="my-4">
              <label for="">Especialidad Consulta</label>
              <select name="" class="form-control" id="">
                <option value="">Malestar General</option>
                <option value="">Cardiologia</option>
                <option value="">Oftalmologia</option>
              </select>
            </div>
            <div class="my-4">
              <label for="indicaciones">Sintomas</label>
              <input
                v-model="recipe.indicaciones"
                type="text"
                class="form-control"
                id="indicaciones"
                placeholder="Sintomas del Paciente"
              />
            </div>
            <div class="my-4">
              <label for="fecha">Habitos</label>
              <input
                v-model="recipe.fecha_expedicion"
                type="text"
                class="form-control"
                id="fecha_expedicion"
                placeholder="Habitos del paciente"
              />
            </div>
            <div v-for="(find, index) in finds" :key="index">
              <div class="my-4">
                <label for="medicamentos">Procedimiento</label>
                <select
                  v-model="find.value"
                  :key="index"
                  class="form-control"
                  name="medicamentos"
                  id=""
                >
                  <option
                    v-for="medicamento in medicamentoss"
                    :key="medicamento.id_tipo_medicamento"
                    :v-model="medicamento.id_tipo_medicamento"
                  >
                    {{ medicamento.medicamento }} -
                    {{ medicamento.tipo_medicamento }}
                  </option>
                  <option value="">Temperatura</option>
                  <option value="">Peso</option>
                  <option value="">Presion Arterial</option>
                </select>
              </div>
              <div class="my-4">
                <label for="nombre_medicamento">Resultados</label>
                <input
                  v-model="find.value2"
                  :key="index"
                  type="text"
                  class="form-control"
                  id="nombre_medicamento"
                  placeholder="Resultado del procedimiento"
                />
              </div>
            </div>
            <button class="btn btn-primary" @click="addFind">
              Nuevo Procedimiento
            </button>
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <button
              @click="cerrarModal()"
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal"
            >
              Cancelar
            </button>
            <button
              @click="guardar()"
              type="button"
              class="btn btn-success"
              data-dismiss="modal"
            >
              Guardar
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- ------------------- Modal nuevo tratamiento ---------------------- -->
    <!-- ------------------- Modal nuevo tratamiento ---------------------- -->
    <!-- ------------------- Modal nuevo tratamiento ---------------------- -->
    <!-- ------------------- Modal nuevo tratamiento ---------------------- -->
    <!-- ------------------- Modal nuevo tratamiento ---------------------- -->

    <div v-if="modalNuevoTratamiento" class="modal" :class="{ mostrar: modal }">
      <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Nuevo Tratamiento</h4>
            <button
              @click="cerrarModal()"
              type="button"
              class="close"
              data-dismiss="modal"
            >
              &times;
            </button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <div class="my-4">
              <h4>Informacion Basica del Paciente:</h4>
              <p>
                Nombre y apellido: Laura Lovera <br />
                Cedula: V-26987432 <br />
                Edad: 20 <br />
                Alergia: Ibuprofeno <br />
              </p>
            </div>
            <div class="my-4">
              <h4>Informacion Basica del Diagnostico:</h4>
              <p>
                Numero Diagnostico: 2416 <br />
                Amigdalitis <br />
                Estado de salud: Regular<br />
              </p>
            </div>
            <div class="my-4">
              <label for="">Medico Responsable</label>
              <select name="" class="form-control" id="">
                <option value="">Cristina Lopez</option>
                <option value="">Raul Quintero</option>
                <option value="">Albert Perez</option>
              </select>
            </div>
            <div class="my-4">
              <label for="">Tipo de Tratamiento</label>
              <select name="" class="form-control" id="">
                <option value="">Radiologia</option>
                <option value="">Quimioterapia</option>
                <option value="">Farmacologia</option>
              </select>
            </div>
            <div class="my-4">
              <label for="indicaciones">Objetivo del tratamiento</label>
              <input
                type="text"
                class="form-control"
                id="indicaciones"
                placeholder="Objetivo del Tratamiento"
              />
            </div>
            <div class="my-4">
              <label for="fecha">Riesgos</label>
              <input
                type="text"
                class="form-control"
                id="fecha_expedicion"
                placeholder="Posibles Riesgos del Tratamiento"
              />
            </div>
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <button
              @click="cerrarModal()"
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal"
            >
              Cancelar
            </button>
            <button
              @click="guardar()"
              type="button"
              class="btn btn-success"
              data-dismiss="modal"
            >
              Guardar
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- ------------------Modal editar tratamiento--------------- -->
    <!-- ------------------Modal editar tratamiento--------------- -->
    <!-- ------------------Modal editar tratamiento--------------- -->
    <!-- ------------------Modal editar tratamiento--------------- -->
    <!-- ------------------Modal editar tratamiento--------------- -->

    <div
      v-if="modalEditarTratamiento"
      class="modal"
      :class="{ mostrar: modal }"
    >
      <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Editar Tratamiento</h4>
            <button
              @click="cerrarModal()"
              type="button"
              class="close"
              data-dismiss="modal"
            >
              &times;
            </button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <div class="my-4">
              <h4>Informacion Basica del Paciente:</h4>
              <p>
                Nombre y apellido: Laura Lovera <br />
                Cedula: V-26987432 <br />
                Edad: 20 <br />
                Alergia: Ibuprofeno <br />
              </p>
            </div>
            <div class="my-4">
              <h4>Informacion Basica del Diagnostico:</h4>
              <p>
                Numero Diagnostico: 2416 <br />
                Amigdalitis <br />
                Estado de salud: Regular<br />
              </p>
            </div>
            <div class="my-4">
              <label for="">Medico Responsable</label>
              <p>{{ medico.nombre }} {{ medico.apellido }}</p>
            </div>
            <div class="my-4">
              <label for="">Tipo de Tratamiento</label>
              <select name="" class="form-control" id="">
                <option value="">Radiologia</option>
                <option value="">Quimioterapia</option>
                <option value="">Farmacologia</option>
              </select>
            </div>
            <div class="my-4">
              <label for="indicaciones">Objetivo del tratamiento</label>
              <input
                type="text"
                class="form-control"
                id="indicaciones"
                placeholder="Objetivo del Tratamiento"
              />
            </div>
            <div class="my-4">
              <label for="fecha">Riesgos</label>
              <input
                type="text"
                class="form-control"
                id="fecha_expedicion"
                placeholder="Posibles Riesgos del Tratamiento"
              />
            </div>
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <button
              @click="cerrarModal()"
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal"
            >
              Cancelar
            </button>
            <button
              @click="guardar()"
              type="button"
              class="btn btn-success"
              data-dismiss="modal"
            >
              Guardar
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- -----------Modal Ver Tratamiento---------------- -->
    <!-- -----------Modal Ver Tratamiento---------------- -->
    <!-- -----------Modal Ver Tratamiento---------------- -->
    <!-- -----------Modal Ver Tratamiento---------------- -->
    <!-- -----------Modal Ver Tratamiento---------------- -->

    <div
      v-if="verTratamiento"
      id="vista"
      class="modal"
      :class="{ mostrar: modal }"
    >
      <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Tratamiento</h4>
            <button
              @click="cerrarModal()"
              type="button"
              class="close"
              data-dismiss="modal"
            >
              &times;
            </button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <h4>Tratamiento Numero: 1346</h4>
            <p>
              Tipo de Tratamiento: Farmacoterapia<br />
              Fecha de la consulta: 6/12/2020 <br />
              Medico que atendio: Gonzalo Gomez
            </p>
            <div class="my-4">
              <label for="nombre">Nombre y apellido del paciente: </label>
              <p>Laura Lovera</p>
            </div>
            <div class="my-4">
              <label for="apellido">Cedula: </label>
              <p>V-26789654</p>
            </div>
            <div class="my-4">
              <label for="">Tratamiento: </label>
              <p>Farmacoterapia</p>
            </div>
            <div class="my-4">
              <label for="cedula">Objetivo del Tratamiento: </label>
              <p>Aliviar la amigdalitis</p>
            </div>
            <div class="my-4">
              <label for="direccion"
                >Incomodidades o Riesgos del tratamiento</label
              >
              <p>molestia por las pastillas</p>
            </div>
            <div class="my-4">
              <label for="telefono">Medico Responsable</label>
              <p>Gonzalo Gomez</p>
            </div>
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <button
              @click="cerrarModal()"
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal"
            >
              Cancelar
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- ----------Modal Ver Recipe---------------------- -->
    <!-- ----------Modal Ver Recipe---------------------- -->
    <!-- ----------Modal Ver Recipe---------------------- -->
    <!-- ----------Modal Ver Recipe---------------------- -->
    <!-- ----------Modal Ver Recipe---------------------- -->

    <div v-if="verRecipe" id="vista" class="modal" :class="{ mostrar: modal }">
      <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Recipe</h4>
            <button
              @click="cerrarModal()"
              type="button"
              class="close"
              data-dismiss="modal"
            >
              &times;
            </button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <h4>Recipe Numero: 1689</h4>
            <p>
              Numero Tratamiento: 1523 <br />
              Tipo de Tratamiento: Farmacoterapia<br />
              Fecha de la consulta: 6/12/2020 <br />
              Medico que atendio: Gonzalo Gomez
            </p>
            <div class="my-4">
              <label for="nombre">Nombre y apellido del paciente: </label>
              <p>Manuel Alvarado</p>
            </div>
            <div class="my-4">
              <label for="apellido">Cedula: </label>
              <p>V-25195492</p>
            </div>
            <div class="my-4">
              <h4>Medicamentos</h4>
              <p>
                Medicamento: Azitromicina <br />
                Indicaciones: 1 cada semana
              </p>
              <br />
              <p>
                Medicamento: Ibuprofeno <br />
                Indicaciones: 1 cada 6 horas
              </p>
            </div>
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <button
              @click="cerrarModal()"
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal"
            >
              Cancelar
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- --------Modal Nuevo Diagnostico---------------- -->
    <!-- --------Modal Nuevo Diagnostico---------------- -->
    <!-- --------Modal Nuevo Diagnostico---------------- -->
    <!-- --------Modal Nuevo Diagnostico---------------- -->
    <!-- --------Modal Nuevo Diagnostico---------------- -->

    <div v-if="modalNuevoDiagnostico" class="modal" :class="{ mostrar: modal }">
      <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Nuevo Diagnostico</h4>
            <button
              @click="cerrarModal()"
              type="button"
              class="close"
              data-dismiss="modal"
            >
              &times;
            </button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <div class="my-4">
              <h4>Informacion Basica del Paciente:</h4>
              <p>
                Nombre y apellido: Keimmer Altuve <br />
                Cedula: V-22760305 <br />
                Edad: 26 <br />
                Alergia: Ibuprofeno <br />
              </p>
            </div>
            <div class="my-4">
              <h4>Informacion Basica de la Consulta:</h4>
              <p>
                Numero Consulta: 1234 <br />
                Sintoma Principal: dolor de garganta <br />
                Especialidad de la consulta: Medicina General <br />
              </p>
            </div>
            <div class="my-4">
              <label for="">Patologias </label>
              <select name="" class="form-control" id="">
                <option value="">Amigdalitis</option>
                <option value="">Fiebre</option>
                <option value="">Neumonia</option>
              </select>
            </div>
            <div class="my-4">
              <label for="indicaciones">Estado de Salud</label>
              <input
                type="text"
                class="form-control"
                id="indicaciones"
                placeholder="Estado de salud del paciente (bueno, regular, mal, grave)"
              />
            </div>
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <button
              @click="cerrarModal()"
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal"
            >
              Cancelar
            </button>
            <button
              @click="guardar()"
              type="button"
              class="btn btn-success"
              data-dismiss="modal"
            >
              Guardar
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- --------Modal Ver Diagnostico----------------- -->
    <!-- --------Modal Ver Diagnostico----------------- -->
    <!-- --------Modal Ver Diagnostico----------------- -->
    <!-- --------Modal Ver Diagnostico----------------- -->
    <!-- --------Modal Ver Diagnostico----------------- -->
    <!-- --------Modal Ver Diagnostico----------------- -->
    <!-- --------Modal Ver Diagnostico----------------- -->
    <!-- --------Modal Ver Diagnostico----------------- -->

    <div
      v-if="verDiagnostico"
      id="vista"
      class="modal"
      :class="{ mostrar: modal }"
    >
      <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Informacion Diagnostico</h4>
            <button
              @click="cerrarModal()"
              type="button"
              class="close"
              data-dismiss="modal"
            >
              &times;
            </button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <h4>Diagnostico Numero: 1236</h4>
            <p>
              Consulta N°1220<br />
              Sintoma Principal: Dolor en la garganta <br />
              Fecha de la consulta: 6/12/2020 <br />
              Medico que atendio: Gonzalo Gomez <br />
            </p>
            <div class="my-4">
              <label for="nombre">Nombre y apellido del paciente: </label>
              <p>Keimmer Altuve</p>
            </div>
            <div class="my-4">
              <label for="apellido">Cedula: </label>
              <p>V-22760305</p>
            </div>
            <div class="my-4">
              <label for="">Diagnostico: </label>
              <p>
                Patologia Diagnosticada: Amigadalitis<br />
                Codigo - CIE: J03 <br />
                Fecha del diagnostico: 6/12/2020
              </p>
            </div>
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <button
              @click="cerrarModal()"
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal"
            >
              Cancelar
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- -------Modal Editar Diagnostico-------------- -->
    <!-- -------Modal Editar Diagnostico-------------- -->
    <!-- -------Modal Editar Diagnostico-------------- -->
    <!-- -------Modal Editar Diagnostico-------------- -->

    <div v-if="editarDiagnostico" class="modal" :class="{ mostrar: modal }">
      <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Editar Diagnostico</h4>
            <button
              @click="cerrarModal()"
              type="button"
              class="close"
              data-dismiss="modal"
            >
              &times;
            </button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <div class="my-4">
              <h4>Informacion Basica del Paciente:</h4>
              <p>
                Nombre y apellido: Keimmer Altuve <br />
                Cedula: V-22760305 <br />
                Edad: 26 <br />
                Alergia: Ibuprofeno <br />
              </p>
            </div>
            <div class="my-4">
              <h4>Informacion Basica de la Consulta:</h4>
              <p>
                Numero Consulta: 1234 <br />
                Sintoma Principal: dolor de garganta <br />
                Especialidad de la consulta: Medicina General <br />
              </p>
            </div>
            <div class="my-4">
              <label for="">Patologias </label>
              <select name="" class="form-control" id="">
                <option value="">Amigdalitis</option>
                <option value="">Fiebre</option>
                <option value="">Neumonia</option>
              </select>
            </div>
            <div class="my-4">
              <label for="indicaciones">Estado de Salud</label>
              <input
                type="text"
                class="form-control"
                id="indicaciones"
                placeholder="Estado de salud del paciente (bueno, regular, mal, grave)"
              />
            </div>
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <button
              @click="cerrarModal()"
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal"
            >
              Cancelar
            </button>
            <button
              @click="guardar()"
              type="button"
              class="btn btn-success"
              data-dismiss="modal"
            >
              Guardar
            </button>
          </div>
        </div>
      </div>
    </div>

    <ModalRoot :listdata="persona"></ModalRoot>
  </div>
</template>
<script>
import TabNav from "./TabNav.vue";
import Tab from "./Tab.vue";
import VerPersona from "./ventanasMod/VerPersona.vue";
import ModalRoot from "./Modals/ModalRoot.vue";
import ModalService from "./Modals/services/modal.service";
import TestModal from "./TestModal.vue";
import ModalNCons from "./ModalNCons.vue";
import modalService from "./Modals/services/modal.service";
import PerfilPaciente from "./PerfilPaciente.vue";
export default {
  name: "App",
  components: { TabNav, Tab, VerPersona, ModalRoot, PerfilPaciente },
  data() {
    return {
      data: {
        key: "",
        cedula: "",
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
        fecha_diagnostico: "xxxxxxx",
        nombre_patologia: "zzxxx",
        estado_de_salud: "xxxzzz",
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
      tituloModal: "",
      modalVerPersona: false,
      modalRecipe: false,
      modalNuevaConsulta: false,
      modalEditarConsulta: false,
      modalNuevoTratamiento: false,
      modalEditarTratamiento: false,
      modalNuevoDiagnostico: false,
      verTratamiento: false,
      verDiagnostico: false,
      editarDiagnostico: false,
      verRecipe: false,

      personas: [],
      selectedUser: null,
      consultas: [],
      diagnosticos: [],
      tratamientos: [],
      recipes: [],
      medicamentoss: [],
      finds: [],
      perced: "",
      selectedPersona: "",
      selectedCons: "",
    };
  },
  methods: {
    addModal() {
      ModalService.open(TestModal);
      ModalService.recievedata(this.persona);
    },
    nuevaConsulta() {
      ModalService.open(ModalNCons);
      modalService.recievedata(this.consulta);
    },
    addFind: function () {
      this.finds.push({ value: "", value2: "" });
      console.log(this.finds);
    },

    BuscarCedulaNombre(event) {
      console.log(event.target.value);
      if (this.cednom == 1) {
        this.porCedula = true;
        this.porNombre = false;
      }

      if (this.cednom == 2) {
        this.porCedula = false;
        this.porNombre = true;
      }
    },

    selectRow(persona) {
      this.selectedUser = persona.id_persona;
      this.persona = persona;
      this.selectedPersona = persona.id_persona;
      console.log(this.selectedPersona);
    },

    selectRowConsulta(consulta) {
      this.selectedCons = consulta.id_consulta;
      this.consulta = consulta;
      console.log(this.selectedCons);
    },

    abrir() {
      (this.viewConsulta = true), (this.vista = 1);
    },

    selectRowRecipe(recipe) {
      this.selectedUser = recipe.id_recipes;
      this.recipe = recipe;
      this.selectedPersona = persona.id_persona;
      console.log(this.selectedPersona);
    },

    onChange() {
      //
    },
    seleccionar(id_pers) {
      this.id_pers = id_pers;
    },
    onTextChange() {
      this.perced = this.cedula;
      this.listarPer();
    },
    setSelected(tab) {
      this.selected = tab;
      if (this.selected === "Pacientes") {
        this.listarPer();
      }
      if (this.selected === "Consultas") {
        this.listarCons();
      }
      if (this.selected === "Diagnosticos") {
        this.listarDiag();
      }
      if (this.selected === "Tratamientos") {
        this.listarTrat();
      }
      if (this.selected === "Recipes") {
        this.listarRecipes();
      }
    },

    //listar Personas

    created() {
      this.listarPer();
    },

    /* Listar Tratamientos */
    async listarTrat() {
      const res = await axios.get("/tratamientos");
      this.tratamientos = res.data;
    },

    /* Listar Recipes */
    async listarRecipes() {
      const res = await axios.get("/recipes");
      this.recipes = res.data;
    },

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
      console.log(this.consultas);
    },

    //listar Diagnosticos

    async listarDiag() {
      const res = await axios.get("/diagnosticos");
      this.diagnosticos = res.data;
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

    /* //////////////////////// Modal de Personas ///////////////////////// */
    /* //////////////////////// Modal de Personas ///////////////////////// */
    /* //////////////////////// Modal de Personas ///////////////////////// */
    /* //////////////////////// Modal de Personas ///////////////////////// */
    /* //////////////////////// Modal de Personas ///////////////////////// */
    /* //////////////////////// Modal de Personas ///////////////////////// */

    abrirModal(data = {}) {
      this.modalPersona = true;
      this.modal = 1;
      if (this.modificar) {
        this.persona.id_persona = this.selectedPersona;
        this.tituloModal = "Modificar Persona";
        this.persona.nombre = data.nombre;
        this.persona.apellido = data.apellido;
        this.persona.cedula = data.cedula;
        this.persona.direccion = data.direccion;
        this.persona.telefono = data.telefono;
      } else {
        this.id = 0;
        this.tituloModal = "Crear persona";
        this.persona.nombre = "";
        this.persona.apellido = "";
        this.persona.cedula = "";
        this.persona.direccion = "";
        this.persona.telefono = "";
      }
    },
    cerrarModal() {
      this.modal = 0;
      this.modalPersona = false;
    },

    /* //////////////////////// Modal de Personas ///////////////////////// */
    /* //////////////////////// Modal de Personas ///////////////////////// */
    /* //////////////////////// Modal de Personas ///////////////////////// */
    /* //////////////////////// Modal de Personas ///////////////////////// */
    /* //////////////////////// Modal de Personas ///////////////////////// */
    /* //////////////////////// Modal de Personas ///////////////////////// */

    /////////

    /* ///////////////////////Modal de Recipes////////////////////////////// */
    /* ///////////////////////Modal de Recipes////////////////////////////// */
    /* ///////////////////////Modal de Recipes////////////////////////////// */
    /* ///////////////////////Modal de Recipes////////////////////////////// */
    /* ///////////////////////Modal de Recipes////////////////////////////// */
    /* ///////////////////////Modal de Recipes////////////////////////////// */

    abrirModalRecipe(data = {}) {
      this.seleccionarMedicamentos();
      this.modal = 1;
      this.modalRecipe = true;
      if (this.modificar) {
        this.recipe.id_recipe = this.selectedRecipe;
        this.tituloModal = "Modificar recipe";
        this.recipe.indicaciones = data.indicaciones;
        this.recipe.fecha_expedicion = data.fecha_expedicion;
        this.recipe.nombre_tipo_med = data.nombre_tipo_med;
        this.recipe.medicamento = data.medicamento;
      } else {
        this.id = 0;
        this.tituloModal = "Crear recipe";
        this.recipe.indicaciones = "";
        this.recipe.fecha_expedicion = "";
        this.recipe.nombre_tipo_med = "";
        this.recipe.medicamento = "";
      }
    },
    cerrarModal() {
      this.modal = 0;
      this.modalRecipe = false;
    },

    async seleccionarMedicamentos() {
      const res = await axios.get("/medicamentos");
      this.medicamentoss = res.data;
    },

    /* **************Modal Ver Persona********************** */
    /* **************Modal Ver Persona********************** */
    /* **************Modal Ver Persona********************** */
    /* **************Modal Ver Persona********************** */

    abrirVerPersona() {
      this.modalVerPersona = true;
      this.verPer = 1;
      console.log(this.modalVerPersona, this.verPer);
    },

    /* //////////////Modal Ver Recipe//////////////////////// */
    /* //////////////Modal Ver Recipe//////////////////////// */
    /* //////////////Modal Ver Recipe//////////////////////// */
    /* //////////////Modal Ver Recipe//////////////////////// */
    /* //////////////Modal Ver Recipe//////////////////////// */

    abrirVerRecipe() {
      this.verRecipe = true;
      this.modal = 1;
    },

    /* ///////////////////////Modal de nuevaConsulta////////////////////////////// */
    /* ///////////////////////Modal de nuevaConsulta////////////////////////////// */
    /* ///////////////////////Modal de nuevaConsulta////////////////////////////// */
    /* ///////////////////////Modal de nuevaConsulta////////////////////////////// */
    /* ///////////////////////Modal de nuevaConsulta////////////////////////////// */
    /* ///////////////////////Modal de nuevaConsulta////////////////////////////// */

    abrirNuevaConsulta() {
      this.modalNuevaConsulta = true;
      this.modal = 1;
    },

    /* *****************Modal Editar Consulta********************* */
    /* *****************Modal Editar Consulta********************* */
    /* *****************Modal Editar Consulta********************* */
    /* *****************Modal Editar Consulta********************* */
    /* *****************Modal Editar Consulta********************* */

    abrirEditarConsulta() {
      this.modalEditarConsulta = true;
      this.modal = 1;
    },

    /* /////////////// Modal Nuevo Tratamiento////////////////// */
    /* /////////////// Modal Nuevo Tratamiento////////////////// */
    /* /////////////// Modal Nuevo Tratamiento////////////////// */
    /* /////////////// Modal Nuevo Tratamiento////////////////// */

    abrirNuevoTratamiento() {
      this.modalNuevoTratamiento = true;
      this.modal = 1;
    },

    /* **************Modal Editar Tratamiento***************** */
    /* **************Modal Editar Tratamiento***************** */
    /* **************Modal Editar Tratamiento***************** */
    /* **************Modal Editar Tratamiento***************** */

    abrirEditarTratamiento() {
      this.modalEditarTratamiento = true;
      this.modal = 1;
    },

    /* ///////////////Modal Ver Tratamiento//////////////////// */
    /* ///////////////Modal Ver Tratamiento//////////////////// */
    /* ///////////////Modal Ver Tratamiento//////////////////// */
    /* ///////////////Modal Ver Tratamiento//////////////////// */
    /* ///////////////Modal Ver Tratamiento//////////////////// */
    /* ///////////////Modal Ver Tratamiento//////////////////// */

    abrirVerTratamiento() {
      this.verTratamiento = true;
      this.modal = 1;
    },

    /* /////////////Modal Nuevo Diagnostico //////////////////// */
    /* /////////////Modal Nuevo Diagnostico //////////////////// */
    /* /////////////Modal Nuevo Diagnostico //////////////////// */
    /* /////////////Modal Nuevo Diagnostico //////////////////// */

    abrirNuevoDiagnostico() {
      this.modalNuevoDiagnostico = true;
      this.modal = 1;
    },

    /* ////////////Modal Ver Diagnostico//////////////////////// */
    /* ////////////Modal Ver Diagnostico//////////////////////// */
    /* ////////////Modal Ver Diagnostico//////////////////////// */
    /* ////////////Modal Ver Diagnostico//////////////////////// */

    abrirVerDiagnostico() {
      this.verDiagnostico = true;
      this.modal = 1;
    },

    /* ///////////Modal Editar Diagnostico///////////////////// */
    /* ///////////Modal Editar Diagnostico///////////////////// */
    /* ///////////Modal Editar Diagnostico///////////////////// */
    /* ///////////Modal Editar Diagnostico///////////////////// */
    /* ///////////Modal Editar Diagnostico///////////////////// */

    abrirEditarDiagnostico() {
      this.editarDiagnostico = true;
      this.modal = 1;
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
tr:hover {
  cursor: pointer;
}
</style>