# OkData json api

OkData is based on the [jsend](https://labs.omniti.com/labs/jsend) api specifications.

The motivation for the specification is to have json response as simple as this:

```javascript
{
    ok: true,
    data : {
        "post" : { "id" : 1, "title" : "A blog post", "body" : "Some useful content" }
    }
}
```

Note to two keys: *ok* and *data* which is why the spec is called OkData.

Required and optional keys for each type:

||'''Ok'''||'''Description'''||'''Required Keys'''||'''Optional Keys'''||
||ok is true||All went well, and (usually) some data was returned.||ok, data||||
||ok is false||An error occurred in processing the request, i.e. an exception was thrown||ok, message||data||



