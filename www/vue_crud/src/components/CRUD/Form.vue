<template>
  <div>
    <b-form>
      <div
          v-for="field in model.form.fields"
          v-bind:key="field.key"
      >
        <b-form-group
            :label="field.label"
        >
          <b-form-input
              v-if="field.type === 'text' || field.type === 'email'"
              :type="field.type"
              v-model="field.value"
              :disabled="!canEdit"
              :placeholder="field.placeholder"
          />
          <b-form-textarea
              v-if="field.type === 'textarea'"
              v-model="field.value"
              :rows="field.rows || 20"
              :placeholder="field.placeholder"
              :disabled="!canEdit"
          />
        </b-form-group>
      </div>
      <div class="button-container">
        <b-button
            v-if="canEdit"
            variant="primary"
            @click="save"
        >
          Сохранить
        </b-button>
        <b-button
            variant="danger"
            @click="onCloseButton"
        >
          Закрыть
        </b-button>
      </div>
    </b-form>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: 'CRUDIndex',
  props: {
    model: {
      type: Object,
      required: true,
    },
    onCloseButton: {
      type: Function,
      required: true,
    },
    onSaveButton: {
      type: Function,
      required: true,
    },
    canEdit: {
      type: Boolean,
      required: false,
      default: false,
    },
    id: {
      type: Number,
      required: false,
    }
  },
  methods: {
    showErrors(error){
      this.$bvToast.toast('Лень делать обработчик в тестовом задании, загляните в консоль)', {
        title: 'Возникла ошибка на сервере',
        autoHideDelay: 3000,
        variant: 'danger',
      })
      console.log("Возникла ошибка", error);
    },
    async save() {
      let data = {};
      this.model.form.fields.forEach(field => {
        data[field.key] = field.value;
      })
      if(this.id) {
        await axios.put(`http://${process.env.VUE_APP_API_URL}/api/crud/${this.model.url}/${this.id}`, data)
            .then(this.onSaveButton)
            .catch((error) => {
              this.showErrors(error);
            });
      } else {
        await axios.post(`http://${process.env.VUE_APP_API_URL}/api/crud/${this.model.url}`, data)
            .then(this.onSaveButton)
            .catch((error) => {
              this.showErrors(error);
            });
      }
    },
  }
}
</script>

<style scoped>
.button-container {
  display:flex;
  justify-content: flex-end;
}
.button-container button {
  margin-left: 3px;
  margin-right: 3px;
}
</style>