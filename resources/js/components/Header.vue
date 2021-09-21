<template>
    <header class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <router-link class="navbar-brand" :to="{name: 'home'}" >
                        Boolpress
                </router-link>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item" v-for="(link, index) in menu" :key='index'>
                            <router-link class="nav-link" :to="{name: link.routeName}" >
                                {{link.label}}
                            </router-link>
                        </li>
                        
        
                    </ul>
                </div>
            </div>
        </nav>
       
    </header>
</template>


<script>
export default {
  name: "Header",
  data() {
      return {
          menu: [
                {
                    label: 'Home',
                    routeName: 'home',
                },
                {
                    label: 'Chi siamo',
                    routeName: 'about',
                },
                {
                    label: 'Contatti',
                    routeName: 'contact',
                },
                {
                    label: 'Post',
                    routeName: 'post',
                    // nb: il routeName dell'Header.vue deve essere uguale al name di router.js
                },
          ]
      }
  }
}
</script>

<style lang="scss" scoped>
</style>