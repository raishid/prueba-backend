
# Proyecto Prueba Tenica Crud

Proyecto realizado utilizando arquitectura MVC


## Rutas

Adjunto las rutas de las Api para poder realizar las solcitudes



## API Reference

#### Obtener Usuarios

```http
  GET /users
```

#### Obtener 1 usuario

```http
  GET /users/{id}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `string` | **Required**. requerido para listar|

#### Crear usuario

```http
  POST /users
```
#### Body Parameters
| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `fullname` | `string` | **Required**. nombre        |
| `pass`      | `string` | **Required**. contraseña        |
| `email`      | `string` | **Required**. email            |

#### Editar usuario

```http
  PATCH /users/{id}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`  | `string` |   **Required**. id del usuario       |

#### Body Parameters
| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `fullname`  | `string` | nombre        |
| `pass`      | `string` | contraseña        |
| `email`      | `string` | email            |


#### Obtener Comentarios

```http
  GET /comments
```

#### Obtener 1 comentario

```http
  GET /comments/{id}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `string` | **Required**. requerido para listar|

#### Crear comentario

```http
  POST /comments
```
#### Body Parameters

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `coment_text` | `string` | **Required**. texto del comentario |
| `user`      | `string` | **Required**. id del usuario    |

#### Editar Comenario

```http
  PATCH /comments/{id}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`  | `string` |   **Required**. id del comentario       |

#### Body Parameters
| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `coment_text`  | `string` |  texto del comentario        |

#### Agregar 1 Like a comentario

```http
  PATCH /comments/{id}/like
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`  | `string` |   **Required**. id del comentario     |


#### Quitar 1 Like a comentario

```http
  PATCH /comments/{id}/like-remove
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`  | `string` |   **Required**. id del comentario     |

## Respuesta de Ejemplo

### Users

```json 
[
    {
        "id": 1,
        "fullname": "Raishid",
        "email": "raishidavid@gmail.com",
        "openid": "a1b64e01-0c27-446d-85d0-d4d9f60eae0f",
        "comments": [
            {
            "id": 2,
            "coment_text": "eres un idolo!!",
            "likes": 0,
            "creation_date": "2024-03-21T03:34:40.000000Z",
            "update_date": "2024-03-21T03:34:40.000000Z"
            },
            {
            "id": 1,
            "coment_text": "hello how are you?",
            "likes": 0,
            "creation_date": "2024-03-21T02:53:15.000000Z",
            "update_date": "2024-03-21T03:34:11.000000Z"
            }
        ],
        "creation_date": "2024-03-21T02:48:12.000000Z",
        "update_date": "2024-03-21T03:17:53.000000Z"
    }
]
```

### Comments

```json 
[
  {
    "id": 1,
    "coment_text": "hello how are you2?",
    "likes": 0,
    "user": {
      "id": 1,
      "fullname": "Raishid",
      "email": "raishidavid@gmail.com",
      "openid": "a1b64e01-0c27-446d-85d0-d4d9f60eae0f",
      "creation_date": "2024-03-21T02:48:12.000000Z",
      "update_date": "2024-03-21T03:17:53.000000Z"
    },
    "creation_date": "2024-03-21T02:53:15.000000Z",
    "update_date": "2024-03-21T03:34:11.000000Z"
  },
  {
    "id": 2,
    "coment_text": "eres un idolo!!",
    "likes": 0,
    "user": {
      "id": 1,
      "fullname": "Raishid",
      "email": "raishidavid@gmail.com",
      "openid": "a1b64e01-0c27-446d-85d0-d4d9f60eae0f",
      "creation_date": "2024-03-21T02:48:12.000000Z",
      "update_date": "2024-03-21T03:17:53.000000Z"
    },
    "creation_date": "2024-03-21T03:34:40.000000Z",
    "update_date": "2024-03-21T04:06:13.000000Z"
  }
]
```

