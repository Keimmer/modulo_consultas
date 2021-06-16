<template>
  <div v-if="isSelected" class="container">
    <slot></slot>
  </div>
</template>
<script>
export default {
  props: {
    isSelected: {
      type: Boolean,
    },
  },
}
</script>