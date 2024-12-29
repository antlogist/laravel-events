Relations: 

| Model       | Related model    | Type of relations |
|-------------|------------------|-------------------|
| Event       | User             | belongsTo         |
| Event       | Participant      | hasMany           |
| Participant | User             | belongsTo         |
| Participant | Event            | belongsTo         |