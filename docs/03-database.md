# 03 - Database Design

## Objetivo

Este documento define el modelo de datos relacional de **House Simulator**.

El diseño de la base de datos sigue el modelo de dominio definido en `02-domain-model.md` y prioriza:

* Simplicidad.
* Extensibilidad.
* Normalización.
* Facilidad para incorporar nuevos dispositivos.

---

# Principios de diseño

La base de datos se basa en los siguientes principios:

* Todos los sensores se almacenan en una única tabla.
* Todos los actuadores se almacenan en una única tabla.
* Los tipos de sensores y actuadores se gestionan mediante tablas independientes.
* Los estados válidos de cada actuador se modelan de forma relacional.
* Todas las lecturas de sensores se almacenan en una única tabla.
* Cada dispositivo pertenece a una única zona.
* Cada zona pertenece a una única vivienda.

---

# Diagrama conceptual

```text
House
│
└── Zone
    ├── Sensor
    │   ├── SensorType
    │   └── SensorReading
    │
    └── Actuator
        ├── ActuatorType
        └── ActuatorState
```

---

# Tablas

## houses

Representa una vivienda.

Aunque la primera versión del proyecto únicamente gestionará una vivienda, el modelo queda preparado para soportar múltiples viviendas en el futuro.

### Campos

| Campo      | Tipo      |
| ---------- | --------- |
| id         | bigint    |
| name       | string    |
| created_at | timestamp |
| updated_at | timestamp |

---

## zones

Representa una estancia o zona física de la vivienda.

### Campos

| Campo       | Tipo          |
| ----------- | ------------- |
| id          | bigint        |
| house_id    | bigint        |
| name        | string        |
| description | text nullable |
| created_at  | timestamp     |
| updated_at  | timestamp     |

### Relaciones

* Pertenece a una vivienda.
* Tiene muchos sensores.
* Tiene muchos actuadores.

---

## sensor_types

Define el comportamiento común de cada tipo de sensor.

### Campos

| Campo                     | Tipo      |
| ------------------------- | --------- |
| id                        | bigint    |
| name                      | string    |
| unit                      | string    |
| sampling_interval_seconds | integer   |
| created_at                | timestamp |
| updated_at                | timestamp |

### Datos iniciales

| Nombre      | Unidad | Intervalo |
| ----------- | ------ | --------: |
| Temperature | °C     |        10 |
| Humidity    | %      |      1800 |

---

## sensors

Representa un sensor instalado en una zona.

### Campos

| Campo          | Tipo      |
| -------------- | --------- |
| id             | bigint    |
| zone_id        | bigint    |
| sensor_type_id | bigint    |
| name           | string    |
| enabled        | boolean   |
| created_at     | timestamp |
| updated_at     | timestamp |

### Relaciones

* Pertenece a una zona.
* Pertenece a un tipo de sensor.
* Tiene muchas lecturas.

---

## sensor_readings

Almacena el histórico completo de lecturas de todos los sensores.

No existen tablas específicas para temperatura o humedad.

### Campos

| Campo       | Tipo          |
| ----------- | ------------- |
| id          | bigint        |
| sensor_id   | bigint        |
| value       | decimal(10,2) |
| recorded_at | timestamp     |
| created_at  | timestamp     |

### Relaciones

* Pertenece a un sensor.

---

## actuator_types

Define los distintos tipos de actuadores soportados por el sistema.

### Campos

| Campo      | Tipo      |
| ---------- | --------- |
| id         | bigint    |
| name       | string    |
| created_at | timestamp |
| updated_at | timestamp |

### Datos iniciales

| Nombre |
| ------ |
| Light  |
| Blind  |

---

## actuator_states

Define los estados válidos para cada tipo de actuador.

Cada tipo de actuador tendrá asociados uno o varios estados posibles.

### Campos

| Campo            | Tipo      |
| ---------------- | --------- |
| id               | bigint    |
| actuator_type_id | bigint    |
| code             | string    |
| name             | string    |
| created_at       | timestamp |
| updated_at       | timestamp |

### Relaciones

* Pertenece a un tipo de actuador.

### Datos iniciales

#### Light

| Code | Nombre    |
| ---- | --------- |
| off  | Apagada   |
| on   | Encendida |

#### Blind

| Code   | Nombre        |
| ------ | ------------- |
| up     | Subida        |
| down   | Bajada        |
| moving | En movimiento |

---

## actuators

Representa un actuador instalado en una zona.

### Campos

| Campo             | Tipo      |
| ----------------- | --------- |
| id                | bigint    |
| zone_id           | bigint    |
| actuator_type_id  | bigint    |
| actuator_state_id | bigint    |
| name              | string    |
| enabled           | boolean   |
| created_at        | timestamp |
| updated_at        | timestamp |

### Relaciones

* Pertenece a una zona.
* Pertenece a un tipo de actuador.
* Tiene un estado actual.

---

# Relaciones

```text
House
 │
 └── Zone
      ├── Sensor
      │     ├── SensorType
      │     └── SensorReading
      │
      └── Actuator
            ├── ActuatorType
            └── ActuatorState
```

---

# Índices

Se recomienda crear índices para los siguientes campos.

## zones

* house_id

## sensors

* zone_id
* sensor_type_id

## sensor_readings

* sensor_id
* recorded_at

## actuator_states

* actuator_type_id

## actuators

* zone_id
* actuator_type_id
* actuator_state_id

---

# Integridad referencial

El modelo deberá garantizar las siguientes reglas:

* Una zona no puede existir sin una vivienda.
* Un sensor no puede existir sin una zona.
* Todo sensor debe pertenecer a un tipo de sensor.
* Toda lectura debe pertenecer a un sensor.
* Un actuador no puede existir sin una zona.
* Todo actuador debe pertenecer a un tipo de actuador.
* Todo actuador debe encontrarse en uno de los estados permitidos para su tipo.

---

# Datos iniciales

Durante la instalación del proyecto se crearán automáticamente los siguientes registros.

## Vivienda

* 1 vivienda.

## Zonas

* Salón.
* Habitación Principal.
* Habitación Secundaria.
* Cocina.
* Patio.

## Tipos de sensores

* Temperature.
* Humidity.

## Tipos de actuadores

* Light.
* Blind.

## Estados de actuadores

### Light

* Off.
* On.

### Blind

* Up.
* Down.
* Moving.

## Sensores

* 4 sensores de temperatura.
* 8 sensores de humedad.

## Actuadores

* 7 luces.
* 5 persianas.

---

# Escalabilidad

El modelo ha sido diseñado para crecer sin modificaciones estructurales.

La incorporación de un nuevo dispositivo únicamente requiere:

1. Crear el tipo correspondiente (`sensor_types` o `actuator_types`).
2. Registrar los estados válidos si se trata de un actuador (`actuator_states`).
3. Dar de alta los nuevos dispositivos.
4. Implementar la lógica de simulación asociada, si fuera necesaria.

En ningún caso será necesario crear nuevas tablas para soportar nuevos tipos de sensores o actuadores.

---

# Decisiones de diseño

Las siguientes decisiones forman parte de la arquitectura del modelo de datos:

* Existe una única tabla de sensores.
* Existe una única tabla de actuadores.
* Existe una única tabla para todas las lecturas de sensores.
* Los tipos de dispositivos son entidades persistentes y no valores codificados en la aplicación.
* Los estados válidos de los actuadores se almacenan de forma relacional mediante la tabla `actuator_states`.
* El estado actual de un actuador se representa mediante una clave foránea hacia `actuator_states`, garantizando que únicamente pueda adoptar estados válidos para su tipo.
