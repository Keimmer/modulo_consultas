<template>
  <section :class="{ 'modal-root': modal.component }">
    <transition name="modal">
      <component 
        v-if="modal"
        :is="modal.component"
        v-bind:close="modal.close"
        v-bind:dismiss="modal.dismiss"
        v-bind="modal.props"
        :class="{ 'd-block': modal.component }"
      />
    </transition>
  </section>
</template>

<script>
import ModalService from './services/modal.service';
import Modal from './Modal.vue';
export default {
  components: { Modal },
  data() {
    return {
      modal: {},
    }
  },
  created() {
    ModalService.$on('open', ({ component, props, resolve, reject }) => {
      this.modal = {
        component,
        props,
        close: value => {
          this.modal = {};
          resolve(value);
        },
        dismiss: reason => {
          this.modal = {};
          reject(reason);
        },
      };
    });
    ModalService.$on('send', ({ data }) => {
      this.modal.props = { data }
    })
  }
}
</script>

<style scoped>
.modal-root {
  position: fixed;
  top: 0;
  z-index: 100;
  width: 110%;
  height: 110%;
  background-color: rgba(1, 1, 1, 0.2);
}
.modal-enter-active,
.modal-leave-active {
  transition: all 0.25s ease-out;
}
.modal-enter,
.modal-leave-to {
  transform: translateY(25px);
  opacity: 0;
}
</style>