# API Documentation

This API manages objects related to weapons through various endpoints for creating, reading, updating, and deleting data. Below is an overview of the features offered by each file.

---

## Table of Contents

- [API Documentation](#api-documentation)
   * [Table of Contents](#table-of-contents)
   * [Endpoints](#endpoints)
      + [Creating an Object (create.php)](#creating-an-object-createphp)
      + [Listing Objects (find.php)](#listing-objects-findphp)
      + [Object Details (findOne.php)](#object-details-findonephp)
      + [Updating an Object (update.php)](#updating-an-object-updatephp)
      + [Deleting an Object (delete.php)](#deleting-an-object-deletephp)
      + [Additional Services (service.php)](#additional-services-servicephp)
      + [Weapons Management (weapon.php)](#weapons-management-weaponphp)
   * [Database](#database)
      + [Initial Configuration](#initial-configuration)
      + [Main Tables](#main-tables)
         - [`weapons` Table](#weapons-table)
   * [DAO (Data Access Object)](#dao-data-access-object)
      + [Main Features](#main-features)
      + [Architecture](#architecture)

---

## Endpoints

### Creating an Object (create.php)

- **Method:** `POST`
- **Description:** Creates a new object in the database.
- **Expected Inputs:**
  - `name` (string): Name of the object (required).
  - `type` (string): Type or category of the object (required).
  - Other specific fields based on the data model.

- **HTTP Responses:**
  - `201 Created`: Object successfully created. Returns the created object.
  - `400 Bad Request`: Invalid request (e.g., missing fields or incorrect format).
    - Error message: `{"error": "Invalid input data"}`
  - `500 Internal Server Error`: Server error during the creation process.
    - Error message: `{"error": "Failed to create object"}`

### Listing Objects (find.php)

- **Method:** `GET`
- **Description:** Retrieves a list of objects stored in the database.
- **Optional Parameters:**
  - `limit` (int): Limit the number of returned objects (optional).
  - `offset` (int): Offset for pagination (optional).

- **HTTP Responses:**
  - `200 OK`: Successfully returned a list of objects.
  - `204 No Content`: No objects found.
  - `500 Internal Server Error`: Server error during retrieval.
    - Error message: `{"error": "Failed to fetch objects"}`

### Object Details (findOne.php)

- **Method:** `GET`
- **Description:** Retrieves details of a specific object.
- **Expected Parameters:**
  - `id` (int): Unique identifier of the object (required).

- **HTTP Responses:**
  - `200 OK`: Object found and returned.
  - `404 Not Found`: Object not found for the given `id`.
    - Error message: `{"error": "Object not found"}`
  - `400 Bad Request`: Missing or invalid `id` parameter.
    - Error message: `{"error": "Invalid ID provided"}`
  - `500 Internal Server Error`: Error during object retrieval.
    - Error message: `{"error": "Failed to fetch object"}`

### Updating an Object (update.php)

- **Method:** `PUT`
- **Description:** Updates information of an existing object.
- **Expected Parameters:**
  - `id` (int): Unique identifier of the object to be updated (required).
  - Fields to be updated, such as `name` or `type` (required).

- **HTTP Responses:**
  - `200 OK`: Object successfully updated. Returns the updated object data.
  - `400 Bad Request`: Missing or incorrect parameters.
    - Error message: `{"error": "Invalid input data"}`
  - `404 Not Found`: Object not found with the given `id`.
    - Error message: `{"error": "Object not found"}`
  - `500 Internal Server Error`: Error during the update process.
    - Error message: `{"error": "Failed to update object"}`

### Deleting an Object (delete.php)

- **Method:** `DELETE`
- **Description:** Deletes an object from the database.
- **Expected Parameters:**
  - `id` (int): Unique identifier of the object (required).

- **HTTP Responses:**
  - `200 OK`: Object successfully deleted.
  - `400 Bad Request`: Missing or invalid `id` parameter.
    - Error message: `{"error": "Invalid ID provided"}`
  - `404 Not Found`: No object found with the given `id`.
    - Error message: `{"error": "Object not found"}`
  - `500 Internal Server Error`: Error during the deletion process.
    - Error message: `{"error": "Failed to delete object"}`

### Additional Services (service.php)

- **Description:** Utility file including features such as:
  - Database connection management.
  - Global error or exception handling.
  - Reusable functions for controllers.

### Weapons Management (weapon.php)

- **Description:** Contains business logic specific to weapons, including:
  - Validation of input data.
  - Calls to DAO functions to interact with the `weapon` table.
  - Specific calculations or data transformations related to weapons.

- **Internal Use:** This file serves as an intermediary layer between the endpoints and the database.

---

## Database

The API relies on a database to store information related to weapons.

### Initial Configuration

To set up the database, use the provided SQL file:

```bash
mysql -u [user] -p [database_name] < vikings.sql
```

### Main Tables

Here is a summary of the tables included in the `vikings.sql` file:

#### `weapons` Table

- **Description:** Stores information about weapons.
- **Columns:**
  - `id` (INT, PRIMARY KEY, AUTO_INCREMENT): Unique identifier of the weapon.
  - `name` (VARCHAR): Name of the weapon.
  - `type` (VARCHAR): Type or category of the weapon.
  - `damage` (INT): Damage points inflicted by the weapon.
  - `weight` (FLOAT): Weight of the weapon in kilograms.
  - `created_at` (TIMESTAMP): Record creation date.
  - `updated_at` (TIMESTAMP): Last update date.

---

## DAO (Data Access Object)

The DAO (Data Access Object) manages interactions with the database. In this API, the `weapon.php` file implements the necessary functions to interact with the `weapon` table.

### Main Features

The DAO in `weapon.php` includes the following methods:

- **Create a Weapon:** Add a record to the table.
- **Retrieve All Weapons:** Get a complete list of records.
- **Retrieve a Specific Weapon:** Find a record by its `id`.
- **Update a Weapon:** Modify information of an existing weapon.
- **Delete a Weapon:** Remove a record from the database.

### Architecture

The DAO uses SQL queries with prepared statements to ensure security (SQL injection prevention) and code modularity. It operates through a PDO instance. 

---