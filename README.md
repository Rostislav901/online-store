# Project: Online Store

## Overview
This project is an online store built using Symfony 6, structured as a modular monolith with a focus on Clean Architecture principles. It employs Command Query Responsibility Segregation (CQRS) and Domain-Driven Design (DDD) to ensure clear separation of concerns and maintainability.

## Modules
Shared
User
ProductCatalog
Order
Discount

## Module Descriptions

### Shared
The Shared module contains common infrastructure and domain logic that can be used across other modules. This includes:

Base entities and value objects
Common services
Event system and handlers

### User
The User module handles all aspects of user management:

User registration and authentication
User profile management
Role and permission handling

### ProductCatalog
The ProductCatalog module manages the product-related functionalities:

Product creation and management
Product categorization
Inventory management

### Order
The Order module deals with order processing and management:

Order creation and tracking
Order state transitions
Payment integration

### Discount
The Discount module manages discount logic:

Creation and management of discount codes
Application of discounts to orders
Validation of discount criteria

## CQRS and DDD
The project uses CQRS to separate read and write operations:

Commands are used for write operations (create, update, delete)
Queries are used for read operations (fetch data)
Each module follows DDD principles, structuring the code into:

Domain: Core business logic and domain entities
Infrastructure: Communication with external systems (e.g., database, APIs)
Application: Application services and use cases

## API Documentation

You can access the API documentation at `http://localhost:8000/api/doc` .
This page, powered by Swagger, provides a detailed and interactive interface for exploring all the endpoints available in the application.

## Testing 
Run tests using PHPUnit:
 ```bash
 
 php /path/to/your/project/bin/phpunit
 ``` 
