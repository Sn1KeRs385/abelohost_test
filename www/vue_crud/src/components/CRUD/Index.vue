<template>
  <div>
    <div class="table-header">
      <b-button
          class="table-header-add-button"
          variant="success"
          @click="onCreateRecord"
      >
        Создать запись
      </b-button>
      <b-pagination
          v-model="meta.current_page"
          :total-rows="meta.total"
          :per-page="meta.per_page"
          @change="loadData"
      />
    </div>
    <b-table
        hover
        :items="items"
        :fields="model.table.fields"
    >
      <template v-slot:cell(action)="{ item }">
        <div class="action-container">
          <b-button
              variant="success"
              class="action-container-button"
              @click="onShowClicked(item)"
          >
            <b-icon icon="eye"></b-icon>
          </b-button>

          <b-button
              variant="warning"
              class="action-container-button"
              @click="onEditClicked(item)"
          >
            <b-icon icon="gear"></b-icon>
          </b-button>

          <b-button
              variant="danger"
              class="action-container-button"
              @click="onDeleteClicked(item)"
          >
            <b-icon icon="x-circle"></b-icon>
          </b-button>

        </div>
      </template>
    </b-table>
    <b-modal
        :id="formModalId"
        :title="model.name"
        hide-footer
        hide-header
        size="xl"
    >
      <Form
          :model="modelClone"
          :id="modelId"
          :on-close-button="onCloseFormModal"
          :on-save-button="onSaveFormModal"
          :can-edit="canEditForm"
          ref="form"
      />
    </b-modal>
  </div>
</template>

<script>
import axios from "axios";
import Form from "./Form";
import _ from 'lodash'

export default {
  name: 'CRUDIndex',
  props: {
    model: {
      type: Object,
      required: true,
    }
  },
  data() {
    return {
      modelClone: _.cloneDeep(this.model),
      modelId: null,
      formModalId: "form",
      canEditForm: false,

      items: [],
      meta: {
        current_page: 1,
        per_page: 25,
        total: 1,
      },
    }
  },
  created() {
    this.model.table.fields.push({
      key: "action",
      label: "Действия"
    });
    this.loadData();
  },
  methods: {
    async loadData(page = null) {
      let response = await axios.get(`http://${process.env.VUE_APP_API_URL}/api/crud/${this.model.url}?page=${page || this.meta.current_page}`)
          .catch((error) => {
            this.showErrors(error);
          });

      this.items = response.data.data;
      this.meta.current_page = response.data.current_page;
      this.meta.per_page = response.data.per_page;
      this.meta.total = response.data.total;
    },
    async loadDataToFormComponent(id, canEdit = false) {
      this.modelClone = _.cloneDeep(this.model);
      this.modelId = id;
      this.canEditForm = canEdit;

      if (id) {
        let response = await axios.get(`http://${process.env.VUE_APP_API_URL}/api/crud/${this.model.url}/${id}`)
            .catch((error) => {
              this.showErrors(error);
            });
        Object.keys(response.data).forEach(key => {
          let field = this.modelClone.form.fields.find(item => item.key === key);
          if(field){
            field.value = response.data[key];
          }
        });
      }
    },
    showErrors(error){
      this.$bvToast.toast('Лень делать обработчик в тестовом задании, загляните в консоль)', {
        title: 'Возникла ошибка на сервере',
        autoHideDelay: 3000,
        variant: 'danger',
      })
      console.log("Возникла ошибка", error);
    },
    async onShowClicked(cell) {
      await this.loadDataToFormComponent(cell.id);
      this.$bvModal.show(this.formModalId);
    },
    async onEditClicked(cell) {
      await this.loadDataToFormComponent(cell.id, true);
      this.$bvModal.show(this.formModalId);
    },
    async onDeleteClicked(cell) {
      await axios.delete(`http://${process.env.VUE_APP_API_URL}/api/crud/${this.model.url}/${cell.id}`)
          .catch((error) => {
            this.showErrors(error);
          });
      this.loadData();
    },
    onCloseFormModal() {
      this.$bvModal.hide(this.formModalId);
    },
    onSaveFormModal() {
      this.loadData();
      this.onCloseFormModal();
    },
    async onCreateRecord() {
      await this.loadDataToFormComponent(null, true);
      this.$bvModal.show(this.formModalId);
    }
  },
  components: {
    Form,
  }
}
</script>

<style scoped>
.action-container {
  display:flex;
  justify-content: center;
}
.action-container-button {
  margin-left: 5px;
  margin-right: 5px;
}
.table-header {
  margin-top: 15px;
  display: flex;
  justify-content: space-between;
  height: 38px;
}
.table-header-add-button {
  height: 37px;
}
</style>