import requests
import sys
from pymarkovchain import MarkovChain
from random import uniform
import os
#pip install PyMarkovChain

EMAIL = 'sespiros'
PASSWORD = '123456'

URL = 'http://localhost:8000/reportr/index.php'
newRep = 'http://localhost:8000/reportr/newreport.php'

def main():
    with open ("test.txt", "r") as myfile:
      data=myfile.read().replace('\n', '')
    mc = MarkovChain("./markovdb")

    # Start a session so we can have persistant cookies
    session = requests.Session()

    # This is the form data that the page sends when logging in
    login_data = {
        'user_email': EMAIL,
        'user_password': PASSWORD,
        'login': 'login',
    }

    # Authenticate
    r = session.post(URL, data=login_data)

    mc.generateDatabase(data)

    for x in range(0, 20):
      r = os.urandom(16).encode('hex')
      title="Report#"+str(x)+" "+str(r)
      description = mc.generateString()


      y, x = uniform(-180,180), uniform(-90, 90)

      print (title)

      # Create new report based on random content
      report_data = {
          'title': title,
          'category': "1",
          'description': description,
          'latitude': x,
          'longitude': y,
          'newreport': "1",
      }

      r = session.post(newRep, data=report_data)


if __name__ == '__main__':
    main()
