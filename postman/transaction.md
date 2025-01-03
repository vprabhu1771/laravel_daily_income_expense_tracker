### Example API Endpoints:
- **Get All Transactions:** `GET /api/v2/transactions`
- **Get Income Transactions:** `GET /api/v2/transactions?type=income`
- **Get Expense Transactions:** `GET /api/v2/transactions?type=expense`
- **Create Transaction:** `POST /api/v2/transactions`

### Example POST Request Body:
```json
{
    "type": "income",
    "amount": 500.00,
    "description": "Freelance work payment",
    "date": "2025-01-02"
}
```