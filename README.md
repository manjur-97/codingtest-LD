# **User Registration API**

This API allows users to register in the system and receive an authentication token for further requests.

---

## **Endpoint**

```
POST /api/register
```

**Full URL Example:**

```
http://127.0.0.1:8000/api/register
```

---

## **Headers**

| Key           | Value                  |
|---------------|-----------------------|
| Accept        | application/json      |
| Content-Type  | application/json      |

---

## **Request Body**

Send data as **raw JSON**:

```json
{
  "name": "abc",
  "email": "sadasd@example.com",
  "password": "asdsadA1@",
  "password_confirmation": "asdsadA1@"
}
```

### **Field Validation Rules**

| Field                  | Type     | Required | Rules                                                                                  |
|------------------------|----------|----------|---------------------------------------------------------------------------------------|
| name                   | string   | yes      | max 255 characters                                                                     |
| email                  | string   | yes      | valid email format, unique in `users` table                                           |
| password               | string   | yes      | min 6 characters, at least one uppercase, one lowercase, one number, one special char |
| password_confirmation  | string   | yes      | must match `password`                                                                 |

---

## **Response**

```json
{
    "status": true,
    "message": "User registered successfully.",
    "data": {
        "user": {
            "id": "eyJpdiI6IjJNSTU4dHp1N1FrbXRtc3BvbXpVRkE9PSIsInZhbHVlIjoiVGdnUTFQREp1S0dCbitHMWxteUdCdz09IiwibWFjIjoiMGFjNzdjZGMwOTVlMzdhZjhlZjAzNjc5MTc5NTJhOTEwOGJlMDU0MGZiZjMxZTk3NDUzMzkxZTA5OTU0Zjg4NSIsInRhZyI6IiJ9",
            "name": "abc",
            "email": "sadasd@example.com"
        },
        "token": "11|2aa1B1I55yYxCCJAk5gIeBvhEfTIlcOfunuj4nhy4f567664"
    }
}
```

---

# **User Login API**

This API allows users to login in the system.

---

## **Endpoint**

```
POST /api/login
```

**Full URL Example:**

```
http://127.0.0.1:8000/api/login
```

---

## **Headers**

| Key           | Value                 |
|---------------|-----------------------|
| Accept        | application/json      |
| Content-Type  | application/json      |

---

## **Request Body**

Send data as **raw JSON**:

```json
{
  "email": "admin@example.com",
  "password": "Admin123@"
}
```

## **Response**

```json
{
    "status": true,
    "message": "User logged in successfully.",
    "data": {
        "user": {
            "id": "eyJpdiI6Im0zVklIb3JMMTU1cFNqMmkwZmY0Mmc9PSIsInZhbHVlIjoienI2VEtUdVU0MmVqcmlqS3p2N0JJQT09IiwibWFjIjoiNWFhMDAyOTg4MTk4YzJlYjU1YmExZDVlYThkZWI3OGU0YmNiYTUzZDhmMDEyOTcyN2QyNWFkOWQ0OGUxY2Y5YSIsInRhZyI6IiJ9",
            "name": "Manjur Rahman",
            "email": "admin@example.com"
        },
        "token": "1|5leNWhVugWmH6rmfn3iTzg3tbDrOjo9Soq1pPrhr230890c0"
    }
}
```

---

# **Shortened Url Create API**

This API allows users to login in the system.

---

## **Endpoint**

```
POST /api/shorten_url
```

**Full URL Example:**

```
http://127.0.0.1:8000/api/shorten_url
```

---

## **Headers**

| Key           | Value                 |
|---------------|-----------------------|
| Accept        | application/json      |
| Authorization | Bearer {token}      |
| Content-Type  | application/json      |

---

## **Request Body**

Send data as **raw JSON**:

```json
{
  "original_url": "https://www.linkedin.com/feed/update/urn:li:activity:7405248466173464576/"
}
```

## **Response**

```json
{
    "status": true,
    "message": "URL shortened successfully",
    "data": {
        "end_point": "api/s/9pju68",
        "short_code": "9pju68",
        "short_url": "http://127.0.0.1:8000/api/s/9pju68",
        "original_url": "https://www.linkedin.com/feed/update/urn:li:activity:7405248466173464576/",
        "created_at": "30-12-2025"
    }
}
```

---
# **Redirect Shortened Url To Original Url API**

This API allows users to login in the system.

---

## **Endpoint**

```
Get /api/s/{short_code}
```

**Full URL Example:**

This Url you can directly use in any browser 
```
http://127.0.0.1:8000/api/s/9pju68
```


## **Request Body**

Send data as **raw JSON**:

```json
{
  "original_url": "https://www.linkedin.com/feed/update/urn:li:activity:7405248466173464576/"
}
```

## **Response**

```json
{
    "status": true,
    "message": "URL shortened successfully",
    "data": {
        "end_point": "api/s/9pju68",
        "short_code": "9pju68",
        "short_url": "http://127.0.0.1:8000/api/s/9pju68",
        "original_url": "https://www.linkedin.com/feed/update/urn:li:activity:7405248466173464576/",
        "created_at": "30-12-2025"
    }
}
```


