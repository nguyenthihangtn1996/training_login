import csv
import mysql.connector

mydb = mysql.connector.connect(
  host="localhost",
  user="root",
  passwd="",
  database = "customer_db"

)
mycursor = mydb.cursor()
mycursor.execute("DROP TABLE IF EXISTS customers")

mycursor.execute("CREATE TABLE customers (customerid INT PRIMARY KEY, firstname VARCHAR(255), lastname VARCHAR(255), companyname VARCHAR(255), billingaddress1 VARCHAR(255), billingaddress2 VARCHAR(255), city VARCHAR(255), state VARCHAR(255), postalcode VARCHAR(255), country VARCHAR(255), phonenumber VARCHAR(255), emailaddress VARCHAR(255), createddate  VARCHAR(255)  )")

with open('customer.csv', 'r') as file:
    csv_data = csv.reader(file)
    rows = iter(csv_data)
    next(rows)
    for row in rows:
      mycursor.execute('INSERT INTO customers ( customerid, firstname, lastname, companyname, billingaddress1, billingaddress2, city, state, postalcode , country,  phonenumber, emailaddress , createddate) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s,  %s) ', row)

mydb.commit()
mycursor.close()