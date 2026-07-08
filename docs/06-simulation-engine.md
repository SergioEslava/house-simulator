# 06 - Simulation Engine

## Objetivo

Este documento describe el funcionamiento del motor de simulación de **House Simulator**.

El motor de simulación es responsable de generar automáticamente las lecturas de los sensores y mantener un comportamiento coherente de la vivienda virtual.

Su diseño prioriza:

* modularidad;
* extensibilidad;
* independencia respecto al resto de la aplicación;
* facilidad para incorporar nuevos algoritmos de simulación.

---

# Responsabilidades

El motor de simulación deberá ser capaz de:

* generar nuevas lecturas para todos los sensores;
* respetar la frecuencia de muestreo de cada tipo de sensor;
* producir valores coherentes con el estado anterior;
* delegar el cálculo en algoritmos especializados.

El motor no será responsable de:

* responder peticiones HTTP;
* acceder directamente a la API;
* representar información para el usuario.

---

# Arquitectura

```text
Scheduler
    │
    ▼
Job
    │
    ▼
SimulationManager
    │
    ▼
SimulationDriver
    │
    ▼
SimulationStrategy
    │
    ▼
SensorReading
```

Cada componente tiene una única responsabilidad.

---

# Simulation Manager

El Simulation Manager constituye el punto de entrada del motor.

Responsabilidades:

* localizar el tipo del sensor;
* resolver el driver correspondiente;
* ejecutar la simulación;
* devolver la nueva lectura.

---

# Simulation Driver

Cada tipo de sensor tendrá un driver especializado.

Ejemplos:

* TemperatureSimulationDriver
* HumiditySimulationDriver

El driver conoce el tipo de sensor, pero delega el cálculo del valor en una estrategia de simulación.

---

# Simulation Strategy

Una estrategia define el algoritmo utilizado para generar una nueva lectura.

Todas las estrategias implementarán una interfaz común.

Conceptualmente:

```php
interface SimulationStrategy
{
    public function generate(Sensor $sensor): float;
}
```

El objetivo es poder sustituir el algoritmo sin modificar el resto del sistema.

---

# Estrategias iniciales

La primera versión del proyecto utilizará una estrategia sencilla para cada tipo de sensor.

## Temperature Strategy

Características:

* parte de la última lectura registrada;
* genera pequeñas variaciones;
* evita cambios bruscos;
* mantiene temperaturas dentro de un rango razonable.

Ejemplo:

```text
21.4
21.6
21.5
21.8
21.7
21.9
```

---

## Humidity Strategy

Características:

* parte de la última lectura;
* disminuye lentamente con el tiempo;
* puede incrementarse si en el futuro se implementa un sistema de riego.

Ejemplo:

```text
72
71
70
69
68
67
```

---

# Frecuencia de simulación

La frecuencia depende del tipo de sensor.

| Tipo        |   Intervalo |
| ----------- | ----------: |
| Temperature | 10 segundos |
| Humidity    |  30 minutos |

El Scheduler será el encargado de lanzar los Jobs correspondientes.

---

# Flujo de generación

El proceso de generación seguirá los siguientes pasos.

1. El Scheduler ejecuta un Job.
2. El Job obtiene los sensores correspondientes.
3. El Simulation Manager selecciona el driver adecuado.
4. El driver utiliza una estrategia para calcular el nuevo valor.
5. Se crea un nuevo `SensorReading`.
6. La lectura queda disponible para la API.

---

# Coherencia de los datos

La simulación deberá producir datos creíbles.

Se deberán evitar:

* cambios bruscos;
* saltos imposibles;
* valores fuera de rango;
* comportamientos aleatorios sin continuidad.

Cada nueva lectura deberá depender de la lectura anterior siempre que sea posible.

---

# Extensibilidad

El motor está diseñado para permitir múltiples estrategias de simulación.

Ejemplos:

* RandomStrategy
* DailyCycleStrategy
* SeasonalStrategy
* WeatherApiStrategy
* HistoricalDataStrategy
* AIStrategy

El resto de la aplicación no deberá conocer cuál de ellas está siendo utilizada.

---

# Futuras ampliaciones

El motor permitirá incorporar nuevas capacidades sin modificar su arquitectura.

Entre ellas:

* simulación basada en la hora del día;
* estaciones del año;
* climatología real;
* sistemas automáticos de riego;
* interacción entre sensores;
* reglas domóticas;
* simulación energética.

---

# Principios de diseño

El motor de simulación deberá respetar los siguientes principios:

* un driver por tipo de sensor;
* una estrategia por algoritmo;
* una única responsabilidad por componente;
* ausencia de lógica de simulación en Jobs, Controllers y Models;
* facilidad para sustituir algoritmos sin modificar la arquitectura.

El objetivo final es disponer de un motor de simulación independiente del framework y fácilmente reutilizable en otros proyectos.
