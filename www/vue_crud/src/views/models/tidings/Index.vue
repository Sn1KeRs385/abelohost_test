<template>
  <div>
    <Index
      :model="model"
    />
  </div>
</template>

<script>
import Index from "../../../components/CRUD/Index";
import model from "../../../models/Tidings";

export default {
  name: 'TidingsIndex',
  components: {
    Index,
  },
  data() {
    return {
      model,
    }
  }
}
</script>