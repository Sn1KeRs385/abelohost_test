<template>
  <div>
    <b-navbar type="dark" variant="dark">
      <b-navbar-nav>
        <b-button v-b-toggle.sidebar-menu>
          <b-icon icon="justify-left"></b-icon>
        </b-button>
      </b-navbar-nav>

      <b-navbar-nav class="ml-auto">
        <b-nav-item href="/">
          Abelohost CRUD example
        </b-nav-item>
      </b-navbar-nav>
    </b-navbar>
    <b-sidebar id="sidebar-menu" title="Меню" shadow>
      <div class="px-3 py-2">
        <nav class="mb-3">
          <b-nav vertical>
            <b-nav-item
                v-for="model in models"
                :href="`/crud/${model.url}/index`"
                v-bind:key="`drop_item_${model.url}`"
            >
              {{ model.name }}
            </b-nav-item>
          </b-nav>
        </nav>
      </div>
    </b-sidebar>
  </div>
</template>

<script>

import models from "../../models";

export default {
  name: 'MainHeader',
  data() {
    return {
      models,
    }
  }
}
</script>