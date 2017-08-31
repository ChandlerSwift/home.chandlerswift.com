#!/usr/bin/python3
from picamera import PiCamera
from time import sleep
from io import BytesIO
import base64

print("Content-Type: text/html")
print()

# capture image
camera = PiCamera()
picture_stream = BytesIO()
camera.start_preview()
sleep(1.5) # nominally 460ms, actually about a second, with some buffer -- camera startup time
camera.capture(picture_stream, 'jpeg')

# base64 encode image
picture_stream.seek(0)
picture_base64 = base64.b64encode(picture_stream.getvalue())

print("""
<!DOCTYPE html>
<html>
    <head>
        <title>Chandler's Workbench</title>
    </head>
    <body>
        <img src="data:image/png;base64,""" + picture_base64.decode('utf-8') + """">
    </body>
</html>
""")
