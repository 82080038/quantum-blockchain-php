# 🔌 API Reference

## Base URL
```
https://your-domain.com/api/
```

## Authentication
All API requests must include an `API-Key` header:
```http
API-Key: your_api_key_here
```

## Endpoints

### Quantum Computing API
- `POST /quantum?action=compute` - Execute quantum computation
- `GET /quantum?action=status` - Get processor status

### Trading API
- `POST /trading?action=start` - Start trading strategy
- `GET /trading?action=portfolio` - Get portfolio data

### Blockchain API
- `POST /blockchain?action=deploy` - Deploy smart contract
- `GET /blockchain?action=stats` - Get blockchain statistics

### Authentication API
- `POST /auth?action=login` - User login
- `POST /auth?action=register` - User registration

## Response Format
```json
{
    "success": true,
    "message": "Operation completed successfully",
    "data": {
        // Response data
    }
}
```

## Error Codes
- 200: Success
- 400: Bad Request
- 401: Unauthorized
- 403: Forbidden
- 404: Not Found
- 405: Method Not Allowed
- 500: Internal Server Error

## Example Usage

### Quantum Computation
```bash
curl -X POST "http://localhost/api/quantum?action=compute" \
  -H "API-Key: your_api_key" \
  -H "Content-Type: application/json" \
  -d '{"algorithm": "shor", "parameters": {"number": 15}}'
```

### Trading Strategy
```bash
curl -X POST "http://localhost/api/trading?action=start" \
  -H "API-Key: your_api_key" \
  -H "Content-Type: application/json" \
  -d '{"strategy_id": 1, "parameters": {"risk_tolerance": 0.02}}'
```

### Blockchain Deploy
```bash
curl -X POST "http://localhost/api/blockchain?action=deploy" \
  -H "API-Key: your_api_key" \
  -H "Content-Type: application/json" \
  -d '{"name": "MyContract", "type": "trading"}'
```
