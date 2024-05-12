# Recommendation API

GET /api/v1/product-count/by-user-ulid/{ulid}/recommendations

## 200

```json
{
    "count": 3
}

```

GET /api/v1/user-data/by-user-ulid/{ulid}/recommendations

## 200

```json

{
  "name": "test_user",
  "registrationDate": 1715413179,
  "productCount": 3
}
```

GET /api/v1/user-ulid/by-username/{username}/recommendations

## 200

```json
{
  "ulid":"01HXKC0V3G1QJ2M2PBRS9221AD"
}

```

GET /api/v1/basket-data/recommendations

## 200

```json
{
  "products": [
    {
      "ulid": "01HXKC1DBDN3WHWTGCQ2BJEQNE",
      "count": 3
    },
    {
      "ulid": "01HXKC394VJK0PPS024WDEY5B9",
      "count": 3
    }
  ]
}

```

GET /api/v1/product-data-basket/by-ulid/{ulid}/recommendations

## 200

```json
{
  "ulid": "01HXKC1DBDN3WHWTGCQ2BJEQNE",
  "stock": 3,
  "user_ulid": "01HXKC0V3G1QJ2M2PBRS9221AD"
}

```

GET /api/v1/product-data/by-ulid/{ulid}/recommendations

## 200

```json
{
  "name": "test-username",
  "price": 300,
  "priceAfterDiscount": 280,
  "currency": "UAH"
}

```










