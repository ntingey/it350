import mysql.connector
#from mysql.connector import (connection)
from flask import Flask, render_template, request, session, redirect, json
from mysql import connector
from flaskext.mysql import MySQL
from hashlib import md5
from pymongo import MongoClient
import pymongo
import datetime
import os 
#from apscheduler.schedulers.background import BackgroudScheduler


mysql= MySQL()
app = Flask(__name__)

app.secret_key = 'why would I tell you my secret key?'


#MySQL Configs
app.config['MYSQL_DATABASE_USER'] = 'nate'
app.config['MYSQL_DATABASE_PASSWORD'] = 'natespassword'
app.config['MYSQL_DATABASE_DB'] = 'think_africa'
app.config['MYSQL_DATABASE_HOST'] = 'localhost'
mysql.init_app(app)

BACKUP_PATH = '/home/webadmin/Documents'
DB_USER = 'nate'


# def backup():
#     #source:
#     #https://tecadmin.net/python-script-for-mysql-database-backup/
#     DB_HOST = 'localhost'
#     DB_USER = 'nate'
#     DB_NAME = 'think_africa'
#     BACKUP_PATH = '/home/nate/db_python/static/backups/'

#     db = DB_NAME
#     dumpcmd = "mysqldump -u " + DB_USER + " --routines " + db + " > " + BACKUP_PATH + "/" + db + ".sql"
#     os.system(dumpcmd)

#     print "Backup script completed"

#     #mongosqldump
#     DB_COLLECTION = 'articles'
#     mongodumpcmd = "mongodump --db " + DB_NAME + " --collection " + DB_COLLECTION + " --out  " + BACKUP_PATH + "/"
#     os.system(mongodumpcmd)

# sched = BackgroundScheduler()
# sched.start()
# sched.add_job(backup, 'cron', day_of_week='sun', hour=10)
# print('running backups')


@app.route("/")
def main():
    return render_template('index.html')


@app.route("/showSignin")
def showSignin():
	return render_template('signin.html')

@app.route('/userHome')
def userHome():
	MYSQL = False
	Es = False
	MONGO = False
	output_db = ''
	output = ''
	stats = ''
	import mysql.connector
	from pymongo import MongoClient
	from pymongo.errors import ConnectionFailure
	from elasticsearch import Elasticsearch
	from flaskext.mysql import MySQL
	from flask import Flask, render_template, request, session, redirect, json
	import subprocess
	import requests
	

	# try:
	# 	cnx = mysql.connect()
		# cursor = conn.cursor()	


	if session.get('user'):
		cnx = mysql.connector.connect(user='nate', password='natespassword', host='localhost', database='think_africa')
		# cnx = mysql.connect.MySQLConnection(user='nate', password='natespassword', host='192.168.50.53', database='think_africa')
		if(cnx.is_connected()):
			mysqlstatus= 'Mysql is running'
			MYSQL = True
		else:
			mysqlstatus = 'Mysql is NOT available'


		client = MongoClient('localhost',27017)
		db = client.think_africa
		try:
			#ismaster command doesn't require authorization
			client.admin.command('ismaster')
			mongostatus = 'Mongodb is running'
			MONGO = True
		except ConnectionFailure:
			mongostatus = 'Mongodb is not available'


		es = Elasticsearch(['http://localhost:9200/'], verify_certs= True)
		if not es.ping():
			esstatus = 'Elasticsearchis NOT available'
		else:
			esstatus = 'Elasticsearch is running'
			ES = True


		if(MYSQL):
			mysqlusagetest = "mysqladmin status"
			output = output + subprocess.check_output(mysqlusagetest, shell=True)
			#print output
		if(MONGO):
			output_db = db.current_op(True)
		if(ES):
			stats = requests.get('http://localhost:9200/_nodes/stats?all').json()
			print stats

		return render_template('userHome.html',
			mysqlstatus = mysqlstatus,
			mongostatus = mongostatus,
			esstatus = esstatus,
			mysqlusage = output,
			mongousage = output_db,
			esusage = stats )
	else:
		return render_template('error.html',error = 'Unauthorized Access')

	# except Exception as e:
	# 	return render_template('error.html', error = str(e))
	# finally:
	# 	# cursor.close()
	# 	cnx.close()


@app.route('/validateLogin', methods=['POST'])
def validateLogin():
	try:
		conn = mysql.connect()
		cursor = conn.cursor()
		user_email = request.form['user_email']
		password = md5(request.form['password'].encode()).hexdigest()
		print password

		#connect to mysql
		if user_email and password:
			cursor.execute("SELECT * FROM users WHERE user_email='"+user_email+"' and password = '"+password+"';")
			data = cursor.fetchone()
			print(data)
			if len(data)> 0:
				session['user']= data[0][0]
				print('good')
				return redirect('/userHome')
 			else:
 				return render_template('error.html',error = 'Wrong Email address or Password.')
 		else:
 			return render_template('error.html',error = 'Wrong Email address or Password.')

	except Exception as e:
		return render_template('error.html', error = str(e))
	finally:
		cursor.close()
		conn.close()

#this should always be at the bottom	
if __name__== "__main__":
    app.run(host="0.0.0.0")


