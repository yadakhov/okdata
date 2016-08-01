# OkData json api response

OkData is inspired by the [jsend](https://labs.omniti.com/labs/jsend) api response specifications.

The motivation for the specifications is to have json api responses that looks like:

```json
{
    "ok" : true,
    "data" : { "id" : 1 }
}
```

Note to two keys: *ok* and *data* which is why the spec is called OkData.

Required and optional keys for each type:

| Ok Status           | Description                                                              | Required Keys | Optional Keys |
|---------------------|--------------------------------------------------------------------------|---------------|---------------|
| true                | All went well, and (usually) some data was returned.                     | ok, data      |               |
| false               | An error occurred in processing the request, i.e. an exception was thrown| ok, error     | data          |

## Example response types

#### GET /posts.json:

```json
{
    "ok" : true,
    "data" : {
        "posts" : [
            { "id" : 1, "title" : "A blog post", "body" : "Some useful content" },
            { "id" : 2, "title" : "Another blog post", "body" : "More content" },
        ]
     }
}
```

#### GET /posts/2.json:

```json
{
    "ok" : true,
    "data" : { "post" : { "id" : 2, "title" : "Another blog post", "body" : "More content" }}
}
```

#### DELETE /posts/2.json:

```json
{
    "ok" : true,
    "data" : null
}
```

Required keys:

- ok: Should always be set true
- data: Acts as the wrapper for any data returned by the API call. If the call returns no data (as in the last example), data should be set to null.


### Error

When an API call fails due to an error on the server. For example:

#### GET /posts.json:

```json
{
    "ok" : false,
    "error" : "Unable to communicate with database"
}
```
Required keys:

- ok: Should always be set false.
- error: A meaningful, end-user-readable (or at the least log-worthy) message, explaining what went wrong.

Optional keys:

- data: A generic container for any other information about the error, i.e. the conditions that caused the error, stack traces, etc.

### What's the different between OkData and JSend?

OkData uses a boolean status ok.  JSend uses three statuses: success, fail, and error.  In my experience, we only use success, and error.  

The boolean ok status also makes it easier to check.  `if (json.ok) { }`
