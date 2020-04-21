import requests
from bs4 import BeautifulSoup

def login_request():
    with requests.Session() as c:
        url = 'https://cm.litextension.com/login'
        EMAIL = 'test1@test.com'
        PASSWORD = 'aA123456'
        
        postHeaders = {

        'Accept-Language': 'vi-VN,vi;q=0.9,en-US;q=0.8,en;q=0.7',
        'Origin': 'https://cm.litextension.com',
        'Referer': 'https://cm.litextension.com/login',
        'User-Agent': 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.113 Safari/537.36'
        }

        page = c.get('https://cm.litextension.com/my-migrations')
        soup = BeautifulSoup(page.text, 'lxml')
        token = soup.select_one('input[name="_token"]')['value']
        login_data = dict( email = EMAIL, password = PASSWORD, _token = token)
        r = c.post(url, data = login_data, verify = True, headers= postHeaders )

login_request()