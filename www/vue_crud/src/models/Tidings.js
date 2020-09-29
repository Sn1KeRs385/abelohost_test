export default {
  name: "Новости",
  url: "tidings",

  table: {
    fields: [
      {
        key: "id",
        label: "#",
      },
      {
        key: "name",
        label: "Название",
      },
      {
        key: "text",
        label: "Текст",
      },
    ],
  },
  form: {
    fields: [
      {
        label: 'Название',
        type: 'text',
        placeholder: 'Название',
        key: 'name',
        value: null,
      },
      {
        label: 'Текст',
        type: 'textarea',
        rows: 20,
        placeholder: 'Текст',
        key: 'text',
        value: null,
      },
    ]
  },
}
