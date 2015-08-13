# img-store

Store small webcam images in a MySQL database. Made to work in an environment with only free Azure
services.

# Config

`cp common_include.php.example common_include.php`
and fill in appropriate values in common_include.php

# Usage

## Post new image:
POST to /put.php with the "base64" key of the post data set to the image file (jpeg) encoded as base64.
Also remember to use HTTPS and include the correct "hub_password" in the post data, for security
reasons. See [post_image.py](post_image.py) for an example of how one can post an image to the service.

## Get latest image:
GET /cam.jpg

This actually points to image.php, which serves the image file and sets the correct MIME type (`image/jpeg`) in the response. The reason why you would rather use cam.jpg instead of image.php is that the file name becomes nice if you try to save it.

## Get status:
GET /status

This will return a JSON response with info about the latest image. It can look like this, for example:
```json
{"time":"2015-08-13T22:16:36+00:00","is_outdated":false,"age":214}
```

<dl>
  <dt>time</dt>
  <dd>When the newest image was stored</dd>

  <dt>is_outdated</dt>
  <dd><i>true</i> if the newest image is older than 15 minutes. Else <i>false</i></dd>
  
  <dt>age</dt>
  <dd>The number of seconds since the newest image was stored</dd>
</dl>
