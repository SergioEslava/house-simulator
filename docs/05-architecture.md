# 05 - Architecture

## Objetivo

Este documento define la arquitectura de software de **House Simulator**.

La aplicación está desarrollada sobre Laravel 12 y sigue una arquitectura en capas que separa claramente la lógica de presentación, la lógica de negocio, el motor de simulación y la persistencia de datos.

El objetivo es construir una aplicación sencilla de mantener, fácilmente extensible y preparada para incorporar nuevos dispositivos sin modificar la arquitectura existente.

---

# Principios arquitectónicos

La arquitectura del proyecto se basa en los siguientes principios:

* Separación de responsabilidades.
* Uso de las convenciones de Laravel.
* Alta cohesión.
* Bajo acoplamiento.
* Reutilización de la lógica de negocio.
* Extensibilidad mediante composición en lugar de modificación.
* Evitar lógica de negocio en controladores y modelos.

---

# Arquitectura general

```text
                   HTTP Request
                         │
                         ▼
                  API Controllers
                         │
                         ▼
                   Form Requests
                         │
                         ▼
                      Services
               ┌─────────┴─────────┐
               ▼                   ▼
      Simulation Engine       Domain Logic
               │                   │
               └─────────┬─────────┘
                         ▼
                  Eloquent Models
                         │
                         ▼
                       MySQL
```

Cada capa tiene una responsabilidad única y claramente definida.

---

# Controllers

Los controladores representan el punto de entrada de la API.

Su responsabilidad se limita a:

* recibir peticiones HTTP;
* validar la entrada mediante Form Requests;
* delegar el trabajo en un Service;
* devolver una respuesta mediante API Resources.

Los controladores nunca deberán contener lógica de negocio.

---

# Form Requests

Las validaciones de entrada se implementarán mediante Form Requests.

Ejemplos:

* UpdateActuatorRequest

Esto mantiene los controladores pequeños y facilita la reutilización de las reglas de validación.

---

# Services

Los Services contienen la lógica de negocio de la aplicación.

Entre sus responsabilidades se encuentran:

* obtener el estado de una vivienda;
* construir el snapshot completo;
* consultar dispositivos;
* modificar el estado de actuadores;
* coordinar la interacción con el motor de simulación.

Los Services pueden utilizar múltiples modelos y colaborar entre sí.

---

# Models

Los modelos Eloquent representan las entidades persistentes del dominio.

Modelos principales:

* House
* Zone
* Sensor
* SensorType
* SensorReading
* Actuator
* ActuatorType
* ActuatorState

Los modelos únicamente deberán contener:

* relaciones;
* scopes;
* mutadores;
* accesores;
* pequeñas reglas relacionadas con la persistencia.

La lógica de negocio deberá implementarse en los Services.

---

# API Resources

Todas las respuestas JSON se construirán mediante API Resources.

Ejemplos:

* HouseResource
* ZoneResource
* SensorResource
* SensorReadingResource
* ActuatorResource

Esto garantiza un formato homogéneo para toda la API.

---

# Simulation Engine

La simulación constituye un subsistema independiente del resto de la aplicación.

Su responsabilidad consiste en generar automáticamente las lecturas de los sensores utilizando un conjunto de drivers especializados.

La lógica de simulación nunca deberá implementarse directamente en los Jobs.

---

# Arquitectura del motor de simulación

```text
SimulationEngine
│
├── Contracts
│     └── SimulationDriver
│
├── Drivers
│     ├── TemperatureSimulationDriver
│     └── HumiditySimulationDriver
│
└── SimulationManager
```

---

## SimulationDriver

Todos los motores de simulación deberán implementar una interfaz común.

Conceptualmente:

```php
interface SimulationDriver
{
    public function simulate(Sensor $sensor): SensorReading;
}
```

Cada driver conoce únicamente cómo generar lecturas para un tipo concreto de sensor.

---

## Drivers

Cada tipo de sensor tendrá su propia implementación.

Versión inicial:

* TemperatureSimulationDriver
* HumiditySimulationDriver

En el futuro podrán añadirse:

