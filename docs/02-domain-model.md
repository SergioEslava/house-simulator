# 02 - Domain Model

## Objetivo

Este documento define el modelo de dominio de **House Simulator**.

El objetivo es establecer una representación clara y coherente de los conceptos que forman parte de la simulación de la vivienda, independientemente de su implementación técnica.

Toda la arquitectura del proyecto, el diseño de la base de datos y la API REST deberán construirse a partir de este modelo.

---

# Visión general

La vivienda está formada por una colección de zonas que contienen dispositivos.

Un dispositivo puede ser de dos tipos:

* **Sensor**: genera información automáticamente.
* **Actuator**: mantiene un estado que puede consultarse y modificarse.

```text
House
│
├── Zone
│     ├── Sensor
│     │      └── SensorReading
│     │
│     └── Actuator
│
└── Simulation
```

---

# House

Representa la vivienda simulada.

En la versión inicial del proyecto únicamente existirá una vivienda.

La vivienda actúa como contenedor de todas las zonas.

## Responsabilidades

* Agrupar las zonas de la simulación.
* Representar el entorno completo de la vivienda.

---

# Zone

Una zona representa una estancia o espacio físico de la vivienda.

Cada dispositivo pertenece exactamente a una zona.

## Responsabilidades

* Agrupar dispositivos.
* Representar una ubicación física dentro de la vivienda.

## Zonas iniciales

* Salón
* Habitación Principal
* Habitación Secundaria
* Cocina
* Patio

---

# Device

**Device** es un concepto del dominio utilizado para referirse de forma genérica a cualquier dispositivo de la vivienda.

Existen dos categorías de dispositivos:

* Sensor
* Actuator

Device no representa una entidad persistente, sino una abstracción utilizada para describir el modelo de dominio.

---

# Sensor

Un sensor es un dispositivo encargado de generar información automáticamente.

Todos los sensores comparten el mismo comportamiento independientemente del tipo de dato que generan.

## Responsabilidades

* Generar lecturas periódicas.
* Mantener un histórico de lecturas.
* Pertenecer a una única zona.

## Propiedades conceptuales

* Nombre.
* Tipo.
* Intervalo de muestreo.
* Estado operativo.

---

# SensorReading

Una lectura representa una medición realizada por un sensor en un instante determinado.

Todas las lecturas generadas por un sensor forman parte de su histórico.

Una lectura siempre pertenece a un único sensor.

## Propiedades conceptuales

* Valor.
* Fecha y hora de la lectura.

---

# Actuator

Un actuador representa un dispositivo cuyo estado puede consultarse y modificarse mediante la API.

A diferencia de los sensores, un actuador no genera lecturas periódicas.

## Responsabilidades

* Mantener un estado actual.
* Permitir cambios de estado.
* Pertenecer a una única zona.

## Propiedades conceptuales

* Nombre.
* Tipo.
* Estado actual.

---

# Tipos de sensores

La versión inicial del proyecto contempla los siguientes tipos de sensores.

## Temperature

Representa la temperatura de una estancia.

Características:

* Una lectura cada **10 segundos**.
* Un sensor por estancia interior.

---

## Humidity

Representa la humedad de una planta.

Características:

* Una lectura cada **30 minutos**.
* Ocho sensores independientes en el patio.

---

# Tipos de actuadores

## Light

Representa cualquier sistema de iluminación.

Estados permitidos:

* `off`
* `on`

Operaciones:

* Consultar estado.
* Modificar estado.

---

## Blind

Representa una persiana motorizada.

Estados permitidos:

* `up`
* `down`
* `moving`

Operaciones:

* Consultar estado.
* Modificar estado.

---

# Relaciones del dominio

Las relaciones entre los distintos conceptos son las siguientes.

## House

* Contiene múltiples zonas.

## Zone

* Pertenece a una vivienda.
* Contiene múltiples sensores.
* Contiene múltiples actuadores.

## Sensor

* Pertenece a una zona.
* Genera múltiples lecturas.

## SensorReading

* Pertenece a un único sensor.

## Actuator

* Pertenece a una única zona.

---

# Reglas del dominio

El modelo deberá respetar las siguientes reglas.

## Zonas

* Una zona puede contener cualquier combinación de sensores y actuadores.
* Todo dispositivo debe pertenecer a una única zona.

## Sensores

* Todo sensor debe pertenecer a un único tipo.
* Todo sensor genera un histórico de lecturas.
* El intervalo de generación de lecturas depende del tipo de sensor.
* Una lectura nunca puede existir sin un sensor asociado.

## Actuadores

* Todo actuador debe pertenecer a un único tipo.
* Todo actuador mantiene un único estado actual.
* El conjunto de estados válidos depende del tipo de actuador.

---

# Extensibilidad

El modelo está diseñado para admitir nuevos dispositivos sin modificar su estructura principal.

### Posibles tipos de sensores

* Luminosidad
* Movimiento
* Presencia
* Calidad del aire
* CO₂
* Ruido ambiental

### Posibles tipos de actuadores

* Puertas electrónicas
* Ventanas motorizadas
* Enchufes inteligentes
* Sistemas de riego
* Ventiladores
* Sistemas de alarma

La incorporación de nuevos dispositivos deberá realizarse mediante la definición de un nuevo tipo de sensor o actuador, manteniendo inalteradas las entidades principales del dominio.

---

# Modelo resumido

```text
House
└── Zone
    ├── Sensor
    │   └── SensorReading
    │
    └── Actuator

Sensor
├── Temperature
└── Humidity

Actuator
├── Light
└── Blind
```
