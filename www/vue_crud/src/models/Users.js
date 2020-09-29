export default {
  name: "Пользователи",
  url: "users",

  table: {
    fields: [
      {
        key: "id",
        label: "#",
      },
      {
        key: "name",
        label: "Логин",
      },
      {
        key: "email",
        label: "email",
      },
      {
        key: "last_name",
        label: "Фамилия",
      },
      {
        key: "first_name",
        label: "Имя",
      },
      {
        key: "patronymic",
        label: "Отчество",
      },
    ],
  },
  form: {
    fields: [
      {
        label: 'Логин',
        type: 'text',
        placeholder: 'Логин',
        key: 'name',
        value: null,
      },
      {
        label: 'Эл. почта',
        type: 'text',
        placeholder: 'Эл. почта',
        key: 'email',
        value: null,
      },
      {
        label: 'Фамилия',
        type: 'text',
        placeholder: 'Фамилия',
        key: 'last_name',
        value: null,
      },
      {
        label: 'Имя',
        type: 'text',
        placeholder: 'Имя',
        key: 'first_name',
        value: null,
      },
      {
        label: 'Отчество',
        type: 'text',
        placeholder: 'Отчество',
        key: 'patronymic',
        value: null,
      },
    ]
  },
}