* LuminositySimulationDriver
* PresenceSimulationDriver
* MotionSimulationDriver
* CO2SimulationDriver

La incorporación de un nuevo driver no requerirá modificar los existentes.

---

## SimulationManager

El Simulation Manager actuará como punto de entrada del motor de simulación.

Sus responsabilidades serán:

* identificar el tipo del sensor;
* resolver el driver adecuado;
* delegar la generación de la lectura;
* devolver el resultado al proceso que lo solicitó.

Los Jobs nunca deberán conocer la implementación concreta de los drivers.

---

# Jobs

Los Jobs representan tareas ejecutadas en segundo plano.

Su única responsabilidad será coordinar la ejecución de procesos automáticos.

Ejemplos:

* GenerateTemperatureReadingsJob
* GenerateHumidityReadingsJob

Un Job nunca implementará lógica de simulación.

Su flujo será:

```text
Job
    │
    ▼
SimulationManager
    │
    ▼
SimulationDriver
    │
    ▼
SensorReading
```

---

# Scheduler

Laravel Scheduler será el encargado de ejecutar periódicamente los distintos Jobs.

Inicialmente existirán procesos para:

* generar temperaturas cada 10 segundos;
* generar humedades cada 30 minutos.

La frecuencia de ejecución deberá obtenerse de la configuración almacenada en la base de datos siempre que sea posible.

---

# Configuración

La configuración funcional del sistema deberá almacenarse en la base de datos.

Ejemplos:

* tipos de sensores;
* tipos de actuadores;
* estados permitidos;
* intervalos de muestreo.

La configuración propia del framework permanecerá en los archivos `config/`.

---

# Estructura de directorios

La siguiente estructura servirá como guía para organizar el proyecto.

```text
app
├── Http
│   ├── Controllers
│   ├── Requests
│   └── Resources
│
├── Models
│
├── Services
│   ├── House
│   ├── Sensor
│   ├── Actuator
│   └── Snapshot
│
├── SimulationEngine
│   ├── Contracts
│   ├── Drivers
│   └── SimulationManager.php
│
├── Jobs
│
└── Console
```

Esta organización podrá evolucionar conforme aumente el tamaño del proyecto.

---

# Flujo de una petición HTTP

```text
Cliente
    │
    ▼
Controller
    │
    ▼
Form Request
    │
    ▼
Service
    │
    ▼
Models
    │
    ▼
Database
    │
    ▼
API Resource
    │
    ▼
Cliente
```

---

# Flujo de una simulación

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
SensorReading
```

---

# Inyección de dependencias

Todos los componentes deberán resolverse mediante el contenedor de servicios de Laravel.

No deberán instanciarse dependencias manualmente.

Esto facilita:

* desacoplamiento;
* pruebas unitarias;
* reutilización del código.

---

# Gestión de errores

Los errores se gestionarán de la siguiente forma:

* Form Requests para errores de validación.
* Excepciones para errores de negocio.
* API Resources para respuestas homogéneas.
* Laravel Exception Handler para el tratamiento global de errores.

---

# Escalabilidad

La arquitectura está diseñada para admitir nuevos dispositivos sin modificar su estructura principal.

Para añadir un nuevo tipo de sensor será suficiente con:

1. Registrar el nuevo tipo en la base de datos.
2. Implementar un nuevo `SimulationDriver`.
3. Registrar el driver en el `SimulationManager`.

No será necesario modificar los Jobs, los Services, los Controllers ni la API.

Del mismo modo, incorporar un nuevo actuador únicamente requerirá registrar un nuevo tipo y sus estados válidos.

---

# Futuras ampliaciones

La arquitectura permite incorporar nuevas funcionalidades manteniendo la estructura existente:

* múltiples viviendas;
* automatizaciones domóticas;
* reglas programables;
* autenticación;
* WebSockets;
* Server-Sent Events;
* integración con dispositivos físicos;
* nuevos motores de simulación;
* panel de administración.

El objetivo es que la evolución del proyecto se base en añadir nuevos componentes especializados, evitando modificar el comportamiento de los ya existentes y respetando el principio **Open/Closed**.
