import base64
import requests

def post_image():
    with open("cam.jpg", "rb") as image_file:
        encoded_string = base64.b64encode(image_file.read())
    
    url = 'http://localhost:8090/img-store/index.php'
    payload = {'base64': encoded_string}
    response = requests.post(url, payload)
    print response, response.text

post_image()
