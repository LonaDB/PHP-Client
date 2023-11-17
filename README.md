# LonaDB PHP Client

The LonaDB PHP Client is a PHP library designed to simplify communication with the LonaDB Database Server. This library provides an easy-to-use interface for interacting with the server's various functions, enabling you to manage tables, variables, users, permissions, and more. It streamlines the process of sending requests and receiving responses from the server using the TCP protocol.

## Installation

You can use the LonaDB PHP Client by including it in your project. Simply download the `LonaDB.php` file and include it in your PHP project.

## Usage

To use the `LonaDB` PHP Client, follow these steps:

1. Include the `LonaDB` class in your PHP file:

```php
require_once('path/to/LonaDB.php');
```

2. Create an instance of the `LonaDB` class by providing the required connection details:

```php
$client = new LonaDB($host, $port, $name, $password);
```

Replace `$host`, `$port`, `$name`, and `$password` with the appropriate values for your LonaDB Server.

3. Use the provided methods to interact with the server:

```php
// Example: Get a list of tables
$tables = $client->getTables("username");

// Display the list of tables
print_r($tables);
```

## Available Methods

### `getTables($user)`

Retrieves a list of tables available in the database for a given user.

### `getTableData($table)`

Retrieves data from a specified table.

### `deleteTable($table)`

Deletes a table by its name.

### `createTable($table)`

Creates a new table with the given name.

### `set($table, $name, $value)`

Sets a variable within a table to the specified value.

### `delete($table, $name)`

Deletes a variable from a table.

### `get($table, $name)`

Retrieves the value of a variable from a table.

### `getUsers()`

Retrieves a list of users in the database.

### `createUser($name, $pass)`

Creates a new user with the given name and password.

### `deleteUser($name)`

Deletes a user by their name.

### `checkPassword($name, $pass)`

Checks if the provided password is correct for a given user.

### `checkPermission($name, $permission)`

Checks if a user has a specific permission.

### `removePermission($name, $permission)`

Removes a permission from a user.

### `getPermissionsRaw($name)`

Retrieves the raw permission data for a user.

### `addPermission($name, $permission)`

Adds a permission to a user.

### `eval($func)`

Runs the provided function as a string.

## License

This project is licensed under the GNU Affero General Public License version 3 (GNU AGPL-3.0).