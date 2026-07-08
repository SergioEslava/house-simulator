# 01 - Project Overview

## Objetivo

**House Simulator** es una API REST desarrollada con Laravel 12 cuyo propósito es simular el comportamiento de una vivienda domotizada.

La aplicación mantiene el estado de una vivienda virtual formada por distintas zonas, sensores y actuadores, generando información de forma periódica y permitiendo la interacción con los distintos dispositivos mediante una API REST.

Este proyecto actúa exclusivamente como proveedor de datos para aplicaciones cliente externas. No incluye ninguna interfaz de usuario ni sistema de visualización.

---

# Objetivos funcionales

Los principales objetivos del proyecto son:

* Simular una vivienda domotizada.
* Generar datos periódicos de sensores virtuales.
* Mantener el estado de todos los actuadores.
* Almacenar el histórico de lecturas de los sensores.
* Exponer toda la información mediante una API REST.
* Facilitar la ampliación futura del sistema con nuevos tipos de dispositivos.

---

# Modelo conceptual

El dominio del proyecto se basa en tres conceptos principales:

* **Zona (Zone)**: representa una estancia o espacio de la vivienda.
* **Sensor (Sensor)**: dispositivo que genera información automáticamente.
* **Actuador (Actuator)**: dispositivo cuyo estado puede consultarse y modificarse.

En la documentación se utilizará el término **Dispositivo (Device)** para hacer referencia de forma genérica tanto a sensores como a actuadores.

```text
Device
├── Sensor
└── Actuator
```

---

# Distribución de la vivienda

La vivienda simulada está formada por cinco zonas.

## Salón

### Sensores

* Sensor de temperatura.

### Actuadores

* Luz de techo.
* Lámpara.
* Persiana.

---

## Habitación Principal

### Sensores

* Sensor de temperatura.

### Actuadores

* Luz de techo.
* Persiana.

---

## Habitación Secundaria

### Sensores

* Sensor de temperatura.

### Actuadores

* Luz de techo.
* Persiana.

---

## Cocina

### Sensores

* Sensor de temperatura.

### Actuadores

* Luz de techo.
* Persiana izquierda.
* Persiana derecha.

---

## Patio

### Sensores

* Ocho sensores de humedad para plantas.

### Actuadores

* Luz principal.
* Luz secundaria.

---

# Sensores

Los sensores son dispositivos encargados de generar lecturas de forma automática.

Cada sensor:

* pertenece a una única zona;
* dispone de un tipo;
* genera un histórico de lecturas;
* funciona de forma independiente del resto de sensores.

## Tipos de sensores

### Sensor de temperatura

Se instala un sensor en cada estancia interior de la vivienda.

Características:

* registra una lectura cada **10 segundos**;
* almacena todas sus lecturas;
* representa la temperatura de la estancia.

---

### Sensor de humedad

El patio dispone de ocho sensores independientes, uno por cada planta monitorizada.

Características:

* registra una lectura cada **30 minutos**;
* almacena todas sus lecturas;
* representa el nivel de humedad de la planta correspondiente.

---

# Actuadores

Los actuadores representan dispositivos cuyo estado puede consultarse y modificarse mediante la API.

Cada actuador:

* pertenece a una única zona;
* dispone de un tipo;
* mantiene un estado actual.

## Tipos de actuadores

### Light

Representa cualquier tipo de iluminación de la vivienda.

Estados posibles:

* `off`
* `on`

Operaciones disponibles:

* consultar estado;
* modificar estado.

---

### Blind

Representa una persiana motorizada.

Estados posibles:

* `up`
* `down`
* `moving`

Operaciones disponibles:

* consultar estado;
* modificar estado.

---

# Inventario de dispositivos

## Zonas

| Zona                  | Sensores | Actuadores |
| --------------------- | -------: | ---------: |
| Salón                 |        1 |          3 |
| Habitación Principal  |        1 |          2 |
| Habitación Secundaria |        1 |          2 |
| Cocina                |        1 |          3 |
| Patio                 |        8 |          2 |

---

## Resumen

| Elemento                 | Cantidad |
| ------------------------ | -------: |
| Zonas                    |        5 |
| Sensores de temperatura  |        4 |
| Sensores de humedad      |        8 |
| **Total de sensores**    |   **12** |
| Luces                    |        7 |
| Persianas                |        5 |
| **Total de actuadores**  |   **12** |
| **Dispositivos totales** |   **24** |

---

# Principios de diseño

El sistema ha sido diseñado para ser fácilmente extensible.

La incorporación de nuevos dispositivos deberá realizarse añadiendo nuevos tipos de sensores o actuadores, evitando modificar la arquitectura principal del proyecto.

Este enfoque permite mantener una API uniforme y un modelo de dominio sencillo, independientemente del número de dispositivos soportados.

---

# Posibles ampliaciones

La arquitectura prevista permite incorporar nuevos dispositivos en futuras versiones, entre ellos:

## Sensores

* Luminosidad.
* Movimiento.
* Presencia.
* Calidad del aire.
* CO₂.
* Ruido ambiental.

## Actuadores

* Puertas electrónicas.
* Ventanas motorizadas.
* Enchufes inteligentes.
* Sistemas de riego.
* Ventiladores.
* Sistemas de alarma.

Estas ampliaciones no forman parte del alcance inicial del proyecto, pero el modelo de dominio ha sido diseñado para soportarlas sin cambios estructurales significativos.
