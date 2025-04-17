<?php

namespace App\Swagger;

use OpenApi\Attributes as OA;

class Task
{
    // Get All Task
    #[OA\Get(
        path: "/api/tasks",
        summary: "Get Tasks",
        tags: ["Tasks"],
        description: "Get all tasks",
        operationId: "getTasks",
        security: [["apiAuth" => []]],
        parameters: [
            new OA\Parameter(
                name: "keyword",
                in: "path",
                required: false,
                description: "Title of the task",
                example: "",
                schema: new OA\Schema(type: "string", format: "text")
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "List of Tasks",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: "message", type: "string", example: "Success"),
                        new OA\Property(property: "code", type: "string", example: "200"),
                        new OA\Property(
                            property: "results",
                            type: "object",
                            properties: [
                                new OA\Property(
                                    property: "data",
                                    type: "array",
                                    items: new OA\Items(
                                        properties: [
                                            new OA\Property(property: "id", type: "string", example: "2b994673-3dd4-441a-8345-2c8ed2ed0a25"),
                                            new OA\Property(property: "title", type: "string", example: "This is title"),
                                            new OA\Property(property: "description", type: "string", example: "This is description"),
                                            new OA\Property(property: "due_date", type: "string", example: "2025-04-25"),
                                            new OA\Property(property: "status_id", type: "integer", example: "2"),
                                            new OA\Property(
                                                property: "status",
                                                type: "object",
                                                properties: [
                                                    new OA\Property(property: "id", type: "integer", example: 2),
                                                    new OA\Property(property: "name", type: "string", example: "In Progress"),
                                                    new OA\Property(property: "created_at", type: "string", format: "date-time", example: "2025-04-17T08:34:29.000000Z"),
                                                    new OA\Property(property: "updated_at", type: "string", format: "date-time", example: "2025-04-17T08:34:29.000000Z"),
                                                ]
                                            ),
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
                                        ]
                                    )
                                )
                            ]
                        ),
                        new OA\Property(
                            property: "pagination",
                            type: "object",
                            properties: [
                                new OA\Property(property: "total", type: "string", example: "5"),
                                new OA\Property(property: "count", type: "string", example: "5"),
                                new OA\Property(property: "per_page", type: "string", example: "10"),
                                new OA\Property(property: "current_page", type: "string", example: "1"),
                                new OA\Property(property: "total_pages", type: "string", example: "1"),
                                new OA\Property(property: "previous_page_url", type: "string", example: "null"),
                                new OA\Property(property: "next_page_url", type: "string", example: "null")
                            ]
                        )
                    ]
                )
            )
        ]
    )]

    // Create Task endpoint
    #[OA\Post(
        path: "/api/tasks",
        summary: "Create Task",
        tags: ["Tasks"],
        description: "Create task by title, description, status_id and due_date",
        operationId: "createTask",
        security: [
            ["apiAuth" => []]
        ],
        requestBody: new OA\RequestBody(
            required: true,
            description: "Create Task credentials",
            content: new OA\JsonContent(
                required: ["title","description","status_id", "due_date"],
                properties: [
                    new OA\Property(property: "title", type: "string", format: "text", example: "Title of the task"),
                    new OA\Property(property: "description", type: "string", format: "text", example: "Description of the task"),
                    new OA\Property(property: "status_id", type: "string", format: "integer", example: "1"),
                    new OA\Property(property: "due_date", type: "string", format: "text", example: "2025-04-25")
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 201,
                description: "Task Successfully Created.",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: "message", type: "string", example: "Task Successfully Created."),
                        new OA\Property(property: "code", type: "integer", example: 201),
                        new OA\Property(
                            property: "results",
                            type: "object",
                            properties: [
                                new OA\Property(property: "title", type: "string", example: "Title of the task"),
                                new OA\Property(property: "description", type: "string", example: "Description of the task"),
                                new OA\Property(property: "status_id", type: "string", example: "2"),
                                new OA\Property(property: "due_date", type: "string", format: "date", example: "2025-04-25"),
                                new OA\Property(property: "created_by", type: "integer", example: 1),
                                new OA\Property(property: "updated_at", type: "string", format: "date-time", example: "2025-04-17T08:34:29.000000Z"),
                                new OA\Property(property: "created_at", type: "string", format: "date-time", example: "2025-04-17T08:34:29.000000Z"),
                                new OA\Property(property: "id", type: "integer", example: 1)
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

    #[OA\Get(
        path: "/api/tasks/{id}",
        summary: "Get Task by ID",
        description: "Fetches a task by its unique ID",
        operationId: "getTaskById",
        tags: ["Tasks"],
        security: [["apiAuth" => []]],
        parameters: [
            new OA\Parameter(
                name: "id",
                in: "path",
                required: true,
                description: "Task ID",
                example: 2,
                schema: new OA\Schema(type: "integer")
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Task fetched successfully",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: "message", type: "string", example: "Data Successfully Fetched."),
                        new OA\Property(property: "code", type: "integer", example: 200),
                        new OA\Property(
                            property: "results",
                            type: "object",
                            properties: [
                                new OA\Property(property: "id", type: "integer", example: 2),
                                new OA\Property(property: "title", type: "string", example: "Nikko"),
                                new OA\Property(property: "description", type: "string", example: "Doe"),
                                new OA\Property(property: "due_date", type: "string", example: "2025-04-25"),
                                new OA\Property(property: "status_id", type: "integer", example: 1),
                                new OA\Property(
                                    property: "status",
                                    type: "object",
                                    properties: [
                                        new OA\Property(property: "id", type: "integer", example: 1),
                                        new OA\Property(property: "name", type: "string", example: "Todo"),
                                        new OA\Property(property: "color", type: "string", nullable: true, example: null),
                                        new OA\Property(property: "created_at", type: "string", format: "date-time", example: "2025-04-17T08:32:16.000000Z"),
                                        new OA\Property(property: "updated_at", type: "string", format: "date-time", example: "2025-04-17T08:32:16.000000Z")
                                    ]
                                ),
                                new OA\Property(
                                    property: "user",
                                    type: "object",
                                    properties: [
                                        new OA\Property(property: "id", type: "integer", example: 1),
                                        new OA\Property(property: "first_name", type: "string", example: "John"),
                                        new OA\Property(property: "last_name", type: "string", example: "Doe"),
                                        new OA\Property(property: "email", type: "string", format: "email", example: "test@email.com"),
                                        new OA\Property(property: "email_verified_at", type: "string", nullable: true, example: null),
                                        new OA\Property(property: "created_at", type: "string", format: "date-time", example: "2025-04-17T08:27:42.000000Z"),
                                        new OA\Property(property: "updated_at", type: "string", format: "date-time", example: "2025-04-17T08:27:42.000000Z")
                                    ]
                                )
                            ]
                        )
                    ]
                )
            ),
            new OA\Response(
                response: 404,
                description: "Task not found",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: "message", type: "string", example: "Task not found")
                    ]
                )
            )
        ]
    )]


    // Update Task endpoint
    #[OA\Put(
        path: "/api/tasks/{id}",
        summary: "Update Task",
        tags: ["Tasks"],
        description: "Update task by title, description, status_id and due_date",
        operationId: "updateTask",
        security: [
            ["apiAuth" => []]
        ],
        parameters: [
            new OA\Parameter(
                name: "id",
                in: "path",
                required: true,
                description: "id",
                example: "1",
                schema: new OA\Schema(type: "integer", format: "integer")
            )
        ],
        requestBody: new OA\RequestBody(
            required: true,
            description: "Update Task credentials",
            content: new OA\JsonContent(
                required: ["title","description","status_id", "due_date"],
                properties: [
                    new OA\Property(property: "title", type: "string", format: "text", example: "Title of the task"),
                    new OA\Property(property: "description", type: "string", format: "text", example: "Description of the task"),
                    new OA\Property(property: "status_id", type: "string", format: "integer", example: "1"),
                    new OA\Property(property: "due_date", type: "string", format: "text", example: "2025-04-25")
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: "Task Successfully Updated.",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: "message", type: "string", example: "Task Successfully Updated."),
                        new OA\Property(property: "code", type: "integer", example: 201),
                        new OA\Property(
                            property: "results",
                            type: "object",
                            properties: [
                                new OA\Property(property: "title", type: "string", example: "Title of the task"),
                                new OA\Property(property: "description", type: "string", example: "Description of the task"),
                                new OA\Property(property: "status_id", type: "string", example: "2"),
                                new OA\Property(property: "due_date", type: "string", format: "date", example: "2025-04-25"),
                                new OA\Property(property: "created_by", type: "integer", example: 1),
                                new OA\Property(property: "updated_at", type: "string", format: "date-time", example: "2025-04-17T08:34:29.000000Z"),
                                new OA\Property(property: "created_at", type: "string", format: "date-time", example: "2025-04-17T08:34:29.000000Z"),
                                new OA\Property(property: "id", type: "integer", example: 1)
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

    // Delete Task
    #[OA\Delete(
        path: "/api/tasks/{id}",
        summary: "Delete Task",
        description: "Deletes a task by its ID",
        operationId: "deleteTask",
        tags: ["Tasks"],
        security: [["apiAuth" => []]],
        parameters: [
            new OA\Parameter(
                name: "id",
                in: "path",
                required: true,
                description: "Get the ID of the task to delete",
                example: "1",
                schema: new OA\Schema(type: "integer", format: "integer")
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Task deleted successfully",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: "message", type: "string", example: "Task deleted successfully")
                    ]
                )
            ),
            new OA\Response(
                response: 404,
                description: "Task not found",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: "message", type: "string", example: "Task not found")
                    ]
                )
            )
        ]
    )]
    public function deleteTask() {}
}
