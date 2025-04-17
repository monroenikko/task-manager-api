<?php

namespace App\Swagger;

use OpenApi\Attributes as OA;

#[OA\Info(
    version: "1.0.0",
    title: "Task Manager Api Documentation",
    description: "List of API endpoints"
)]
#[OA\Contact(
    email: "monroenikkoaldrich@gmail.com"
)]
#[OA\License(
    name: "Apache 2.0",
    url: "http://www.apache.org/licenses/LICENSE-2.0.html"
)]
#[OA\SecurityScheme(
    type: "http",
    description: "Login with email and password to get the authentication token",
    name: "Token based Based",
    in: "header",
    scheme: "bearer",
    bearerFormat: "JWT",
    securityScheme: "apiAuth"
)]

// Define reusable components
#[OA\Components(
    responses: [
        new OA\Response(
            response: "UnauthorizedLogin",
            description: "Wrong credentials",
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: "message", type: "string", example: "These credentials do not match our records.")
                ]
            )
        ),
        new OA\Response(
            response: "UnauthorizedRegister",
            description: "Wrong credentials",
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: "message", type: "string", example: "Unauthenticated.")
                ]
            )
        ),
        new OA\Response(
            response: "ErrorRegister",
            description: "Error Saving Data",
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: "message", type: "string", example: "Something went wrong.")
                ]
            )
        )
    ]
)]

class Auth
{
    // Login endpoint
    #[OA\Post(
        path: "/api/login",
        summary: "Login User",
        tags: ["Authentication"],
        description: "Login by email and password",
        operationId: "authLogin",
        requestBody: new OA\RequestBody(
            required: true,
            description: "Pass user credentials",
            content: new OA\JsonContent(
                required: ["email", "password"],
                properties: [
                    new OA\Property(property: "email", type: "string", format: "email", example: "test@email.com"),
                    new OA\Property(property: "password", type: "string", format: "password", example: "12345678")
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: "You are successfully login. Welcome back Full name!",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: "message", type: "string", example: "You are successfully login. Welcome back Full name!"),
                        new OA\Property(property: "code", type: "integer", example: 200),
                        new OA\Property(
                            property: "results",
                            type: "object",
                            properties: [
                                new OA\Property(
                                    property: "users",
                                    type: "object",
                                    properties: [
                                        new OA\Property(property: "id", type: "integer", example: 1),
                                        new OA\Property(property: "first_name", type: "string", example: "First name"),
                                        new OA\Property(property: "last_name", type: "string", example: "Second name"),
                                        new OA\Property(property: "email", type: "string", format: "date", example: "test@email.com"),
                                        new OA\Property(property: "email_verification_at", type: "integer", example: null),
                                        new OA\Property(property: "created_at", type: "string", format: "date-time", example: "2025-04-17T08:34:29.000000Z"),
                                        new OA\Property(property: "updated_at", type: "string", format: "date-time", example: "2025-04-17T08:34:29.000000Z"),
                                    ]
                                ),
                                new OA\Property(property: "token", type: "string", example: "1|GAjAN18EZ23444bi3wdAEICA6XR040BrEPme2EAXls00a598cc"),
                                new OA\Property(property: "token_type", type: "string", example: "Bearer"),
                            ]
                        )
                    ]
                )
            ),
            new OA\Response(
                response: 401,
                ref: "#/components/responses/UnauthorizedLogin"
            )
        ]
    )]
    public function login() {}

    // Register endpoint
    #[OA\Post(
        path: "/api/register",
        summary: "Register User",
        tags: ["Authentication"],
        description: "Register by first_name, last_name, email and password",
        operationId: "authRegister",
        requestBody: new OA\RequestBody(
            required: true,
            description: "Register user credentials",
            content: new OA\JsonContent(
                required: ["first_name","last_name","email", "password"],
                properties: [
                    new OA\Property(property: "first_name", type: "string", format: "text", example: "John"),
                    new OA\Property(property: "last_name", type: "string", format: "text", example: "Doe"),
                    new OA\Property(property: "email", type: "string", format: "email", example: "test@email.com"),
                    new OA\Property(property: "password", type: "string", format: "password", example: "12345678")
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 201,
                description: "User Successfully Created.",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: "message", type: "string", example: "User Successfully Created."),
                        new OA\Property(property: "code", type: "integer", example: 201),
                        new OA\Property(
                            property: "results",
                            type: "object",
                            properties: [
                                new OA\Property(
                                    property: "users",
                                    type: "object",
                                    properties: [
                                        new OA\Property(property: "id", type: "integer", example: 1),
                                        new OA\Property(property: "email", type: "string", format: "date", example: "test@email.com"),
                                        new OA\Property(property: "first_name", type: "string", example: "First name"),
                                        new OA\Property(property: "last_name", type: "string", example: "Second name"),
                                        new OA\Property(property: "created_at", type: "string", format: "date-time", example: "2025-04-17T08:34:29.000000Z"),
                                    ]
                                ),
                                new OA\Property(property: "token", type: "string", example: "1|GAjAN18EZ23444bi3wdAEICA6XR040BrEPme2EAXls00a598cc"),
                                new OA\Property(property: "token_type", type: "string", example: "Bearer"),
                            ]
                        )
                    ]
                )
            ),
            new OA\Response(
                response: 401,
                ref: "#/components/responses/UnauthorizedRegister"
            )
        ]
    )]
    public function register() {}

    #[OA\Post(
        path: "/api/logout",
        summary: "Logout",
        tags: ["Authentication"],
        description: "Log out of the system",
        operationId: "authLogout",
        security: [["apiAuth" => []]],
        responses: [
            new OA\Response(
                response: 200,
                description: "Log out",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: "message", type: "string", example: "User Logged out")
                    ]
                )
            ),
            new OA\Response(
                response: 405,
                description: "Invalid Token",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: "message", type: "string", example: "Sorry, token is invalid")
                    ]
                )
            ),
            new OA\Response(
                response: 404,
                description: "Invalid Token",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: "message", type: "string", example: "Sorry, token is invalid")
                    ]
                )
            )
        ]
    )]
    public function logout() {}
}
