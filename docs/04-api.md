# 04 - REST API Design

## Objetivo

Este documento define el diseño de la API REST de **House Simulator**.

La API constituye el único punto de acceso al sistema y permite consultar el estado de la vivienda simulada, acceder al histórico de sensores e interactuar con los actuadores.

La API está diseñada siguiendo principios REST y priorizando la simplicidad, la consistencia y la extensibilidad.

---

# Principios de diseño

La API sigue las siguientes directrices:

* Los recursos representan entidades del dominio.
* Los nombres de los recursos siempre se expresan en plural.
* Todas las respuestas utilizan JSON.
* La API estará versionada desde su primera versión.
* Los sensores son recursos de solo lectura.
* Las lecturas de sensores son recursos de solo lectura.
* Los actuadores son recursos modificables.
* La incorporación de nuevos dispositivos no debe requerir nuevos endpoints.

---

# Versionado

Todas las rutas estarán agrupadas bajo el prefijo:

```text
/api/v1
```

Esto permitirá introducir futuras versiones sin romper la compatibilidad con clientes existentes.

---

# Recursos

La API expone los siguientes recursos.

| Recurso         | Descripción                                    |
| --------------- | ---------------------------------------------- |
| Houses          | Viviendas disponibles.                         |
| Zones           | Zonas pertenecientes a una vivienda.           |
| Sensor Types    | Tipos de sensores soportados.                  |
| Sensors         | Sensores instalados.                           |
| Sensor Readings | Histórico de lecturas.                         |
| Actuator Types  | Tipos de actuadores soportados.                |
| Actuator States | Estados permitidos para cada tipo de actuador. |
| Actuators       | Actuadores instalados.                         |

---

# Houses

## Obtener todas las viviendas

```http
GET /api/v1/houses
```

---

## Obtener una vivienda

```http
GET /api/v1/houses/{id}
```

---

## Obtener el estado completo de la vivienda

```http
GET /api/v1/houses/{id}/snapshot
```

Este endpoint devuelve una fotografía completa del estado actual de la vivienda, incluyendo:

* zonas;
* sensores;
* última lectura de cada sensor;
* actuadores;
* estado actual de cada actuador.

Su objetivo es facilitar que una aplicación cliente pueda representar toda la vivienda realizando una única petición HTTP.

---

# Zones

## Obtener todas las zonas

```http
GET /api/v1/zones
```

---

## Obtener una zona

```http
GET /api/v1/zones/{id}
```

---

## Obtener sensores de una zona

```http
GET /api/v1/zones/{id}/sensors
```

---

## Obtener actuadores de una zona

```http
GET /api/v1/zones/{id}/actuators
```

---

# Sensor Types

## Obtener todos los tipos

```http
GET /api/v1/sensor-types
```

---

## Obtener un tipo

```http
GET /api/v1/sensor-types/{id}
```

---

## Obtener sensores de un tipo

```http
GET /api/v1/sensor-types/{id}/sensors
```

---

# Sensors

Los sensores son recursos de solo lectura.

## Obtener todos los sensores

```http
GET /api/v1/sensors
```

### Filtros disponibles

| Parámetro | Descripción                   |
| --------- | ----------------------------- |
| zone      | Filtrar por zona.             |
| type      | Filtrar por tipo de sensor.   |
| enabled   | Filtrar por estado operativo. |

Ejemplos:

```http
GET /api/v1/sensors?zone=1
GET /api/v1/sensors?type=temperature
GET /api/v1/sensors?enabled=true
```

---

## Obtener un sensor

```http
GET /api/v1/sensors/{id}
```

---

## Obtener la última lectura

```http
GET /api/v1/sensors/{id}/latest-reading
```

Devuelve únicamente la lectura más reciente del sensor.

---

## Obtener histórico

```http
GET /api/v1/sensors/{id}/readings
```

---

# Sensor Readings

## Obtener lecturas

```http
GET /api/v1/sensor-readings
```

### Filtros disponibles

| Parámetro | Descripción                  |
| --------- | ---------------------------- |
| sensor    | Sensor asociado.             |
| from      | Fecha inicial.               |
| to        | Fecha final.                 |
| limit     | Número máximo de resultados. |

