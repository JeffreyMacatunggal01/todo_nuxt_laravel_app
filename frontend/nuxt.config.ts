// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  devtools: { enabled: true },
  ssr: false,
  pages: true,
  css: ["~/assets/css/main.css", "@fortawesome/fontawesome-svg-core/styles.css"],
  postcss: {
    plugins: {
      tailwindcss: {},
      autoprefixer: {},
    },
  },
  modules: ["@nuxtjs/apollo"],
  apollo: {
    clients: {
      default: {
        httpEndpoint: process.env.API_BASE_URL || "http://localhost:8000/graphql",
      },
    },
  },
  build: {
    transpile: ["@fortawesome/fontawesome-svg-core", "@fortawesome/free-solid-svg-icons"],
  },
});
