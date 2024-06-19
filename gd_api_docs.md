# Quotes APIs with jwt using HS256 algorithms 

## Sample in php jwt token
```php
// that will return jwt_token
  public function getJWTtoken($payload){
      return JWT::encode($payload, <SECRET_KEY>, 'HS256');
  }
  // that will return jwt_token
  public function getResponse_by_jwt_token($jwt_token){
      return JWT::decode($jwt_token, new Key(<SECRET_KEY>, 'HS256'));
  }

```

## Quotes

Fetches quotes data based on various parameters.

- **URL**: `/api/quotes`
- **Method**: `POST`
- **POST parameters**: 
  - `jwt_token`: <getJWTtoken>
- **JWT Payload Parameters**:
  - `order_by`: 'old' or 'new' (Default: 'new')
  - `page`: Page number for pagination (Default: 1)
  - `pageSize`: Number of records per page (Default: 100)
  - `category_id`: ID of the category for filtering quotes (optional)
  - `sub_category_id`: ID of the sub-category for filtering quotes (optional)
  - `quotes_id`: ID of a single quote to fetch (optional)
- **Response Payload in JWT TOKEN**:
  - `status`: Boolean indicating success or failure
  - `message`: Description of the operation result
  - `total_records`: Total number of records matching the query
  - `page`: Current page number
  - `pageSize`: Number of records per page
  - `hasNextData`: Boolean indicating if there are more records available
  - `data`: Array containing fetched quotes data or single quote data (if `quotes_id` provided)

## Sub Category List

Fetches a list of sub-categories based on category ID.

- **URL**: `/api/quotes/sub-category`
- **Method**: `POST`
- **POST parameters**: 
  - `jwt_token`: <getJWTtoken>
- **JWT Payload Parameters**:
  - `order_by`: 'old' or 'new' (Default: 'new')
  - `page`: Page number for pagination (Default: 1)
  - `pageSize`: Number of records per page (Default: 100)
  - `category_id`: ID of the parent category for filtering sub-categories
  - `sub_category_id`: ID of a single sub-category to fetch (optional)
- **Response Payload in JWT TOKEN**:
  - `status`: Boolean indicating success or failure
  - `message`: Description of the operation result
  - `total_records`: Total number of sub-categories matching the query
  - `page`: Current page number
  - `pageSize`: Number of records per page
  - `hasNextData`: Boolean indicating if there are more records available
  - `data`: Array containing fetched sub-category data or single sub-category data (if `sub_category_id` provided)

## Category List

Fetches a list of categories.

- **URL**: `/api/quotes/category`
- **Method**: `POST`
- **POST parameters**: 
  - `jwt_token`: <getJWTtoken>
- **JWT Payload Parameters**:
  - `order_by`: 'old' or 'new' (Default: 'new')
  - `page`: Page number for pagination (Default: 1)
  - `pageSize`: Number of records per page (Default: 100)
  - `category_id`: ID of a single category to fetch (optional)
- **Response Payload in JWT TOKEN**:
  - `status`: Boolean indicating success or failure
  - `message`: Description of the operation result
  - `total_records`: Total number of categories matching the query
  - `page`: Current page number
  - `pageSize`: Number of records per page
  - `hasNextData`: Boolean indicating if there are more records available
  - `data`: Array containing fetched category data or single category data (if `category_id` provided)

---
