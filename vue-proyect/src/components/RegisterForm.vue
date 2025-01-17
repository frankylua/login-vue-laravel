<template>
  <div class="w-full max-w-md p-8 bg-white rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold mb-4">Registro</h2>
    <form @submit="handleRegister">
      <!-- Nombre -->
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2">Nombre</label>
        <input v-model="name" type="text" class="w-full px-3 py-2 border rounded" required />
      </div>

      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2">Apellido</label>
        <input v-model="apellido" type="text" class="w-full px-3 py-2 border rounded" required />
      </div>

      <!-- Correo Electrónico -->
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2">Correo Electrónico</label>
        <input v-model="email" type="text" class="w-full px-3 py-2 border rounded" required />
      </div>

      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2">Teléfono</label>
        <input v-model="telefono" type="text" class="w-full px-3 py-2 border rounded" />
      </div>

      <!-- Contraseña -->
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2">Contraseña</label>
        <input v-model="password" type="password" class="w-full px-3 py-2 border rounded" required />
      </div>

      <!-- Confirmar Contraseña -->
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2">Confirmar Contraseña</label>
        <input v-model="confirmPassword" type="password" class="w-full px-3 py-2 border rounded" required />
      </div>

      <!-- Botón de Registro -->
      <div class="mb-4">
        <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-700">
          Registrar
        </button>
      </div>
    </form>

    <!-- Mensajes de Error o Éxito -->
    <div v-if="errorMessage" class="text-red-600 text-sm mt-4">{{ errorMessage }}</div>
    <div v-if="successMessage" class="text-green-600 text-sm mt-4">{{ successMessage }}</div>

    <!-- Enlace a Login -->
    <div class="text-center mt-4">
      <p class="text-sm text-gray-600">
        ¿Ya tienes una cuenta?
        <router-link to="/login" class="text-blue-500 hover:underline">
          Ingresa aquí
        </router-link>
      </p>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent } from "vue";
import axios from "axios";

export default defineComponent({
  name: "RegisterForm",
  data() {
    return {
      name: "",
      apellido: "",
      email: "",
      telefono: "",
      password: "",
      confirmPassword: "",
      errorMessage: "",
      successMessage: "",
    };
  },
  methods: {
    async handleRegister(event: Event) {
      event.preventDefault(); // Evita la recarga de la página al hacer submit

      // Validación básica para verificar que las contraseñas coincidan
      if (this.password !== this.confirmPassword) {
        this.errorMessage = "Las contraseñas no coinciden.";
        return;
      }

      try {
  // Enviar los datos de registro al backend
  const response = await axios.post("http://localhost:8000/api/register", {
    name: this.name,
    apellido:this.apellido,
    email: this.email,
    telefono:this.telefono,
    password: this.password,
    password_confirmation: this.confirmPassword,
  });

  // Mostrar mensaje de éxito
  this.successMessage = "¡Registro exitoso! Redirigiendo a Login...";
  this.errorMessage = "";

  // Redirigir al login después de 2 segundos
  setTimeout(() => {
    this.$router.push("/login");
  }, 2000);
} catch (error: unknown) {
  // Verificar si el error es un error de Axios
  if (axios.isAxiosError(error)) {
    if (error.response) {
      // Errores específicos del backend (código 422 o similar)
      if (error.response.status === 422) {
        const validationErrors = error.response.data.errors; // Capturar errores de validación
        this.errorMessage = "Errores en los campos: " + JSON.stringify(validationErrors);
      } else {
        // Otros errores del servidor
        this.errorMessage =
          error.response.data.message || `Error en el servidor: ${error.response.status}`;
      }
    } else if (error.request) {
      // Errores relacionados con la solicitud (sin respuesta del servidor)
      this.errorMessage = "No se recibió respuesta del servidor. Por favor, verifica tu conexión.";
    } else {
      // Errores al configurar la solicitud
      this.errorMessage = `Error en la configuración de la solicitud: ${error.message}`;
    }
  } else {
    // Error no relacionado con Axios
    this.errorMessage = "Ocurrió un error inesperado.";
  }

  this.successMessage = ""; // Limpiar mensajes de éxito
  console.error("Error en el registro:", error);
}

    },
  },
});
</script>
