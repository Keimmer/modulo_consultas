import Vue from 'vue';
export default new Vue({
  methods: {
    open(component, props = {}) {
      return new Promise((resolve, reject) => {
        this.$emit('open', { component, props, resolve, reject });
      });
    },
    recievedata(data){
      this.$emit('send', { data });
    },
    recieveEspecialidad(especialidades){
      this.$emit('especialidades', { especialidades });
    },
    recieveSintomas(sintomas){
      this.$emit('sintomas', { sintomas });
    },
    recieveHabitos(habitos){
      this.$emit('habitos', { habitos });
    },
    recieveProcesos(procesos){
      this.$emit('procesos', { procesos });
    },
    recieveCons(consultas){
      this.$emit('consultas', { consultas });
    },
  }
})