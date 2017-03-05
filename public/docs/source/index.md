---
title: 教室预定管理系统 API

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- 由 <a href='http://github.com/xiyusullos'>xiyusullos</a> 拽写
---
<!-- START_INFO -->
# 教室预定管理系统

[Get *Postman* Collection](http://cr.xy-jit.cc/docs/collection.json)

<!-- END_INFO -->

#00-codes
<!-- START_a1e4da3db4d7411675fc2746c8f1e2d5 -->
## 发送邮箱验证码

> Example request:

```bash
curl "http://cr.xy-jit.cc/api/codes" \
-H "Accept: application/json" \
    -d "email"="tiana.mckenzie@example.com" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://cr.xy-jit.cc/api/codes",
    "method": "POST",
    "data": {
        "email": "tiana.mckenzie@example.com"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/codes`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    email | email |  required  | 

<!-- END_a1e4da3db4d7411675fc2746c8f1e2d5 -->
#01-users
用户
<!-- START_12e37982cc5398c7100e59625ebb5514 -->
## 注册

> Example request:

```bash
curl "http://cr.xy-jit.cc/api/users" \
-H "Accept: application/json" \
    -d "name"="rem" \
    -d "email"="claire.schumm@example.net" \
    -d "password"="rem" \
    -d "code"="rem" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://cr.xy-jit.cc/api/users",
    "method": "POST",
    "data": {
        "name": "rem",
        "email": "claire.schumm@example.net",
        "password": "rem",
        "code": "rem"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/users`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    name | string |  required  | 
    email | email |  required  | 
    password | string |  required  | 
    code | string |  required  | 

<!-- END_12e37982cc5398c7100e59625ebb5514 -->
<!-- START_21ff1203a9357ffbb000ef4dd551dfd3 -->
## 登录

> Example request:

```bash
curl "http://cr.xy-jit.cc/api/users/login" \
-H "Accept: application/json" \
    -d "email"="tfunk@example.org" \
    -d "password"="atque" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://cr.xy-jit.cc/api/users/login",
    "method": "POST",
    "data": {
        "email": "tfunk@example.org",
        "password": "atque"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/users/login`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    email | email |  required  | Valid user email
    password | string |  required  | 

<!-- END_21ff1203a9357ffbb000ef4dd551dfd3 -->
<!-- START_5da4a01649c4efd773d0d8417009a943 -->
## 查看个人信息

> Example request:

```bash
curl "http://cr.xy-jit.cc/api/users/{id}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://cr.xy-jit.cc/api/users/{id}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET api/users/{id}`

`HEAD api/users/{id}`


<!-- END_5da4a01649c4efd773d0d8417009a943 -->
<!-- START_9332edb67641ad6a0c477285396a59e6 -->
## 修改个人信息、密码

> Example request:

```bash
curl "http://cr.xy-jit.cc/api/users/{id}" \
-H "Accept: application/json" \
    -d "name"="sint" \
    -d "username"="ukoch@example.com" \
    -d "password"="sint" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://cr.xy-jit.cc/api/users/{id}",
    "method": "PUT",
    "data": {
        "name": "sint",
        "username": "ukoch@example.com",
        "password": "sint"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`PUT api/users/{id}`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    name | string |  optional  | 
    username | email |  optional  | 
    password | string |  optional  | 

<!-- END_9332edb67641ad6a0c477285396a59e6 -->
<!-- START_49674000f212bf6c4feec16c7373bc74 -->
## 重置密码

> Example request:

```bash
curl "http://cr.xy-jit.cc/api/users/resetPassword" \
-H "Accept: application/json" \
    -d "email"="ut" \
    -d "code"="ut" \
    -d "password"="ut" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://cr.xy-jit.cc/api/users/resetPassword",
    "method": "PUT",
    "data": {
        "email": "ut",
        "code": "ut",
        "password": "ut"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`PUT api/users/resetPassword`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    email | string |  required  | Valid user email
    code | string |  required  | 
    password | string |  required  | 

<!-- END_49674000f212bf6c4feec16c7373bc74 -->
#02-classrooms
<!-- START_8b1bca47bbd5da25f1bc95bc352a88c7 -->
## 教室列表
     当前可用教室查看 /api/classrooms?search=is_free:1
     筛选可用教室（面积大小、教学楼、时间段）

> Example request:

```bash
curl "http://cr.xy-jit.cc/api/classrooms" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://cr.xy-jit.cc/api/classrooms",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "data": {
        "data": [
            {
                "type": "classrooms",
                "id": "3",
                "attributes": {
                    "number": "1321",
                    "name": "创新实验室",
                    "location": "北区1号楼",
                    "square": 60,
                    "floor": 2,
                    "is_free": 0,
                    "building_name": "1号楼",
                    "created_at": {
                        "date": "2017-03-01 17:06:33.000000",
                        "timezone_type": 3,
                        "timezone": "Asia\/Shanghai"
                    },
                    "updated_at": {
                        "date": "2017-03-01 21:38:35.000000",
                        "timezone_type": 3,
                        "timezone": "Asia\/Shanghai"
                    }
                }
            },
            {
                "type": "classrooms",
                "id": "10",
                "attributes": {
                    "number": "11",
                    "name": "11",
                    "location": "11",
                    "square": 11,
                    "floor": 1,
                    "is_free": 0,
                    "building_name": "11",
                    "created_at": {
                        "date": "2017-03-01 22:25:05.000000",
                        "timezone_type": 3,
                        "timezone": "Asia\/Shanghai"
                    },
                    "updated_at": {
                        "date": "2017-03-01 22:25:05.000000",
                        "timezone_type": 3,
                        "timezone": "Asia\/Shanghai"
                    }
                }
            }
        ]
    }
}
```

### HTTP Request
`GET api/classrooms`

`HEAD api/classrooms`


<!-- END_8b1bca47bbd5da25f1bc95bc352a88c7 -->
<!-- START_1f7c481e614b753876089673d7775e6b -->
## api/classrooms/create

> Example request:

```bash
curl "http://cr.xy-jit.cc/api/classrooms/create" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://cr.xy-jit.cc/api/classrooms/create",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET api/classrooms/create`

`HEAD api/classrooms/create`


<!-- END_1f7c481e614b753876089673d7775e6b -->
<!-- START_be2aae56bc66c5facf1c3a9048bfd03a -->
## Store a newly created resource in storage.

> Example request:

```bash
curl "http://cr.xy-jit.cc/api/classrooms" \
-H "Accept: application/json" \
    -d "number"="ratione" \
    -d "name"="ratione" \
    -d "location"="ratione" \
    -d "square"="ratione" \
    -d "floor"="ratione" \
    -d "is_free"="ratione" \
    -d "building_name"="ratione" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://cr.xy-jit.cc/api/classrooms",
    "method": "POST",
    "data": {
        "number": "ratione",
        "name": "ratione",
        "location": "ratione",
        "square": "ratione",
        "floor": "ratione",
        "is_free": "ratione",
        "building_name": "ratione"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/classrooms`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    number | string |  required  | 
    name | string |  required  | 
    location | string |  required  | 
    square | string |  required  | 
    floor | string |  required  | 
    is_free | string |  required  | 
    building_name | string |  required  | 

<!-- END_be2aae56bc66c5facf1c3a9048bfd03a -->
<!-- START_2b3f3225708442e7f72b6362d327866b -->
## Display the specified resource.

> Example request:

```bash
curl "http://cr.xy-jit.cc/api/classrooms/{classroom}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://cr.xy-jit.cc/api/classrooms/{classroom}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET api/classrooms/{classroom}`

`HEAD api/classrooms/{classroom}`


<!-- END_2b3f3225708442e7f72b6362d327866b -->
<!-- START_e4f5b06ac903b59f49f4c19b6873ba6a -->
## Show the form for editing the specified resource.

> Example request:

```bash
curl "http://cr.xy-jit.cc/api/classrooms/{classroom}/edit" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://cr.xy-jit.cc/api/classrooms/{classroom}/edit",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET api/classrooms/{classroom}/edit`

`HEAD api/classrooms/{classroom}/edit`


<!-- END_e4f5b06ac903b59f49f4c19b6873ba6a -->
<!-- START_6f4c8439b6d56d80f77dab4edffef04d -->
## Update the specified resource in storage.

> Example request:

```bash
curl "http://cr.xy-jit.cc/api/classrooms/{classroom}" \
-H "Accept: application/json" \
    -d "number"="ea" \
    -d "name"="ea" \
    -d "location"="ea" \
    -d "square"="ea" \
    -d "floor"="ea" \
    -d "is_free"="ea" \
    -d "building_name"="ea" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://cr.xy-jit.cc/api/classrooms/{classroom}",
    "method": "PUT",
    "data": {
        "number": "ea",
        "name": "ea",
        "location": "ea",
        "square": "ea",
        "floor": "ea",
        "is_free": "ea",
        "building_name": "ea"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`PUT api/classrooms/{classroom}`

`PATCH api/classrooms/{classroom}`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    number | string |  required  | 
    name | string |  required  | 
    location | string |  required  | 
    square | string |  required  | 
    floor | string |  required  | 
    is_free | string |  required  | 
    building_name | string |  required  | 

<!-- END_6f4c8439b6d56d80f77dab4edffef04d -->
<!-- START_9744da84ac8310e72416741d92e71cdf -->
## Remove the specified resource from storage.

> Example request:

```bash
curl "http://cr.xy-jit.cc/api/classrooms/{classroom}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://cr.xy-jit.cc/api/classrooms/{classroom}",
    "method": "DELETE",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`DELETE api/classrooms/{classroom}`


<!-- END_9744da84ac8310e72416741d92e71cdf -->
#03-reservations
教室租赁
<!-- START_f92d846631bdbfbb31051b90402d9652 -->
## Display a listing of the resource.

> Example request:

```bash
curl "http://cr.xy-jit.cc/api/reservations" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://cr.xy-jit.cc/api/reservations",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "data": {
        "data": [
            {
                "type": "reservations",
                "id": "2",
                "attributes": {
                    "created_at": {
                        "date": "2017-03-02 02:01:46.000000",
                        "timezone_type": 3,
                        "timezone": "Asia\/Shanghai"
                    },
                    "updated_at": {
                        "date": "2017-03-02 02:01:46.000000",
                        "timezone_type": 3,
                        "timezone": "Asia\/Shanghai"
                    }
                }
            },
            {
                "type": "reservations",
                "id": "3",
                "attributes": {
                    "created_at": {
                        "date": "2017-03-02 02:02:16.000000",
                        "timezone_type": 3,
                        "timezone": "Asia\/Shanghai"
                    },
                    "updated_at": {
                        "date": "2017-03-02 02:02:16.000000",
                        "timezone_type": 3,
                        "timezone": "Asia\/Shanghai"
                    }
                }
            },
            {
                "type": "reservations",
                "id": "4",
                "attributes": {
                    "created_at": {
                        "date": "2017-03-02 02:02:46.000000",
                        "timezone_type": 3,
                        "timezone": "Asia\/Shanghai"
                    },
                    "updated_at": {
                        "date": "2017-03-02 02:02:46.000000",
                        "timezone_type": 3,
                        "timezone": "Asia\/Shanghai"
                    }
                }
            }
        ]
    }
}
```

### HTTP Request
`GET api/reservations`

`HEAD api/reservations`


<!-- END_f92d846631bdbfbb31051b90402d9652 -->
<!-- START_42c8e1b39127e86ce541ea1d8bb01c1d -->
## api/reservations/create

> Example request:

```bash
curl "http://cr.xy-jit.cc/api/reservations/create" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://cr.xy-jit.cc/api/reservations/create",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET api/reservations/create`

`HEAD api/reservations/create`


<!-- END_42c8e1b39127e86ce541ea1d8bb01c1d -->
<!-- START_ab282f256617c21610a7231da4ebdcda -->
## Store a newly created resource in storage.

> Example request:

```bash
curl "http://cr.xy-jit.cc/api/reservations" \
-H "Accept: application/json" \
    -d "user_id"="harum" \
    -d "classroom_id"="harum" \
    -d "begin_time"="harum" \
    -d "end_time"="harum" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://cr.xy-jit.cc/api/reservations",
    "method": "POST",
    "data": {
        "user_id": "harum",
        "classroom_id": "harum",
        "begin_time": "harum",
        "end_time": "harum"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/reservations`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    user_id | string |  required  | Valid admin_user id
    classroom_id | string |  required  | Valid classroom id
    begin_time | string |  required  | 
    end_time | string |  optional  | 

<!-- END_ab282f256617c21610a7231da4ebdcda -->
<!-- START_a5d58408e2a2cd7a1bde0ec571006f58 -->
## Display the specified resource.

> Example request:

```bash
curl "http://cr.xy-jit.cc/api/reservations/{reservation}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://cr.xy-jit.cc/api/reservations/{reservation}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET api/reservations/{reservation}`

`HEAD api/reservations/{reservation}`


<!-- END_a5d58408e2a2cd7a1bde0ec571006f58 -->
<!-- START_91ef4b2f57e582a331fe2dbdc0000b0d -->
## Show the form for editing the specified resource.

> Example request:

```bash
curl "http://cr.xy-jit.cc/api/reservations/{reservation}/edit" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://cr.xy-jit.cc/api/reservations/{reservation}/edit",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET api/reservations/{reservation}/edit`

`HEAD api/reservations/{reservation}/edit`


<!-- END_91ef4b2f57e582a331fe2dbdc0000b0d -->
<!-- START_697d47ccdc697240b5c11dc066f4ce3d -->
## Update the specified resource in storage.

> Example request:

```bash
curl "http://cr.xy-jit.cc/api/reservations/{reservation}" \
-H "Accept: application/json" \
    -d "user_id"="tempora" \
    -d "classroom_id"="tempora" \
    -d "begin_time"="tempora" \
    -d "end_time"="tempora" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://cr.xy-jit.cc/api/reservations/{reservation}",
    "method": "PUT",
    "data": {
        "user_id": "tempora",
        "classroom_id": "tempora",
        "begin_time": "tempora",
        "end_time": "tempora"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`PUT api/reservations/{reservation}`

`PATCH api/reservations/{reservation}`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    user_id | string |  required  | Valid admin_user id
    classroom_id | string |  required  | Valid classroom id
    begin_time | string |  required  | 
    end_time | string |  optional  | 

<!-- END_697d47ccdc697240b5c11dc066f4ce3d -->
<!-- START_79a2e4117fcd567c8d0ac6712c4e7026 -->
## Remove the specified resource from storage.

> Example request:

```bash
curl "http://cr.xy-jit.cc/api/reservations/{reservation}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://cr.xy-jit.cc/api/reservations/{reservation}",
    "method": "DELETE",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`DELETE api/reservations/{reservation}`


<!-- END_79a2e4117fcd567c8d0ac6712c4e7026 -->
