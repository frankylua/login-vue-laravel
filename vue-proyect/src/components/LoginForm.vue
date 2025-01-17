<template>
  
    <div class="w-full max-w-md p-8 bg-white rounded-lg shadow-lg">
      <h2 class="text-2xl font-bold mb-6  text-gray-800">Iniciar Sesión</h2>
          <!-- Mensaje de error general -->
    <div v-if="errorMessage" class="text-red-600 text-sm mb-4">{{ errorMessage }}</div>
      <form @submit.prevent="handleLogin">
        <div class="mb-4">
          <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Correo Electrónico</label>
          <input
            type="email"
            id="email"
            v-model="email"
            class="w-full px-3 py-2 border rounded"
            
          />
          <p v-if="errors.email" class="text-red-500 text-xs mt-1">{{ errors.email }}</p>
        </div>
        <div class="mb-6">
          <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Contraseña</label>
          <input
            type="password"
            id="password"
            v-model="password"
            class="w-full px-3 py-2 border rounded"            
          />
          <p v-if="errors.password" class="text-red-500 text-xs mt-1">{{ errors.password }}</p>
        </div>
        <button
          type="submit"
          class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400"
        >
          Iniciar Sesión
        </button>
      </form>
      <div class="text-center mt-4">
        <p class="text-sm text-gray-600">
          ¿No tienes una cuenta?
          <router-link to="/register" class="text-blue-500 hover:underline">
            Regístrate aquí
          </router-link>
        </p>
      </div>
    </div>
  
</template>

<script lang="ts">
import { defineComponent } from "vue";
import axios from "axios";

export default defineComponent({
  name: "LoginForm",
  data() {
    return {
      email: "",
      password: "",
      errorMessage: "", // Mensaje de error general
      errors: { // Validaciones específicas para los campos
        email: "",
        password: "",
      },
    };
  },
  methods: {
    validateInputs() {
      // Reiniciar mensajes de error
      this.errors.email = "";
      this.errors.password = "";
      let isValid = true;

      // Validar email
      if (!this.email) {
        this.errors.email = "El campo de correo electrónico es obligatorio.";
        isValid = false;
      } else if (!/\S+@\S+\.\S+/.test(this.email)) {
        this.errors.email = "Debe ser un correo electrónico válido.";
        isValid = false;
      }

      // Validar contraseña
      if (!this.password) {
        this.errors.password = "El campo de contraseña es obligatorio.";
        isValid = false;
      } else if (this.password.length < 6) {
        this.errors.password =
          "La contraseña debe tener al menos 6 caracteres.";
        isValid = false;
      }

      return isValid;
    },
    async handleLogin() {
      // Validar los inputs antes de realizar la solicitud
      if (!this.validateInputs()) {
        this.errorMessage = "Por favor corrige los errores en el formulario.";
        return;
      }

    

      try {
  const response = await axios.post("http://localhost:8000/api/login", {
    email: this.email,
    password: this.password,
  });

  // Si la autenticación es exitosa
  const token = response.data.token;
  localStorage.setItem("auth_token", token);
  alert("Inicio de sesión exitoso.");
  this.$router.push("/profile"); // Redirigir al perfil
} catch (error: unknown) {
  if (axios.isAxiosError(error)) {
    // Manejo de errores controlado
    this.errorMessage =
      error.response?.data?.message || "Credenciales incorrectas.";

  
  } else {
    // Error desconocido
    this.errorMessage = "Ocurrió un error inesperado.";
    console.error("Error inesperado:", error);
  }
}

    },
  },
});
</script>





