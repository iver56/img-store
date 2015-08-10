# img-store

Store small webcam images in a MySQL database. Made to work in an environment with only free Azure
services.

# Config

`cp common_include.php.example common_include.php`
and fill in appropriate values in common_include.php

# Usage

## Put new image:
POST to /put.php with the "base64" key of the post data set to the image file encoded as base64.
Also remember to use HTTPS and include the correct "hub_password" in the post data, for security
reasons.

## Get latest image:
GET /cam.jpg

## Get status:
GET /status
