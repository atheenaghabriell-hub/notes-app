# Notes App API Endpoint Documentation

## Endpoint

`http://localhost/notes-app/api/create_note.php`

## Purpose

This endpoint is responsible for creating and saving a new note in the Notes App database.

It receives note information from the client application, validates the input, and inserts the data into the `notes` table within the MySQL database managed through XAMPP.

---

## Environment

- Local Development Server: XAMPP
- Web Server: Apache
- Database: MySQL / MariaDB
- API Language: PHP
- Base URL:

```text
http://localhost/notes-app/api/
```

---

## Request Method

```http
POST
```

---

## Request Parameters

| Parameter | Type | Required | Description |
|------------|--------|------------|-------------|
| title | string | Yes | Note title |
| content | string | Yes | Note content |
| created_at | datetime | No | Automatically generated creation timestamp |

### Example Request

```json
{
    "title": "Meeting Notes",
    "content": "Discuss project milestones and deadlines."
}
```

---

## Database Operation

The endpoint inserts a new record into:

```sql
notes
```

Example:

```sql
INSERT INTO notes (title, content)
VALUES (?, ?);
```

---

## Success Response

**HTTP Status:**

```http
200 OK
```

**Response Body:**

```json
{
    "success": true,
    "message": "Note
