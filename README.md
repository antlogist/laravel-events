## Relations: 

| Model       | Type of relations | Related model |
|-------------|-------------------|---------------|
| Event       | belongsTo         | User          |
| Event       | hasMany           | Participant   |
| Participant | belongsTo         | User          |
| Participant | belongsTo         | Event         |

## events table structure:

| Field       | Type            | Null | Key  | Default | Extra           |
|-------------|-----------------|------|------|---------|-----------------|
| id          | bigint unsigned | NO   | PRI  | NULL    | auto_increment  |
| user_id     | bigint unsigned | NO   |      | NULL    |                 |
| name        | varchar(255)    | NO   |      | NULL    |                 |
| description | text            | YES  |      | NULL    |                 |
| start_time  | datetime        | NO   |      | NULL    |                 |
| end_time    | datetime        | NO   |      | NULL    |                 |
| created_at  | timestamp       | YES  |      | NULL    |                 |
| updated_at  | timestamp       | YES  |      | NULL    |                 |

## participants table structure:

| Field      | Type            | Null | Key  | Default | Extra           |
|------------|-----------------|------|------|---------|-----------------|
| id         | bigint unsigned | NO   | PRI  | NULL    | auto_increment  |
| user_id    | bigint unsigned | NO   |      | NULL    |                 |
| event_id   | bigint unsigned | NO   |      | NULL    |                 |
| created_at | timestamp       | YES  |      | NULL    |                 |
| updated_at | timestamp       | YES  |      | NULL    |                 |

## users table structure:

| Field               | Type            | Null | Key  | Default | Extra           |
|---------------------|-----------------|------|------|---------|-----------------|
| id                  | bigint unsigned | NO   | PRI  | NULL    | auto_increment  |
| name                | varchar(255)    | NO   |      | NULL    |                 |
| email               | varchar(255)    | NO   | UNI  | NULL    |                 |
| email_verified_at   | timestamp       | YES  |      | NULL    |                 |
| password            | varchar(255)    | NO   |      | NULL    |                 |
| remember_token      | varchar(100)    | YES  |      | NULL    |                 |
| created_at          | timestamp       | YES  |      | NULL    |                 |
| updated_at          | timestamp       | YES  |      | NULL    |                 |