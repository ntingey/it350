#!/usr/bin/python
import MySQLdb

db = MySQLdb.connect(host="localhost",    # your host, usually localhost
                     user="nate",         # your username
                     passwd="natespassword",  # your password
                     db="think_africa")        # name of the data base

# you must create a Cursor object. It will let
#  you execute all the queries you need
cur = db.cursor()

# Use all the SQL you like
#cur.execute("SELECT * FROM YOUR_TABLE_NAME")

# print all the first cell of all the rows
#for row in cur.fetchall():
#    print row[0]
print ('hello') 

db.close()