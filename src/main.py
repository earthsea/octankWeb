import boto3
import json

client = boto3.client('iot-data', region_name='us-east-1')

# Change topic, qos and payload
response = client.publish(
        topic='$aws/things/pi/shadow/update',
        qos=1,
        payload=json.dumps({"foo":"bar"})
    )