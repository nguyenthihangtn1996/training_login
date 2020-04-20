from flask import Flask
import requests
from selenium import webdriver
import sys

app = Flask(__name__)


def login_sele():
        
        driver = webdriver.Chrome(executable_path="/Users/nguyenhang/Documents/oceansoft_login/chromedriver")

        driver.get("https://cm.litextension.com/login")

        username = driver.find_element_by_name("email").send_keys("test1@test.com")
        password = driver.find_element_by_name("password").send_keys("aA123456")


        driver.find_element_by_xpath("//*[@id='app']/div/div/div/div/div[2]/div/div[1]/form/div[5]/div/button").click()

        name_user = driver.find_element_by_xpath('//*[@id="navbarDropdown2"]').get_attribute('innerHTML')

        element =driver.find_element_by_xpath('//*[@id="list-list"]/div[2]')

        driver.execute_script("let name_user = document.getElementById('navbarDropdown2').textContent; arguments[0].innerText ='Hi!'+ name_user; "  , element)

        
login_sele()


if __name__ == '__main__':
   app.run(debug=True)
