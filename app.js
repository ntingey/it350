
/**
* Module dependencies.
*/
//var reload = require('reload')
var session = require('express-session');
var express = require('express')
  , routes = require('./routes')
  , user = require('./routes/user')
  , http = require('http')
  , path = require('path');
var mongoclient = require('mongodb').MongoClient;
//var methodOverride = require('method-override');
var app = express();
var myconnection  = require('express-myconnection');
var mysql      = require('mysql');
var bodyParser=require("body-parser");
var connection = mysql.createConnection({
              host     : 'localhost',
              user     : 'nate',
              password : 'natespassword',
              database : 'think_africa'
            });
 
connection.connect();
 
global.db = connection;
 
// all environments
app.set('port', process.env.PORT || 8080);
app.set('views', __dirname + '/views');
app.set('view engine', 'ejs');
app.use(bodyParser.urlencoded({ extended: false }));
app.use(bodyParser.json());
app.use(express.static(path.join(__dirname, 'public')));

app.use(session({
  secret: 'keyboard cat',
  resave: false,
  saveUninitialized: true,
  cookie: { maxAge: 60000 }
}))
app.use(
	myconnection(mysql, {
	
              host     : 'localhost',
              user     : 'nate',
              password : 'natespassword',
              database : 'think_africa'
            
	},'pool')
	);

//mongo connection

global.dbmongo = null;

mongoclient.connect('mongodb://localhost:27017/test', function(err, client){
	if(err) { console.error("####ERROR:####"+err); console.log("here0") }
    dbmongo = client.db("test");
	console.log("here1");
});

app.get('/', routes.index);//call for main index page
app.get('/login', routes.index);//call for login page
app.get('/signup', user.signup);//call for signup page
app.get('/products', user.products);//call for products page
app.get('/number_of_hats', user.number_of_hats);//call for number of hats page
app.get('/blog', function(req,res){
	dbmongo.collection('Article').find().toArray(function(err,docs) {
        if(err) { console.error(err) }
        //res.send(docs)
    	res.render('blog',{page_title:"blog", docs:docs});
    //JSON.stringify(docs)
    })
});//call for blog page
// app.get('/blog_comment', function(req, res){
	

// });
//Here it goes with implementing mongo
// var mongoose = require('mongodb');
 
// var app = express();
 
 
// mongoose.connect('mongodb://localhost/Article');
 
// var Schema = new mongoose.Schema({
// 	_id    : String,
// 	title: String,
// 	text : String
// });

//https://stackoverflow.com/questions/5224811/mongodb-schema-design-for-blogs 

//var Article = mongoose.model('emp', Schema);
//  var Article = "";
 
// app.get('/blog', function(req, res){
// 	Article.find({}, function(err, docs){
// 		if(err) res.json(err);
// 		else    res.render('blog', {Article: docs});
// 	});
// });
 
// app.post('/new', function(req, res){
// 	new user({
// 		_id    : req.body.email,
// 		name: req.body.name,
// 		age   : req.body.age				
// 	}).save(function(err, doc){
// 		if(err) res.json(err);
// 		else    res.redirect('/view');
// 	});
// });
 
// var server = http.createServer(app).listen(app.get('port'), function(){
//   console.log('Express server listening on port ' + app.get('port'));
// });


//End mongo stuff





//app.get('/home/order', user.order);
 
//Middleware
app.post('/login', user.login);//call for login post
app.post('/home/order', user.order);
app.post('/blog_comment', user.blog_comment);

app.listen(8080)

//kill command. look up ss -tlp . kill is kill -9 pid#