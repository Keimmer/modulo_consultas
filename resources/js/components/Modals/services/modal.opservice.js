import Vue from 'vue';
export default new Vue({
  methods: {
    editcons(data){
      this.$emit('editcons', { data });
    },
    editdiag(data) {
      this.$emit('editdiag', { data });
    },
    edittrat(data) {
      this.$emit('edittrat', { data });
    },
    editrec(data) {
      this.$emit('editrec', { data });
    }
  }
})