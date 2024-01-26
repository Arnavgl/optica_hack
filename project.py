# import pywhatkit
# pywhatkit.sendwhatmsg('+91XXXXXXXXXX', 'bhagwan bharose', 23, 7)

import pandas as pd
import pywhatkit
from datetime import datetime, timedelta

# Function to send messages
def send_whatsapp_messages(phone_number, message, hour, minute):
    try:
        pywhatkit.sendwhatmsg(phone_number, message, hour, minute)
        print(f"Message sent to {phone_number} successfully!")
    except Exception as e:
        print(f"Error sending message to {phone_number}: {str(e)}")

# Read phone numbers from CSV file
csv_file_path = 'test.csv'  # Change this to the path of your CSV file
df = pd.read_csv(csv_file_path)

# Current time
now = datetime.now()

# Iterate over rows in the DataFrame
for index, row in df.iterrows():
    phone_number = str(row['Phone'])
    message = 'This is a presentation message for JIIT Optica Hackathon.'
    hour = now.hour
    minute = now.minute + 2 

    # Call the function to send the message
    send_whatsapp_messages(phone_number, message, hour, minute)

    # Increment the minute for the next message
    now += timedelta(minutes=1)