Ejemplos:

```http
GET /api/v1/sensor-readings?sensor=3

GET /api/v1/sensor-readings?from=2026-01-01T00:00:00Z

GET /api/v1/sensor-readings?limit=100
```

---

## Obtener una lectura

```http
GET /api/v1/sensor-readings/{id}
```

---

# Actuator Types

## Obtener tipos

```http
GET /api/v1/actuator-types
```

---

## Obtener un tipo

```http
GET /api/v1/actuator-types/{id}
```

---

## Obtener actuadores del tipo

```http
GET /api/v1/actuator-types/{id}/actuators
```

---

# Actuator States

## Obtener estados

```http
GET /api/v1/actuator-states
```

---

## Obtener un estado

```http
GET /api/v1/actuator-states/{id}
```

---

# Actuators

Los actuadores representan los únicos recursos modificables del sistema.

## Obtener todos los actuadores

```http
GET /api/v1/actuators
```

### Filtros disponibles

| Parámetro | Descripción       |
| --------- | ----------------- |
| zone      | Zona.             |
| type      | Tipo de actuador. |
| enabled   | Estado operativo. |
| state     | Estado actual.    |

Ejemplos:

```http
GET /api/v1/actuators?type=light

GET /api/v1/actuators?state=on
```

---

## Obtener un actuador

```http
GET /api/v1/actuators/{id}
```

---

## Modificar estado

```http
PATCH /api/v1/actuators/{id}
```

Ejemplo para una luz:

```json
{
    "state": "on"
}
```

Ejemplo para una persiana:

```json
{
    "state": "down"
}
```

El servidor validará que el estado solicitado sea compatible con el tipo de actuador.

---

# Métodos HTTP

| Método | Uso                                 |
| ------ | ----------------------------------- |
| GET    | Consultar recursos.                 |
| PATCH  | Modificar el estado de un actuador. |

En la versión inicial de la API no existirán operaciones para crear o eliminar recursos mediante HTTP.

La configuración de la vivienda se considera parte del sistema y no podrá modificarse desde la API.

---

# Formato de las respuestas

Todas las respuestas utilizarán JSON.

Ejemplo de un actuador:

```json
{
    "id": 12,
    "name": "Luz principal",
    "type": "light",
    "state": "off",
    "zone": "Patio"
}
```

Ejemplo de una lectura:

```json
{
    "id": 15243,
    "sensor": "Temperatura Salón",
    "value": 22.8,
    "unit": "°C",
    "recorded_at": "2026-07-08T18:30:10Z"
}
```

---

# Snapshot de la vivienda

El endpoint:

```http
GET /api/v1/houses/{id}/snapshot
```

constituye el principal punto de entrada para las aplicaciones cliente.

La respuesta contendrá:

* información de la vivienda;
* listado de zonas;
* sensores de cada zona;
* última lectura disponible de cada sensor;
* actuadores de cada zona;
* estado actual de cada actuador.

Este recurso evita que un cliente tenga que realizar múltiples peticiones para representar el estado completo de la vivienda.

---

# Códigos de respuesta

| Código | Significado                         |
| ------ | ----------------------------------- |
| 200    | Solicitud completada correctamente. |
| 400    | Parámetros inválidos.               |
| 404    | Recurso no encontrado.              |
| 422    | Estado no válido para el actuador.  |
| 500    | Error interno del servidor.         |

---

# Extensibilidad

La API ha sido diseñada para crecer sin modificar su estructura.

La incorporación de un nuevo tipo de sensor o actuador únicamente requerirá:

* registrar el nuevo tipo en la base de datos;
* implementar su lógica de simulación;
* exponerlo mediante los recursos existentes.

No será necesario crear nuevos endpoints para cada nuevo dispositivo.

---

# Consideraciones futuras

Las siguientes funcionalidades quedan fuera del alcance de la primera versión, aunque el diseño de la API facilita su incorporación en el futuro:

* Autenticación y autorización.
* Paginación de resultados.
* Ordenación y filtrado avanzado.
* Inclusión de relaciones mediante parámetros (`include=`).
* WebSockets o Server-Sent Events para actualizaciones en tiempo real.
* API de administración para gestionar viviendas, zonas y dispositivos.
