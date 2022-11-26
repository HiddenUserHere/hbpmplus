
## About HBMPlus

An API Application to help on heartbeat rate measures.
This solution was made using laravel (PHP, JS, MySQL, with Axios)


# Requirements

- [PHP >= 8](https://www.php.net/) (Laravel 9x)
- [NodeJS >= 16.16](https://nodejs.org/en/download/) (Laravel 9x)


# How-To

First, clone this repository
```git clone (my repo)```

Copy or rename ```.env.example``` to ```.env``` and edit this to your configuration (Database)

### Install and build

```npm install```

```npm run build```

### Create Database data
```php artisan migrate```

### Start the server

```php artisan serve```

### Live Demo
Open ```http://localhost:8000``` and click on Generate Key


### Tests
```php artisan test```

This will test if the api token and data is generated.

# Rest API

`POST /api/newtoken`

**Response**
```
{
  "message": "User created successfully",
  "token": "N4F86tsg1tFSPyNN6rUxKk4wg4O4bXxVG4KAsQIVOcZzwCTnGilH4Y2XtT5p"
}
```

`POST /api/heartbeat/tick`

**Request**
|  Parameter  |  Type  |  Example Value |  Description  |
| ------------ | ------------ | ------------ | -----------|
| api_token  | string (hash) | N4F86tsg1tFSPyNN6rUxKk4wg4O4bXxVG4KAsQIVOcZzwCTnGilH4Y2XtT5p  | The API Key token received by ```/api/newtoken```  |
| time  | float\|number  | 1000  | Time in MS of Tick beat to be measured (min: 0, max: 5000) |

**Response**

```
{
  "id": "bdb1e462-3c90-41d5-8764-deed6e1d74c8",
  "user_id": "5d062bd2-f05d-48c5-8b19-f35af6c13299",
  "time": 1000,
  "updated_at": "2022-11-26T21:30:23.000000Z",
  "created_at": "2022-11-26T21:30:23.000000Z",
  "heart_rate": 0.18504999999999996
}
```

|  Parameter  | Type  |  Description  |
| ------------- | ----------- | ---------- |
| id  | GUID V4 | ID for this measure response |
| user_id | GUID V4 | ID of the user that requested using the API Token |
| time | float\|number | Time in MS of Tick beat to be measured |
| updated_at | Datetime | The date when a Heart Rate data is updated |
| created_at | DateTime | The when a Heart Rate is created |
| heart_rate | float\|number | The Heart Rate measured by the API |

# Demo

![Demo](https://raw.githubusercontent.com/HiddenUserHere/hbpmplus/master/example.gif)
