<template>
  <div class="flex justify-center items-center min-h-screen bg-gray-100">
    <div class="w-full max-w-md p-8 bg-white rounded-lg shadow-lg">
      <!-- Aquí se renderizarán las vistas según la ruta -->
      <router-view></router-view>
    </div>
  </div>
</template>

<script lang="ts">
export default {
  name: 'App',
};
</script>

<style scoped>
/* Aquí puedes incluir estilos específicos para este componente */
</style>

