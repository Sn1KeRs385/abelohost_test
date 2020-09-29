<template>
  <div class="wrapper">

      <Header/>

      <section class="section-container">
        <router-view/>
      </section>

  </div>
</template>

<script>
import Header from './MainHeader'

export default {
  name: 'MainLayout',
  components: {
    Header,
  }
}
</script>